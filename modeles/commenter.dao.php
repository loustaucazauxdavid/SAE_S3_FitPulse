<?php

/**
 * DAO Commenter
 */

const TABLE_COMMENTER = PREFIXE_TABLE . 'commenter';

class CommenterDao {
    private ?PDO $pdo;

    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Récupère un commentaire sous forme de tableau associatif par son ID.
     * @param int $idCommentaire L'ID du commentaire à récupérer.
     * @return array|null Le tableau associatif représentant un commentaire.
     */
    public function findAssoc(int $idCommentaire): ?array {
        $sql = "SELECT * FROM " . TABLE_COMMENTER . " WHERE id = :idCommentaire";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':idCommentaire' => $idCommentaire));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetch();
    }

    /**
     * Récupère tous les commentaires sous forme de tableaux associatifs.
     * @return array[] Un tableau de tableaux associatifs représentant tous les commentaires.
     */
    public function findAllAssoc(): array {
        $sql = "SELECT * FROM " . TABLE_COMMENTER;
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetchAll(); 
    } 

    /**
     * Hydrate un tableau associatif dans un objet Commenter.
     * @param array $commenterAssoc Le tableau associatif représentant un commentaire.
     * @return Commenter L'objet Commenter hydraté.
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
     * Hydrate un tableau de tableaux associatifs dans un tableau d'objets Commenter.
     * @param array $commentersAssoc Un tableau de tableaux associatifs représentant les commentaires.
     * @return Commenter[] Un tableau d'objets Commenter hydratés.
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
     */ 
    public function getPdo(): ?PDO {
        return $this->pdo;
    }

    /**
     * Setter de la variable membre PDO
     */ 
    public function setPdo(PDO $pdo): void {
        $this->pdo = $pdo;
    }
}
