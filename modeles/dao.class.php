<?php
class Dao {
    protected ?PDO $pdo;
    protected array $tables;

    /**
     * Constructeur pour initialiser les propriétés communes
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(?PDO $pdo = null) {
        $this->pdo = $pdo;
        $config = Config::getInstance();
        $this->tables = $config->getTables();
    }

    /**
     * Getter pour PDO
     * @return PDO|null
     */
    public function getPdo(): ?PDO {
        return $this->pdo;
    }

    /**
     * Setter pour PDO
     * @param PDO $pdo
     */
    public function setPdo(PDO $pdo): void {
        $this->pdo = $pdo;
    }
}
?>