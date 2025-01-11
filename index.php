<?php
/**
 * @file index.php
 * @brief Point d'entrée de l'application
 */

session_start(); // Démarrer la session

require_once 'include.php';

try 
{
    if (isset($_GET['controleur'])){
        $controllerName = $_GET['controleur'];
    }else{
        $controllerName = '';
    }

    if (isset($_GET['methode'])){
        $methode=$_GET['methode'];
    }else{
        $methode = '';
    }

    //Gestion de la page d'accueil par défaut
    if ($controllerName == '' && $methode ==''){
        $controllerName = 'coach';
        $methode = 'lister';
    }

    if ($controllerName == '' ){
        throw new Exception('Le controleur n\'est pas défini');
    }

    if ($methode == '' ){
        throw new Exception('La méthode n\'est pas définie');
    }

    $controller = ControllerFactory::getController($controllerName, $loader, $twig);
  
    $controller->call($methode);
}
catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
}