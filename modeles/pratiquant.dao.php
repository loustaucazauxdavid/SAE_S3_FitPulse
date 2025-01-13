<?php
/**
 * @file pratiquant.dao.php
 * @brief Fichier de la classe PratiquantDao
 */

/**
 * @brief Classe PratiquantDao
 * @details Cette classe permet de gérer les pratiquants
 */
class PratiquantDao extends Dao {
    /**
     * Constructeur de la classe PratiquantDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(?PDO $pdo = null) {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
    }

    /**
     * Méthode pour trouver un pratiquant par son identifiant
     * @param int $id L'identifiant du pratiquant
     * @return Pratiquant|null Le pratiquant trouvé
     */
    public function find(int $id): ?Pratiquant {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->tables['pratiquant'] . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquant::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer tous les pratiquants
     * @return Pratiquant[] Les pratiquants récupérés
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . $this->tables['pratiquant']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquant::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Pratiquant
     * @param array $pratiquantAssoc Le tableau associatif représentant un objet Pratiquant
     * @return Pratiquant L'objet Pratiquant hydraté
     */
    public function hydrate(array $pratiquantAssoc): Pratiquant {
        $pratiquant = new Pratiquant();
        $pratiquant->setId($pratiquantAssoc['id']);
        $pratiquant->setContact($pratiquantAssoc['contact']);
        $pratiquant->setDescription($pratiquantAssoc['prenom']);
        $pratiquant->setIdUtilisateur($pratiquantAssoc['idUtilisateur']);
        return $pratiquant;
    }

    /**
     * Méthode pour hydrater un tableau de pratiquants
     * @param array $pratiquantsAssoc Le tableau associatif représentant un tableau de pratiquants
     * @return Pratiquant[] Le tableau de pratiquants hydraté
     */
    public function hydrateAll(array $pratiquantsAssoc): array {
        $pratiquants = [];
        foreach ($pratiquantsAssoc as $pratiquantAssoc) {
            $pratiquants[] = $this->hydrate($pratiquantAssoc);
        }
        return $pratiquants;
    }
}
