<?php
class Bd {
    private static ?Bd $instance = null;
    private ?PDO $pdo;

    /**
     * @brief Constructeur de la classe Bd
     * @details Permet de se connecter à la base de données en utilisant les paramètres configurés
     * @return void
     */
    private function __construct() {
        // Récupérer les paramètres de connexion depuis la configuration
        $config = Config::getInstance();
        $dbConfig = $config->getDatabaseConfig();
        
        try {
            // Connexion à la base de données avec les paramètres récupérés
            $this->pdo = new PDO(
                'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['name'] . ';charset=utf8',
                $dbConfig['user'],
                $dbConfig['pass']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connexion à la base de données échouée : ' . $e->getMessage());
        }
    }

    /**
     * @brief Méthode getInstance
     * @details Permet de récupérer l'instance de la classe Bd
     * @return Bd
     */
    public static function getInstance(): Bd {
        if (self::$instance == null) {
            self::$instance = new Bd();
        }
        return self::$instance;
    }

    /**
     * @brief Méthode getConnexion
     * @details Permet de récupérer la connexion à la base de données
     * @return PDO
     */
    public function getConnexion(): PDO {
        return $this->pdo;
    }

    /**
     * @brief Méthode __clone
     * @details Empêche le clonage de l'objet
     * @return void
     */
    private function __clone() {}

    /**
     * @brief Méthode __wakeup
     * @details Empêche la désérialisation de l'objet
     * @return void
     */
    public function __wakeup() {
        throw new Exception("Un singleton ne doit pas être désérialisé");
    }
}
?>