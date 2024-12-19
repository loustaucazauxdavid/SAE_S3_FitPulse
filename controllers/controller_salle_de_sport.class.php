<?php
/**
 * @file controller_salle_de_sport.class.php
 * @brief Controller pour salle_de_sport
 */

/**
 * @brief Controller pour salle_de_sport
 * @details Gère les actions liées à salle_de_sport
 */
class ControllerSalleDeSport extends Controller{
    /**
     * Constructeur de la classe ControllerSalleDeSport
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>