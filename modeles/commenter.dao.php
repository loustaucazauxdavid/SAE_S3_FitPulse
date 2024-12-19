<?php
/**
 * @file commenter.dao.php
 * @brief DAO de la table commenter
 */

require_once 'config/constantes.php';

/**
 * @brief Classe CommenterDao
 * @details Cette classe permet de gérer les interactions avec la table commenter.
 */
class CommenterDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe CommenterDao
     * @param PDO $pdo Objet PDO à utiliser pour la communication avec la base de données.
     */
    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Trouve un commentaire dans la base de données de l'id d'un pratiquant et d'un coach donnés.
     * @param int $idPratiquant L'identifiant du pratiquant.
     * @param int $idCoach L'identifiant du coach.
     * @return Commenter|null Le commentaire trouvé, ou null s'il n'existe pas.
     */
    public function find(int $idPratiquant, int $idCoach): ?Commenter {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_COMMENTER . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Creneau::class);
        return $stmt->fetch();
    }

    /**
     * Trouve tous les commentaires dans la base de données.
     * @return Commenter[] Un tableau d'objets Commenter.
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_COMMENTER);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Commenter::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Commenter
     * @param array $pratiquerAssoc Le tableau associatif représentant un objet Commenter
     * @return Commenter L'objet Commenter hydraté
     */
    public function hydrate(array $commenterAssoc): Commenter {
        $commenter = new Commenter();
        $commenter->setIdPratiquant($commenterAssoc['idPratiquant']);
        $commenter->setIdCoach($commenterAssoc['idCoach']);
        $commenter->setNote($commenterAssoc['note']);
        $commenter->setTitre($commenterAssoc['titre']);
        $commenter->setContenu($commenterAssoc['contenu']);
        $commenter->setDatePost(DateTime::createFromFormat('Y-m-d H:i:s', $commenterAssoc['DatePost'])); // Conversion en DateTime
        return $commenter;
    }

    /**
     * Méthode pour hydrater un tableau d'objets Commenter
     * @param array $commentersAssoc Le tableau associatif représentant un tableau d'objets Commenter
     * @return Commenter[] Les objets Commenter hydratés
     */
    public function hydrateAll(array $commentersAssoc): array {
        $commenters = [];
        foreach ($commentersAssoc as $commenterAssoc) {
            $commenters[] = $this->hydrate($commenterAssoc); // Hydrate chaque tableau associatif
        }
        return $commenters;
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