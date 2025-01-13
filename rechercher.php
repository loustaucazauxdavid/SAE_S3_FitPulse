<?php
require_once 'include.php';

// Création du contrôleur
$controller = new ControllerRechercher($twig, $loader);

// Appel à la méthode pour récupérer les coachs disponibles
$controller->afficherPageRecherche();

?>
