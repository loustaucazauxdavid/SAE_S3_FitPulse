<?php
/**
 * @file controller_seance.class.php
 * @brief Controller pour seance
 */

/**
 * @brief Controller pour seance
 * @details Gère les actions liées à seance
 */
class ControllerSeance extends Controller{
    /**
     * Constructeur de la classe ControllerSeance
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>