<?php
/**
 * @file dossier.dao.php
 * @brief Classe DossierDao
 */

/**
 * @brief Classe DossierDao
 * @details Cette classe permet de gérer les dossiers
 */
class DossierDao extends Dao {
    /**
     * Constructeur de la classe DossierDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(PDO $pdo = null) {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
    }

    /**
     * Récupère un dossier par son ID.
     * @param int $id L'identifiant du dossier
     * @return Dossier|null Le dossier trouvé
     */
    public function find(int $id): ?Dossier {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->tables['dossier'] . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Dossier::class);
        return $stmt->fetch();
    }

    /**
     * Récupère tous les dossiers.
     * @return Dossier[] Les dossiers récupérés
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . $this->tables['dossier']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Dossier::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Dossier
     * @param array $dossierAssoc Le tableau associatif représentant un objet Dossier
     * @return Dossier L'objet Dossier hydraté
     */
    public function hydrate(array $dossierAssoc): Dossier {
        $dossier = new Dossier();
        $dossier->setId($dossierAssoc['id']);
        $dossier->setIdentiteRecto($dossierAssoc['identiteRecto']); 
        $dossier->setIdentiteVerso($dossierAssoc['identiteVerso']);
        $dossier->setCertificat($dossierAssoc['certificat']);
        $dossier->setCV($dossierAssoc['cv']);
        $dossier->setIdCoach($dossierAssoc['idCoach']);
        return $dossier;
    }

    /**
     * Méthode pour hydrater un tableau de Dossiers
     * @param array $dossiersAssoc Un tableau associatif de Dossiers
     * @return Dossier[] Les dossiers hydratés
     */
    public function hydrateAll(array $dossiersAssoc): array {
        $dossiers = [];
        foreach ($dossiersAssoc as $dossierAssoc) {
            $dossiers[] = $this->hydrate($dossierAssoc);
        }
        return $dossiers;
    }
}
