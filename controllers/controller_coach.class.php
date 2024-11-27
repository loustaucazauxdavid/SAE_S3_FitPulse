<?php 
/**
 * @file controller_coach.class.php
 * @brief Controller pour les coachs
 */

/**
 * @brief Controller pour les coachs
 * @details Gère les actions liées aux coachs
 */
class ControllerCoach extends Controller{
    /**
     * Constructeur de la classe ControllerCoach
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }  

    /**
     * @brief Liste les coachs
     * @return void
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
