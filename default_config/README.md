# Dossier des modèles des fichiers de configuration de l'application ("default_config")
Ce dossier contient les modèles des fichiers de configuration de l'application.

Par défaut, ce dossier contient des fichiers de configuration génériques. Vous devez les copier dans le dossier "config" à la racine de l'application et les personnaliser pour adapter l'application à vos besoins. **Les informations de connexion à la base de données dans le fichier "database.json" doivent être spécifiées pour que l'application fonctionne correctement.**



## Constantes : `constantes.php`

- **APP_ROOT"** : Chemin absolu vers le dossier racine de l'application. **Cette constante devra être adaptée si la hiérarchie des dossiers change.**



## Configuration Twig : `twig.php`

Le fichier de configuration Twig contient les paramètres nécessaires pour configurer le moteur de templates Twig utilisé par l'application.
**Le mode debug devrait être désactivé lorsque déployé en environnement de production.**



## Paramètres liés à la base de données : `database.json`

Le fichier de configuration de la base de données contient les paramètres nécessaires pour se connecter à la base de données MySQL et définir les tables utilisées par l'application.

- **"host"** : *A définir, obligatoire !* L'adresse du serveur de base de données et le port à utiliser. 
- **"name"** : *A définir, obligatoire !* Le nom de la base de données à laquelle l'application doit se connecter. 
- **"user"** et **"pass"** : *A définir, obligatoire !* Les identifiants de connexion à la base de données. L'application utilise ces informations pour s'authentifier auprès de la base de données. 

- **"tables"** : Un objet contenant les noms des tables dans la base de données utilisées par l'application. Ces tables sont liées aux différentes fonctionnalités de l'application :
  - **"commenter"** : Table pour les commentaires.
  - **"coach"** : Table pour les coachs.
  - **"creneau"** : Table pour les créneaux horaires.
  - **"discipline"** : Table pour les disciplines.
  - **"dossier"** : Table pour les dossiers.
  - **"pratiquant"** : Table pour les pratiquants.
  - **"pratiquer"** : Table pour les relations de pratique (quels pratiquants pratiquent quelle discipline).
  - **"proposer_dans"** : Table pour les propositions dans différents contextes.
  - **"salle_de_sport"** : Table pour les salles de sport.
  - **"seance"** : Table pour les séances d'entraînement.
  - **"utilisateur"** : Table pour les utilisateurs de l'application.
  
- **"tables_prefix"** : Un préfixe qui est ajouté à chaque nom de table. Cela permet de mieux organiser et différencier les tables, en particulier dans une base de données partagée. Par défaut, toutes les tables de l'application commenceront par "fitpulse_".

Assurez-vous de mettre à jour ces paramètres selon vos propres configurations de base de données pour que l'application fonctionne correctement.



## Paramètres liés à l'application': `application.json`

- **"title"** : Le titre de l'application.
- **"version"** : La version actuelle de l'application.
- **"description"** : Une brève description de l'application.
- **"language"** : La langue de l'application.



## Paramètres liés à l'authentification : `authentification.json`

- **"max_failed_logins"** : Le nombre maximal de tentatives de connexion échouées autorisées avant de bloquer l'accès à l'utilisateur.
- **"lockout_duration"** : La durée du blocage en secondes après que le nombre maximal de tentatives de connexion échouées a été atteint.

