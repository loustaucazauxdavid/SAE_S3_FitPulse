<?php
/**
 * @file pratiquant.dao.php
 * @brief Fichier de la classe PratiquantDao
 */

require_once 'config/constantes.php';

/**
 * @brief Classe PratiquantDao
 * @details Cette classe permet de gérer les pratiquants
 */
class PratiquantDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe PratiquantDao
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
     * Méthode pour trouver un pratiquant
     * @param int $id L'identifiant du pratiquant
     * @return Pratiquant|null Le pratiquant trouvé
     */
    public function find(int $id): ?Pratiquant {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_PRATIQUANT . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquant::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer tous les pratiquants
     * @return Pratiquant[] Les pratiquants récupérés
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_PRATIQUANT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquant::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Pratiquant
     * @param array $pratiquerAssoc Le tableau associatif représentant un objet Pratiquant
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