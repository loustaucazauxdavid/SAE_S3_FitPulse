<?php
/**
 * @file include.php
 * @brief Fichier d'inclusion des fichiers nécessaires au fonctionnement du site
 */

// Ajout de l'autoload de composer
require_once 'vendor/autoload.php';

// Ajout du fichier de config qui permet de configurer le site
require_once 'config/constantes.php';
require_once 'utils/config.php';

// Ajout du code pour initialiser twig
require_once 'config/twig.php';

// Ajout du modèle qui gère la connexion mysql
require_once 'modeles/bd.class.php';

// Ajout des contrôleurs
require_once 'controllers/controller.class.php';
require_once 'controllers/controller_factory.class.php';
require_once 'controllers/controller_coach.class.php';
require_once 'controllers/controller_commenter.class.php';
require_once 'controllers/controller_creneau.class.php';
require_once 'controllers/controller_discipline.class.php';
require_once 'controllers/controller_dossier.class.php';
require_once 'controllers/controller_pratiquant.class.php';
require_once 'controllers/controller_pratiquer.class.php';
require_once 'controllers/controller_proposer_dans.class.php';
require_once 'controllers/controller_salle_de_sport.class.php';
require_once 'controllers/controller_seance.class.php';
require_once 'controllers/controller_utilisateur.class.php';

// Ajout des modèles classes
require_once 'modeles/coach.class.php';
require_once 'modeles/coachNote.class.php';
require_once 'modeles/creneau.class.php';
require_once 'modeles/discipline.class.php';
require_once 'modeles/dossier.class.php';
require_once 'modeles/salle_de_sport.class.php';
require_once 'modeles/seance.class.php';  
require_once 'modeles/commenter.class.php';
require_once 'modeles/pratiquant.class.php';
require_once 'modeles/pratiquer.class.php';
require_once 'modeles/proposer_dans.class.php';
require_once 'modeles/utilisateur.class.php';


// Ajout des modèles DAO
require_once 'modeles/dao.class.php';
require_once 'modeles/coach.dao.php';
require_once 'modeles/coachNote.dao.php';
require_once 'modeles/creneau.dao.php';
require_once 'modeles/discipline.dao.php';
require_once 'modeles/dossier.dao.php';
require_once 'modeles/salle_de_sport.dao.php';
require_once 'modeles/seance.dao.php';  
require_once 'modeles/commenter.dao.php';
require_once 'modeles/pratiquant.dao.php';
require_once 'modeles/pratiquer.dao.php';
require_once 'modeles/proposer_dans.dao.php';
require_once 'modeles/utilisateur.dao.php';
