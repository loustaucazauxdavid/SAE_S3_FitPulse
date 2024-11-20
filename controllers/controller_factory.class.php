<?php
/**
 * @file controller_factory.class.php
 * @brief Factory de controleurs
 */

/**
 * @brief Classe ControllerFactory
 * @details Cette classe permet de créer un controleur en fonction de son nom
 */
class ControllerFactory
{
    /**
     * @brief Méthode statique getController
     * @param string $controleur Nom du controleur
     * @param \Twig\Loader\FilesystemLoader $loader Loader de fichiers
     * @param \Twig\Environment $twig Environnement Twig
     * @return Controller Controleur créé
     */
    public static function getController($controleur, \Twig\Loader\FilesystemLoader $loader, \Twig\Environment $twig)
    {
        $controllerName="Controller".ucfirst($controleur);
        if (!class_exists($controllerName)) {
            throw new Exception("Le controleur $controllerName n'existe pas");
        }
        return new $controllerName($twig, $loader);

    }
}