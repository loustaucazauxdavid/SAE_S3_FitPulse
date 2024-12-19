<?php
/**
 * @file seance.dao.php
 * @brief DAO de la table Seance
 */

require_once 'config/constantes.php';

/**
 * @brief Classe SeanceDao
 * @details DAO de la table Seance
 */
class SeanceDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe SeanceDao
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
     * Méthode pour trouver une séance
     * @param int $id L'identifiant de la séance
     * @return Seance|null La séance trouvée
     */
    public function find(int $id): ?Seance {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_SEANCE . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Seance::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer toutes les séances
     * @return Seance[] Les séances récupérées
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_SEANCE);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Seance::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater une séance
     * @param array $seanceAssoc Le tableau associatif représentant une séance
     * @return Seance La séance hydratée
     */
    public function hydrate(array $seanceAssoc): Seance {
        $seance = new Seance();
        $seance->setId($seanceAssoc['id']);
        $seance->setEstPaye($seanceAssoc['estPaye']);
        $seance->setEstAnnule($seanceAssoc['estAnnule']);
        return $seance;
    }

    /**
     * Méthode pour hydrater un tableau de séances
     * @param array $seancesAssoc Le tableau de tableau associatif de séances
     * @return Seance[] Le tableau d'objet Seance hydraté
     */
    public function hydrateAll(array $seancesAssoc): array {
        $seances = [];
        foreach ($seancesAssoc as $seanceAssoc) {
            $seances[] = $this->hydrate($seanceAssoc);
        }
        return $seances;
    }

}