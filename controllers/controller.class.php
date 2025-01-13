<?php

require_once 'utils/session.php';

/**
 * @brief Classe Controller
 * @details Classe abstraite qui permet de gérer les contrôleurs
 */
class Controller{
    private PDO $pdo;
    private \Twig\Loader\FilesystemLoader $loader;
    private \Twig\Environment $twig;
    private ?array $get = null;
    private ?array $post = null;
    private ?array $files = null;

    /**
     * Constructeur de la classe Controller
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        // Initialiser la connexion PDO
        $db = Bd::getInstance();
        $this->pdo = $db->getConnexion();

        // Initialiser les variables membres
        $this->loader = $loader;
        $this->twig = $twig;
        
        // Variables globales Twig - Base template
        $this->twig->addGlobal('estConnecte', estConnecte());

        verifierSessionActive(); 
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        if ($utilisateur && isset($utilisateur['photo'])) { $utilisateur['photo'] = $this->convertirEnCheminClient($utilisateur['photo']); } // Convertir le chemin absolu de l'image en chemin relatif client
        $this->twig->addGlobal('utilisateur', $utilisateur); 

        $config = Config::getInstance();
        $this->twig->addGlobal('website_language', $config->getAppConfig('language'));
        $this->twig->addGlobal('website_title', $config->getAppConfig('title'));
        $this->twig->addGlobal('website_description', $config->getAppConfig('description'));
        $this->twig->addGlobal('website_version', $config->getAppConfig('version'));
    
        // Variables des données passés en arguments
        if (isset($_GET) && !empty($_GET)){
            $this->get = $_GET;
        }
        if (isset($_POST) && !empty($_POST)){
            $this->post = $_POST;
        }
        if (isset($_FILES) && !empty($_FILES)){
            $this->files = $_FILES;
        }
    }

    /**
     * Méthode abstraite call
     * @param string $methode Nom de la méthode à appeler
     * @return mixed
     */
    public function call(string $methode): mixed{

        if (!method_exists($this, $methode) || !is_callable([$this, $methode])) {
            throw new Exception("La méthode $methode n'existe pas ou n'est pas accessible dans le controlleur " . __CLASS__);
        }

        return $this->$methode(); 
    }

    /**
     * Getter de la variable membre pdo
     */
    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    /**
     * Setter de la variable membre pdo
     */
    public function setPdo(?PDO $pdo):void
    {
        $this->pdo = $pdo;
    }

    /**
     * Getter de la variable membre loader
     */ 
    public function getLoader(): \Twig\Loader\FilesystemLoader
    {
        return $this->loader;
    }

    /**
     * Setter de la variable membre loader
     */
    public function setLoader(\Twig\Loader\FilesystemLoader $loader) :void
    {
        $this->loader = $loader;

    }

    /**
     * Getter de la variable membre twig
     */ 
    public function getTwig(): \Twig\Environment
    {
        return $this->twig;
    }

    /**
     * Setter de la variable membre twig
     */
    public function setTwig(\Twig\Environment $twig): void
    {
        $this->twig = $twig;

    }

    /**
     * Getters et setters des variables get et post
     */
    public function getGet(): ?array
    {
        return $this->get;
    }

    /**
     * Setters de la variable get
     */ 
    public function setGet(?array $get): void
    {
        $this->get = $get;

    }

    /**
     * Getters de la variable post
     */ 
    public function getPost(): ?array
    {
        return $this->post;
    }

    /**
     * Setters de la variable post
     */ 
    public function setPost(?array $post): void
    {
        $this->post = $post;
    }

    /**
     * Getters de la variable files
     */ 
    public function getFiles(): ?array
    {
        return $this->files;
    }

    /**
     * Setters de la variable files
     */ 
    public function setFiles(?array $files): void
    {
        $this->files = $files;
    }

    /**
     * Convertit un chemin absolu en chemin relatif pour le client.
     */
    private function convertirEnCheminClient($chemin): string
    {
        return str_replace(APP_ROOT . '/', '', $chemin);
    }
}
