<?php
/**
 * @file discipline.dao.php
 * @brief DAO de la table Discipline
 */

require_once 'config/constantes.php';

/**
 * @brief Classe DisciplineDao
 * @details DAO de la table Discipline
 */
class DisciplineDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe DisciplineDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Getter de la variable membre pdo
     * @return PDO|null
     */
    public function getPdo(): ?PDO {
        return $this->pdo;
    }

    /**
     * Setter de la variable membre pdo
     * @param PDO $pdo
     */
    public function setPdo(PDO $pdo): void {
        $this->pdo = $pdo;
    }

    /**
     * Récupère une discipline par son ID.
     * @param int $id L'ID de la discipline à récupérer.
     * @return Discipline|null La discipline récupérée.
     */
    public function find(int $id): ?Discipline {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_DISCPLINE . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Discipline::class);
        return $stmt->fetch();
    }

    /**
     * Récupère toutes les disciplines.
     * @return Discipline[] Les disciplines récupérées.
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_DISCPLINE);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Discipline::class); 
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Discipline
     * @param array $pratiquerAssoc Le tableau associatif représentant un objet Discipline
     * @return Pratiquant L'objet Discipline hydraté
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