<?php

//Ajout du code commun à toutes les pages
require_once 'include.php';

try  {
    if (isset($_GET['controleur'])){
        $controllerName=$_GET['controleur'];
    }else{
        $controllerName='';
    }

    if (isset($_GET['methode'])){
        $methode=$_GET['methode'];
    }else{
        $methode='';
    }

    //Gestion de la page d'accueil par défaut
    if ($controllerName == '' && $methode ==''){
        $controllerName='categorie';
        $methode='lister';
    }

    if ($controllerName == '' ){
        throw new Exception('Le controleur n\'est pas défini');
    }

    if ($methode == '' ){
        throw new Exception('La méthode n\'est pas définie');
    }

    $controller = ControllerFactory::getController($controllerName, $loader, $twig);
  
    $controller->call($methode);
}catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
}



// $pdo = Bd::getInstance()->getConnexion();

// //recupération des catégories
// $managerCategorie = new CategorieDao($pdo);
// $tableau = $managerCategorie->findAllAssoc();
// $categories = $managerCategorie->hydrateAll($tableau);

// //Choix du template
// $template = $twig->load('index.html.twig');


// //Affichage de la page
// echo $template->render(array(
//     'categories' => $categories,
//     'menu' => 'categories',
//     // 'description' => "Le site des recettes de cuisine de l'IUT de Bayonne"
// ));
