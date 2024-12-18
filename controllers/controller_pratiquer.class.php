<?php
/**
 * @file controller_pratiquer.class.php
 * @brief Controller pour pratiquer
 */

/**
 * @brief Controller pour pratiquer
 * @details Gère les actions liées à pratiquer
 */
class ControllerPratiquer extends Controller{
    /**
     * Constructeur de la classe ControllerPratiquer
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>