<?php
/**
 * @file dossier.dao.php
 * @brief Classe DossierDao
 */

require_once 'config/constantes.php';

/**
 * @brief Classe DossierDao
 * @details Cette classe permet de gérer les dossiers
 */
class DossierDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe DossierDao
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
     * Méthode pour trouver un dossier
     * @param int $id L'identifiant du dossier
     * @return Dossier|null Le dossier trouvé
     */
    public function find(int $id): ?Dossier {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_DOSSIER . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Dossier::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer tous les dossiers
     * @return Dossier[] Les dossiers récupérés
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_DOSSIER);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Dossier::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Dossier
     * @param array $pratiquerAssoc Le tableau associatif représentant un objet Dossier
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
     * @return Dossier[] Les dossier hydratés
     */
    public function hydrateAll(array $dossiersAssoc): array {
        $dossiers = [];
        foreach ($dossiersAssoc as $dossierAssoc) {
            $dossiers[] = $this->hydrate($dossierAssoc);
        }
        return $dossiers;
    }

}