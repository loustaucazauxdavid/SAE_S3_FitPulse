<?php

/**
 * @file controller_coach.class.php
 * @brief Controller pour les coachs
 */

/**
 * @brief Controller pour les coachs
 * @details Gère les actions liées aux coachs
 */

require_once 'utils/cleaner.php';
require_once 'utils/validator.php';

class ControllerCoach extends Controller
{
    /**
     * Constructeur de la classe ControllerCoach
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader)
    {
        parent::__construct($twig, $loader);
    }

    /**
     * @brief Liste les coachs
     * @return void
     */

    public function lister()
    {
        // Recupération des 10 coachs les mieux notés
        $managerCoach = new CoachNoteDao($this->getPdo());
        $listeCoachsNotesAssoc = $managerCoach->findTopNbByNote(10);
        $listeCoachsNotes = $managerCoach->hydrateAll($listeCoachsNotesAssoc);

        // Chargement du template index
        $template = $this->getTwig()->load('index.html.twig');

        // Affichage de la page
        echo $template->render(array(
            'listeCoachsNotes' => $listeCoachsNotes,
        ));
    }


    public function listerAvecDetails()
    {
        // Récupération des données du formulaire
        $filtres = [
            'budget' => parent::getPost()['budget'] ?? '',
            'date' => parent::getPost()['date'] ?? '',
            'note' => parent::getPost()['note'] ?? '',
            'nom' => parent::getPost()['nom'] ?? '',
            'sport' => parent::getPost()['sport'] ?? '',
            'seance_type' => parent::getPost()['seance_type'] ?? '',
            'participants' => parent::getPost()['participants'] ?? '',
        ];

        // Nettoyage des données pour éviter les failles XSS
        $filtres['nom'] = Cleaner::nettoyerChaine($filtres['nom']);
        $filtres['sport'] = Cleaner::nettoyerChaine($filtres['sport']);

        $dateFormat = DateTime::createFromFormat('Y-m-d', $filtres['date']);

        // Instanciation de la classe Validator avec les règles de validation
        $regles = [
            'nom' => ['longueur_min' => 2,'longueur_max' => 100],
            'sport' => ['longueur_min' => 2, 'longueur_max' => 100],
            'date' => ['date_format' => 'Y-m-d'],
            'note' => ['numeric' => true, 'min' => 0, 'max' => 5],
            'participants' => ['integer' => true, 'min' => 0, 'max' => 100],
        ];
        $validator = new Validator($regles);
        $donnees = [
            'nom' => $filtres['nom'],
            'sport' => $filtres['sport'],
            'date' => $dateFormat,
            'note' => $filtres['note'],
            'participants' => $filtres['participants'],
            
        ];

        // Validation des données du formulaire
        if (!$validator->valider($donnees)) {
            return $validator->getMessagesErreurs(); // Retourner les messages d'erreurs s'il y en a
        }

        // Récupérer la liste des coachs ayant des séances disponibles
        $managerCoach = new CoachDao($this->getPdo());
        $coachs = $managerCoach->findAllWithDetails($filtres);
        $coachsTab = $this->getCoachData($coachs);

        // Récupérer les tarifs min et max
        $managerCreneau = new CreneauDao($this->getPdo());
        $minTarif = $managerCreneau->fetchMinTarif();
        $maxTarif = $managerCreneau->fetchMaxTarif();

        // Chargement du template index
        $template = $this->getTwig()->load('rechercher.html.twig');

        // Affichage de la page
        echo $template->render([
            'menu' => 'Recherche',
            'description' => 'Page de recherche pour FitPulse',
            'coachs' => $coachsTab, // Liste des coachs avec leurs informations
            'maxTarif' => $maxTarif, // Tarif maximum pour le budget
            'minTarif' => $minTarif, // Tarif minimum pour le budget
            'filtres' => $filtres, // Filtres de recherche
        ]);
    }

    /**
     * Convertit les données du coach en un tableau associatif
     *
     * @param array $coachs Tableau des objets coachs à transformer
     * @return array Tableau associatif des coachs
     */
    private function getCoachData(array $coachs): array
    {
        $coachData = [];

        foreach ($coachs as $coach) {
            $coachData[] = [
                'id' => $coach->getId(),
                'contact' => $coach->getContact(),
                'description' => $coach->getDescription(),
                'lieuCours' => $coach->getLieuCours(),
                'estVerifie' => $coach->getEstVerifie(),
                'emailPaypal' => $coach->getEmailPaypal(),
                'idUtilisateur' => $coach->getIdUtilisateur(),
                'note' => $coach->getNote(),
                'disciplines' => array_map(function ($discipline) {
                    return [
                        'nom' => $discipline->getNom(),
                    ];
                }, $coach->getDisciplines()),
                'utilisateur' => [
                    'prenom' => $coach->getUtilisateur()->getPrenom(),
                    'nom' => $coach->getUtilisateur()->getNom(),
                ],
                'creneaux' => array_map(function ($creneau) {
                    return [
                        'id' => $creneau->getId(),
                        'dateDebut' => $creneau->getDateDebut()->format('Y-m-d H:i:s'),
                        'dateFin' => $creneau->getDateFin()->format('Y-m-d H:i:s'),
                    ];
                }, $coach->getCreneaux()),
            ];
        }

        return $coachData;
    }
}
