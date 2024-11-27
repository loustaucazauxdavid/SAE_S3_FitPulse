<?php
/**
 * @file controller.class.php
 * @brief Classe Controller
 */

/**
 * @brief Classe Controller
 * @details Classe abstraite qui permet de gérer les contrôleurs
 */
class Controller{
    private PDO $pdo;
    private \Twig\Loader\FilesystemLoader $loader;
    private \Twig\Environment $twig;
    private ?array $get = null;
    private ?array $post =null;

    /**
     * Constructeur de la classe Controller
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        $db = Bd::getInstance();
        $this->pdo = $db->getConnexion();

        $this->loader = $loader;
        $this->twig = $twig;

        if (isset($_GET) && !empty($_GET)){
            $this->get = $_GET;
        }
        if (isset($_POST) && !empty($_POST)){
            $this->post = $_POST;
        }
    }

    /**
     * Méthode abstraite call
     * @param string $methode Nom de la méthode à appeler
     * @return mixed
     */
    public function call(string $methode): mixed{

        if (!method_exists($this, $methode)){
            throw new Exception("La méthode $methode n'existe pas dans le controller ". __CLASS__ ); 
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
}




