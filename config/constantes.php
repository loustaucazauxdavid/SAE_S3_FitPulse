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
define('PREFIXE_TABLE', 'fitpulse_'); /// Préfixe des tables : Nom de la base de données
define('TABLE_COMMENTER', PREFIXE_TABLE . "commenter"); /// Table commenter
define('TABLE_COACH', PREFIXE_TABLE . "Coach"); /// Table Coach
define('TABLE_CRENEAU', PREFIXE_TABLE . "creneau"); /// Table creneau
define('TABLE_DISCIPLINE', PREFIXE_TABLE . "discipline"); /// Table discipline
define('TABLE_DOSSIER', PREFIXE_TABLE . "dossier"); /// Table dossier
define('TABLE_PRATIQUANT', PREFIXE_TABLE . "pratiquant"); /// Table pratiquant
define('TABLE_PRATIQUER', PREFIXE_TABLE . "pratiquer"); /// Table pratiquer
define('TABLE_PROPOSER_DANS', PREFIXE_TABLE . "proposer_dans"); /// Table proposer_dans
define('TABLE_SALLE_DE_SPORT', PREFIXE_TABLE . "salle_de_sport"); /// Table salle_de_sport
define('TABLE_SEANCE', PREFIXE_TABLE . "seance"); /// Table seance
define('TABLE_UTILISATEUR', PREFIXE_TABLE . "Utilisateur"); /// Table utilisateur

// Constante de la partie vue
define('WEBSITE_TITLE', 'FitPulse'); /// Titre du site
define('WEBSITE_VERSION', '0.1'); /// Version du site
define('WEBSITE_DESCRIPTION', 'Application Sport et Bien-être permettant d\'organiser de mettre en relation des Coachs sportifs et des Pratiquants pour organiser des séances d\'entraînement'); /// Description du site
define('WEBSITE_LANGUAGE', 'fr'); /// Langue du site
?> 