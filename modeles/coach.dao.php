<?php
/**
 * @file coach.dao.php
 * @brief DAO de la table Coach
 */

require_once '/config/constantes.php';

/**
 * @brief Classe CoachDao
 * @details DAO de la table Coach
 */
class CoachDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe CoachDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Récupère un coach sous forme de tableau associatif par son ID.
     * @param int $idCoach L'ID du coach à récupérer.
     * @return array|null Le tableau associatif représentant un coach.
     */
    public function findAssoc(int $idCoach): ?array {
        $sql = "SELECT * FROM " . TABLE_COACH . " WHERE id = :idCoach";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':idCoach' => $idCoach));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetch();
    }


    /**
     * Récupère tous les coachs sous forme de tableaux associatifs.
     * @return array[] Un tableau de tableaux associatifs représentant tous les coachs.
     */
    public function findAllAssoc(): array {
        $sql = "SELECT * FROM " . TABLE_COACH;
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetchAll(); 
    }

    /**
     * Méthode pour hydrater un objet Coach
     * @param array $pratiquerAssoc Le tableau associatif représentant un objet Coach
     * @return Coach L'objet Coach hydraté
     */
    public function hydrate(array $coachAssoc): Coach {
        $coach = new Coach();
        $coach->setId($coachAssoc['id']);
        $coach->setContact($coachAssoc['contact']);
        $coach->setDescription($coachAssoc['description']);
        $coach->setLieuCours($coachAssoc['lieuCours']);
        $coach->setEstVerifie((bool) $coachAssoc['estVerifie']); // Conversion en booléen
        $coach->setEmailPaypal($coachAssoc['emailPaypal']);
        $coach->setIdUtilisateur($coachAssoc['idUtilisateur']);
        return $coach;
    }

    /**
     * Méthode pour hydrater un tableau d'objets Coach
     * @param array[] $coachsAssoc Le tableau associatif représentant des objets Coach
     * @return Coach[] Les objets Coach hydratés
     */
    public function hydrateAll(array $coachsAssoc): array {
        $coachs = [];
        foreach ($coachsAssoc as $coachAssoc) {
            $coachs[] = $this->hydrate($coachAssoc); // Hydrate chaque tableau associatif
        }
        return $coachs;
    }

    /**
     * Getter de la variable membre PDO
     * @return PDO|null L'objet PDO à utiliser pour la communication avec la base de données.
     */ 
    public function getPdo(): ?PDO {
        return $this->pdo;
    }

    /**
     * Setter de la variable membre PDO
     * @param PDO $pdo L'objet PDO à utiliser pour la communication avec la base de données.
     */ 
    public function setPdo(PDO $pdo): void {
        $this->pdo = $pdo;
    }
}
