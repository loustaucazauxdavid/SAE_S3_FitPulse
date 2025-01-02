<?php
require_once 'include.php';

// Création du contrôleur
$controller = new ControllerCoach($twig, $loader);

// Appel à la méthode pour récupérer les coachs disponibles
$controller->displayAvailableCoachs();
?>
