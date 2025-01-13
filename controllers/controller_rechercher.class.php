<?php

/**
 * @file controller_recherche.class.php
 * @brief Controller pour la recherche
 */

/**
 * @brief Controller pour la recherche
 * @details Gère les actions liées à la page de recherche
 */
class ControllerRechercher extends Controller
{
    /**
     * Constructeur de la classe ControllerRecherche
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader)
    {
        parent::__construct($twig, $loader);
    }

    /**
     * Méthode principale pour afficher la page de recherche
     */
    public function afficherPageRecherche()
    {

        $controllerCoach = new ControllerCoach($this->getTwig(), $this->getLoader());
        $controllerCreneau = new ControllerCreneau($this->getTwig(), $this->getLoader());

        $coachs = $controllerCoach->getAvailableCoachs();
        $tarifs = $controllerCreneau->getBudget();

        // Charger le template 'rechercher.html.twig'
        $template = $this->getTwig()->load('rechercher.html.twig');

        // Passer toutes les données nécessaires à Twig
        echo $template->render([
            'menu' => 'Recherche',
            'description' => 'Page de recherche pour FitPulse',
            'estConnecte' => false, // Change à true si l'utilisateur est connecté
            'coachs' => $coachs, // Liste des coachs avec leurs informations
            'maxTarif' => $tarifs['max'], // Tarif maximum pour le budget
            'minTarif' => $tarifs['min'], // Tarif minimum pour le budget
        ]);
    }
}
