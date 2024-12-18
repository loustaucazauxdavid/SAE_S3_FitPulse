<?php 
/**
 * @file controller_coachNote.class.php
 * @brief Controller pour coachNote
 */

/**
 * @brief Controller pour coachNote
 * @details Gère les actions liées à coachNote
 */
class ControllerCoachNote extends Controller{
    /**
     * Constructeur de la classe ControllerCoachNote
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }
}
?>
