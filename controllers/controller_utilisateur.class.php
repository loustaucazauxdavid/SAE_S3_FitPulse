<?php
/**
 * @file controller_utilisateur.class.php
 * @brief Controller pour utilisateur
 */

/**
 * @brief Controller pour utilisateur
 * @details Gère les actions liées à utilisateur
 */
class ControllerUtilisateur extends Controller{
    /**
     * Constructeur de la classe ControllerUtilisateur
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>