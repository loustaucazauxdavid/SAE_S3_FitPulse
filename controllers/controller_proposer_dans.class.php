<?php
/**
 * @file controller_proposer_dans.class.php
 * @brief Controller pour proposer_dans
 */

/**
 * @brief Controller pour proposer_dans
 * @details Gère les actions liées à proposer_dans
 */
class ControllerProposerDans extends Controller{
    /**
     * Constructeur de la classe ControllerProposerDans
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>