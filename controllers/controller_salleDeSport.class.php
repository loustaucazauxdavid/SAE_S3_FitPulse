<?php
/**
 * @file controller_salleDeSport.class.php
 * @brief Controller pour salleDeSport
 */

/**
 * @brief Controller pour salleDeSport
 * @details Gère les actions liées à salleDeSport
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