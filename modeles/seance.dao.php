<?php
/**
 * @file seance.dao.php
 * @brief DAO de la table Seance
 */

/**
 * @brief Classe SeanceDao
 * @details DAO de la table Seance
 */
class SeanceDao extends Dao {

    /**
     * Constructeur de la classe SeanceDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(?PDO $pdo = null) {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
    }

    /**
     * Méthode pour trouver une séance par son identifiant
     * @param int $id L'identifiant de la séance
     * @return Seance|null La séance trouvée
     */
    public function find(int $id): ?Seance {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->tables['seance'] . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Seance::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer toutes les séances
     * @return Seance[] Les séances récupérées
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . $this->tables['seance']);
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
     * @param array $seancesAssoc Le tableau de tableaux associatifs représentant des séances
     * @return Seance[] Le tableau d'objets Seance hydratés
     */
    public function hydrateAll(array $seancesAssoc): array {
        $seances = [];
        foreach ($seancesAssoc as $seanceAssoc) {
            $seances[] = $this->hydrate($seanceAssoc);
        }
        return $seances;
    }

}
