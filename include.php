<?php

//Ajout de l'autoload de composer
require_once 'vendor/autoload.php';

//Ajout du fichier constantes qui permet de configurer le site
require_once 'config/constantes.php';

//Ajout du code pour initialiser twig
require_once 'config/twig.php';

//Ajout du modèle qui gère la connexion mysql
require_once 'modeles/bd.class.php';


//Ajout des contrôleurs
require_once 'controllers/controller.class.php';
require_once 'controllers/controller_factory.class.php';
require_once 'controllers/controller_categorie.class.php';

//Ajout des modèles
require_once 'modeles/categorie.class.php';
require_once 'modeles/categorie.dao.php';
