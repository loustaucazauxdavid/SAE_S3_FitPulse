<?php
/**
 * @file controller_commenter.class.php
 * @brief Controller pour commenter
 */

/**
 * @brief Controller pour commenter
 * @details Gère les actions liées à commenter
 */
class ControllerCommenter extends Controller{
    /**
     * Constructeur de la classe ControllerCommenter
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>