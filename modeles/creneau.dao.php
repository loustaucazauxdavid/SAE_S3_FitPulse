<?php
/**
 * @file creneau.dao.php
 * @brief DAO pour creneau
 */

require_once 'config/constantes.php';

/**
 * @brief Classe CreneauDao
 * @details Cette classe permet de gérer les créneaux
 */
class CreneauDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe CreneauDao
     * @param PDO $pdo Objet PDO à utiliser pour la communication avec la base de données.
     */
    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Getter de la variable membre pdo
     */
    public function getPdo(): ?PDO {
        return $this->pdo;
    }

    /**
     * Setter de la variable membre pdo
     */
    public function setPdo(PDO $pdo): void {
        $this->pdo = $pdo;
    }

    /**
     * Méthode pour trouver un créneau à partir de son identifiant
     * @param int $id L'identifiant du créneau
     * @return Creneau|null Le créneau trouvé
     */
    public function find(int $id): ?Creneau {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_CRENEAU . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Creneau::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer tous les créneaux
     * @return Creneau[] Les créneaux récupérés
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_CRENEAU);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Creneau::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Creneau
     * @param array $pratiquerAssoc Le tableau associatif représentant un objet Creneau
     * @return Creneau L'objet Creneau hydraté
     */
    public function hydrate(array $creneauAssoc): Creneau {
        $creneau = new Creneau();
        $creneau->setId($creneauAssoc['id']);
        $creneau->setDateDebut($creneauAssoc['heureDebut']);
        $creneau->setDateFin($creneauAssoc['heureFin']);
        $creneau->setCapacite($creneauAssoc['capacite']);
        $creneau->setIdCoach($creneauAssoc['idCoach']);
        $creneau->setTarif($creneauAssoc['tarif']);
        return $creneau;
    }

    /**
     * Méthode pour hydrater un tableau de créneaux
     * @param array $creneauxAssoc Le tableau associatif représentant les créneaux
     * @return Creneau[] Les créneaux hydratés
     */
    public function hydrateAll(array $creneauxAssoc): array {
        $creneaux = [];
        foreach ($creneauxAssoc as $creneauAssoc) {
            $creneaux[] = $this->hydrate($creneauAssoc);
        }
        return $creneaux;
    }

}