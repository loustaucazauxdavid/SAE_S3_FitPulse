<?php

class Config
{
    private static $instance = null;
    private $config;
    private static $dossierConfig = APP_ROOT . '/config/';

    // Le constructeur est privé pour appliquer le pattern singleton
    private function __construct()
    {
        $this->config = [];

        // Charger tous les fichiers de configuration par défaut
        $this->config = array_merge($this->config, json_decode(file_get_contents(self::$dossierConfig . '/database.json'), true));
        $this->config = array_merge($this->config, json_decode(file_get_contents(self::$dossierConfig . '/application.json'), true));
        $this->config = array_merge($this->config, json_decode(file_get_contents(self::$dossierConfig . '/authentification.json'), true));
    }    

    // Méthode pour obtenir l'instance unique
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    // Méthode pour récupérer un paramètre de configuration
    public function get($key)
    {
        return $this->config[$key] ?? null;
    }

    // Accès aux différentes sections de la configuration
    public function getDatabaseConfig() {
        return $this->config['db'] ?? [];
    }

    public function getAppConfig() {
        return $this->config['app'] ?? [];
    }

    public function getAuthConfig() {
        return $this->config['auth'] ?? [];
    }

     // Récupérer les noms des tables avec leur préfixe
    public function getTables()
    {
        $tables = $this->config['db']['tables'] ?? [];
        $prefix = $this->config['db']['tables_prefix'] ?? '';
        
        // Ajouter le préfixe aux noms de tables
        foreach ($tables as $key => $value) {
            $tables[$key] = $prefix . $value;
        }

        return $tables;
    }
}
?>
