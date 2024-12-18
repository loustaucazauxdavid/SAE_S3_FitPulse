<?php
/**
 * @file controller_pratiquant.class.php
 * @brief Controller pour pratiquant
 */

/**
 * @brief Controller pour pratiquant
 * @details Gère les actions liées à pratiquant
 */
class ControllerPratiquant extends Controller{
    /**
     * Constructeur de la classe ControllerPratiquant
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>