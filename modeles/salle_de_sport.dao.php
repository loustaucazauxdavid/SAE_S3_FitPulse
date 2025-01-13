<?php
/**
 * @file salle_de_sport.dao.php
 * @brief Classe SalleDeSportDao
 */

/**
 * @brief Classe SalleDeSportDao
 * @details Cette classe permet de gérer les salles de sport
 */
class SalleDeSportDao extends Dao {
    /**
     * Constructeur de la classe SalleDeSportDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(?PDO $pdo = null) {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
    }

    /**
     * Méthode pour trouver une salle de sport par son identifiant
     * @param int $id L'identifiant de la salle de sport
     * @return SalleDeSport|null La salle de sport trouvée
     */
    public function find(int $id): ?SalleDeSport {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->tables['salle_de_sport'] . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, SalleDeSport::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer toutes les salles de sport
     * @return SalleDeSport[] Les salles de sport récupérées
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . $this->tables['salle_de_sport']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, SalleDeSport::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet SalleDeSport
     * @param array $salleDeSportAssoc Le tableau associatif représentant une salle de sport
     * @return SalleDeSport La salle de sport hydratée
     */
    public function hydrate(array $salleDeSportAssoc): SalleDeSport {
        $salleDeSport = new SalleDeSport();
        $salleDeSport->setId($salleDeSportAssoc['id']);
        $salleDeSport->setNom($salleDeSportAssoc['nom']);
        $salleDeSport->setAdresse($salleDeSportAssoc['adresse']);
        $salleDeSport->setDescription($salleDeSportAssoc['description']);
        $salleDeSport->setAccessPmr($salleDeSportAssoc['accessPMR']);
        $salleDeSport->setEnLigne($salleDeSportAssoc['enLigne']);
        $salleDeSport->setAdresse($salleDeSportAssoc['adresse']);
        $salleDeSport->setCodePostal($salleDeSportAssoc['codePostal']);
        $salleDeSport->setVille($salleDeSportAssoc['ville']);
        $salleDeSport->setPays($salleDeSportAssoc['pays']);
        $salleDeSport->setLienGoogleMaps($salleDeSportAssoc['lienGoogleMaps']);
        return $salleDeSport;
    }

    /**
     * Méthode pour hydrater un tableau d'objet SalleDeSport
     * @param array $salleDeSportsAssoc Le tableau associatif représentant des salles de sport
     * @return SalleDeSport[] Le tableau d'objets SalleDeSport hydratés
     */
    public function hydrateAll(array $salleDeSportsAssoc): array {
        $salleDeSports = [];
        foreach ($salleDeSportsAssoc as $salleDeSportAssoc) {
            $salleDeSports[] = $this->hydrate($salleDeSportAssoc);
        }
        return $salleDeSports;
    }
}
