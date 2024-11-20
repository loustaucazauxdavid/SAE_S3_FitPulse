<?php 
/**
 * @file controller_coach.class.php
 * @brief Controller pour les coachs
 */

class ControllerCoach extends Controller{
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }  

    /**
     * Liste les coachs sur la page d'accueil.
     */
    public function lister(){
        // Recupération de tous les coachs (Test avant de lister les coachs par notes)
        $managerCoach = new CoachDao($this->getPdo());
        $listeCoachsAssoc = $managerCoach->findAllAssoc();
        $listeCoachs = $managerCoach->hydrateAll($listeCoachsAssoc);
        
        // Chargement du template index
        $template = $this->getTwig()->load('index.html.twig');

        // Affichage de la page
        echo $template->render(array(
            'listeCoachs' => $listeCoachs,
        ));
    }

}
