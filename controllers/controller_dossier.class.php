<?php
/**
 * @file controller_dossier.class.php
 * @brief Controller pour dossier
 */

/**
 * @brief Controller pour dossier
 * @details Gère les actions liées à dossier
 */
class ControllerDossier extends Controller{
    /**
     * Constructeur de la classe ControllerDossier
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>