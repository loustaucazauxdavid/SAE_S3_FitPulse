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


    public function getAvailableCoachs() : array
    {
        // Récupérer la liste des coachs ayant des séances disponibles
        $managerCoach = new CoachDao($this->getPdo());

        // Récupération des données du formulaire
        $filters = [
            'date' => isset($_POST['date']) ? $_POST['date'] : null,
            'note' => isset($_POST['note']) ? $_POST['note'] : null,
            'search_name' => isset($_POST['search_name']) ? $_POST['search_name'] : null,
            'budget' => isset($_POST['budget']) ? $_POST['budget'] : null,
            'seance_type' => isset($_POST['seance_type']) ? $_POST['seance_type'] : [],
            'participants' => isset($_POST['participants']) ? $_POST['participants'] : null,
        ];
        
        // Appel à la méthode findAllWithDetails en passant les filtres
        $coachs = $managerCoach->findAllWithDetails($filters);

        // Sérialiser les données des coachs
        $coachData = $this->serializeCoachData($coachs);

        return $coachData;

    }

    /**
     * Sérialise les données des coachs avant de les passer à Twig
     *
     * @param array $coachs Tableau des objets coachs à sérialiser
     * @return array Tableau des coachs sérialisés
     */
    private function serializeCoachData(array $coachs): array
    {
        $coachData = [];

        foreach ($coachs as $coach) {
            // Convertir les données du coach en un tableau associatif
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
                }, $coach->getCreneaux()), // Assurez-vous de formater les dates au besoin
            ];
        }

        return $coachData;
    }

}