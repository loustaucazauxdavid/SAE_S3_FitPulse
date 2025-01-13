<?php

/**
 * @file controller_creneau.class.php
 * @brief Controller pour creneau
 */

/**
 * @brief Controller pour creneau
 * @details Gère les actions liées à creneau
 */
class ControllerCreneau extends Controller
{
    /**
     * Constructeur de la classe ControllerCreneau
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader)
    {
        parent::__construct($twig, $loader);
    }

}
