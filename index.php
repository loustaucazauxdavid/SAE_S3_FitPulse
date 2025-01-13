<?php
/**
 * @file index.php
 * @brief Point d'entrée de l'application
 */

session_set_cookie_params([
    'httponly' => true,  // Empêche l'accès JavaScript aux cookies de session (atténue les attaques XSS).
    'secure' => false, // Pour des buts de démonstration, on ne force pas l'utilisation de HTTPS.
    //'secure' => true,    // Assure que les cookies sont uniquement transmis via HTTPS.
    'samesite' => 'Strict' // Empêche l'envoi de cookies avec des requêtes intersites (atténue les attaques CSRF).
]);

// Démarrer la session, commune à toutes les pages à travers ce fichier index.php.
// L'état de la session doit être validé avant chaque manipulation de celle-ci.
session_start(); 

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