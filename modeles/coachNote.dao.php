<?php

/**
 * DAO CoachNote
 */

class CoachNoteDao {
    private ?PDO $pdo;

    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }


    /**
     * Récupère les 10 meilleurs coachs selon la moyenne de leurs notes.
     * @return array[] Un tableau de tableaux associatifs représentant les meilleurs coachs.
     */
    public function findTopNbByNote(int $nbResultats): array {
        $sql = "
            SELECT c.*, AVG(com.note) AS moyenneNote
            FROM " . TABLE_COACH . " c
            INNER JOIN " . TABLE_COMMENTER . " com ON c.id = com.idCoach
            GROUP BY c.id
            ORDER BY moyenneNote DESC
            LIMIT :nbResultats
        ";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindParam(':nbResultats', $nbResultats, PDO::PARAM_INT);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetchAll();
    }

    
    /**
     * Hydrate un tableau associatif dans un objet Coach.
     * @param array $coachAssoc Le tableau associatif représentant un coach.
     * @return Coach L'objet Coach hydraté.
     */
    public function hydrate(array $coachAssoc): CoachNote {
        $coachNote = new CoachNote();

        $coachDao = new CoachDao($this->pdo);
        $coach = $coachDao->hydrate($coachAssoc);
        
        $coachNote->setCoach($coach);
        $coachNote->setNoteMoyenne($coachAssoc['moyenneNote']); // Conversion en int

        return $coachNote;
    }


    /**
     * Hydrate un tableau de tableaux associatifs dans un tableau d'objets Coach.
     * @param array $coachsAssoc Un tableau de tableaux associatifs représentant les coachs.
     * @return Coach[] Un tableau d'objets Coach hydratés.
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
