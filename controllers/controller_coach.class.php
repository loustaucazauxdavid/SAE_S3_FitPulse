<?php

/**
 * @file controller_coach.class.php
 * @brief Controller pour les coachs
 */

/**
 * @brief Controller pour les coachs
 * @details Gère les actions liées aux coachs
 */
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
        $filters = [
            'date' => isset($_GET['date']) ? $_GET['date'] : null,
            'note' => isset($_GET['note']) ? $_GET['note'] : null,
            'search_name' => isset($_GET['search_name']) ? $_GET['search_name'] : null,
            'budget' => isset($_GET['budget']) ? $_GET['budget'] : null,
            'seance_type' => isset($_GET['seance_type']) ? $_GET['seance_type'] : [],
            'participants' => isset($_GET['participants']) ? $_GET['participants'] : null,
        ];
        
        // Récupérer la liste des coachs ayant des séances disponibles
        $managerCoach = new CoachDao($this->getPdo());
        $coachs = $managerCoach->findAllWithDetails($filters);
        $coachsTab = $this->serializeCoachData($coachs);

        // Récupérer les tarifs min et max
        $managerCreneau = new CreneauDao($this->getPdo());
        $minTarif = (int) round($managerCreneau->fetchMinTarif());
        $maxTarif = (int) round($managerCreneau->fetchMaxTarif());

        // Chargement du template index
        $template = $this->getTwig()->load('rechercher.html.twig');

        // Affichage de la page
        echo $template->render([
            'menu' => 'Recherche',
            'description' => 'Page de recherche pour FitPulse',
            'estConnecte' => false, // Change à true si l'utilisateur est connecté
            'coachs' => $coachsTab, // Liste des coachs avec leurs informations
            'maxTarif' => $maxTarif, // Tarif maximum pour le budget
            'minTarif' => $minTarif, // Tarif minimum pour le budget
        ]);

    }

    /**
     * Convertit les données du coach en un tableau associatif
     *
     * @param array $coachs Tableau des objets coachs à sérialiser
     * @return array Tableau associatif des coachs
     */
    private function serializeCoachData(array $coachs): array
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