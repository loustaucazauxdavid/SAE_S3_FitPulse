<?php
/**
 * @file constantes.php
 * @brief Fichier contenant les constantes du site
 */

// Constante de la partie contrôleur
define('DB_HOST', '192.168.1.100:3306'); /// Adresse de l'hôte
define('DB_NAME', 'fitpulse'); /// Nom de la base de données
define('DB_USER', 'fitpulse'); /// Nom d'utilisateur
define('DB_PASS', 'fitpulse'); /// Mot de passe

// Tables
define('PREFIXE_TABLE', 'fitpulse_');
define('TABLE_COMMENTER', PREFIXE_TABLE . "commenter");
define('TABLE_COACH', PREFIXE_TABLE . "Coach");


// Constante de la partie vue
define('WEBSITE_TITLE', 'FitPulse'); /// Titre du site
define('WEBSITE_VERSION', '0.1'); /// Version du site
define('WEBSITE_DESCRIPTION', 'Application Sport et Bien-être permettant d\'organiser de mettre en relation des Coachs sportifs et des Pratiquants pour organiser des séances d\'entraînement'); /// Description du site
define('WEBSITE_LANGUAGE', 'fr'); /// Langue du site
?> 