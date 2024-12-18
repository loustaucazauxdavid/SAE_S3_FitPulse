<?php
/**
 * @file constantes.php
 * @brief Fichier contenant les constantes du site
 */

// Constante de la partie contrôleur
define('DB_HOST', 'lakartxela'); /// Adresse de l'hôte
define('DB_NAME', 'ubergos_pro'); /// Nom de la base de données
define('DB_USER', 'ubergos_pro'); /// Nom d'utilisateur
define('DB_PASS', 'ubergos_pro'); /// Mot de passe

// Tables
define('PREFIXE_TABLE', 'fitpulse_');
define('TABLE_COMMENTER', PREFIXE_TABLE . "commenter");
define('TABLE_COACH', PREFIXE_TABLE . "Coach");
define('TABLE_CRENEAU', PREFIXE_TABLE . "creneau");
define('TABLE_DISCIPLINE', PREFIXE_TABLE . "discipline");
define('TABLE_DOSSIER', PREFIXE_TABLE . "dossier");
define('TABLE_PRATIQUANT', PREFIXE_TABLE . "pratiquant");
define('TABLE_PRATIQUER', PREFIXE_TABLE . "pratiquer");
define('TABLE_PROPOSER_DANS', PREFIXE_TABLE . "proposer_dans");
define('TABLE_SALLE_DE_SPORT', PREFIXE_TABLE . "salle_de_sport");
define('TABLE_SEANCE', PREFIXE_TABLE . "seance");
define('TABLE_UTILISATEUR', PREFIXE_TABLE . "utilisateur");

// Constante de la partie vue
define('WEBSITE_TITLE', 'FitPulse'); /// Titre du site
define('WEBSITE_VERSION', '0.1'); /// Version du site
define('WEBSITE_DESCRIPTION', 'Application Sport et Bien-être permettant d\'organiser de mettre en relation des Coachs sportifs et des Pratiquants pour organiser des séances d\'entraînement'); /// Description du site
define('WEBSITE_LANGUAGE', 'fr'); /// Langue du site
?> 