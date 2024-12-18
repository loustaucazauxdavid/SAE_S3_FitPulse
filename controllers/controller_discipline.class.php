<?php
/**
 * @file controller_discipline.class.php
 * @brief Controller pour discipline
 */

/**
 * @brief Controller pour discipline
 * @details Gère les actions liées à discipline
 */
class ControllerDiscipline extends Controller{
    /**
     * Constructeur de la classe ControllerDiscipline
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>