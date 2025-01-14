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
        $managerCoach = new CoachDao($this->getPdo());

        $filtres = [];

        // Récupérer les filtres envoyés via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filtres['budget'] = $_POST['budget'] ?? null;
            $filtres['discipline'] = $_POST['discipline'] ?? null;
            $filtres['date'] = $_POST['date'] ?? null;
            $filtres['note'] = $_POST['note'] ?? null;
            $filtres['nom'] = $_POST['nom'] ?? null;
            $filtres['sport'] = $_POST['sport'] ?? null;
            $filtres['seance_type'] = $_POST['seance_type'] ?? [];
            $filtres['participants'] = $_POST['participants'] ?? null;

        }

        // Récupérer la liste des coachs ayant des séances disponibles
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
            'estConnecte' => false, // Change à true si l'utilisateur est connecté
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
