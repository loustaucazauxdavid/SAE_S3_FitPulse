<?php
/**
 * @file discipline.dao.php
 * @brief DAO de la table Discipline
 */

/**
 * @brief Classe DisciplineDao
 * @details DAO de la table Discipline
 */
class DisciplineDao extends Dao {
    /**
     * Constructeur de la classe DisciplineDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(?PDO $pdo = null) {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
    }

    /**
     * Récupère une discipline par son ID.
     * @param int $id L'ID de la discipline à récupérer.
     * @return Discipline|null La discipline récupérée.
     */
    public function find(int $id): ?Discipline {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->tables['discipline'] . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Discipline::class);
        return $stmt->fetch();
    }

    /**
     * Récupère toutes les disciplines.
     * @return Discipline[] Les disciplines récupérées.
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . $this->tables['discipline']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Discipline::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Discipline
     * @param array $disciplineAssoc Le tableau associatif représentant un objet Discipline
     * @return Discipline L'objet Discipline hydraté
     */
    public function hydrate(array $disciplineAssoc): Discipline {
        $discipline = new Discipline();
        $discipline->setId($disciplineAssoc['id']);
        $discipline->setNom($disciplineAssoc['nom']);
        return $discipline;
    }

    /**
     * Méthode pour hydrater un tableau d'objets Discipline
     * @param array $disciplinesAssoc Le tableau associatif représentant des objets Discipline
     * @return Discipline[] Les disciplines hydratées
     */
    public function hydrateAll(array $disciplinesAssoc): array {
        $disciplines = [];
        foreach ($disciplinesAssoc as $disciplineAssoc) {
            $disciplines[] = $this->hydrate($disciplineAssoc);
        }
        return $disciplines;
    }
}
