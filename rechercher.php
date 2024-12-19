<?php
require_once 'include.php';

// Définir les variables pour le template
$data = [
    'menu' => 'recherche', // Pour activer l'onglet "Recherche" dans le menu
    'description' => 'Page de recherche pour FitPulse',
    'estConnecte' => false, // Change à true si l'utilisateur est connecté
];

// Charger et afficher le template
echo $twig->render('rechercher.html.twig', $data);

