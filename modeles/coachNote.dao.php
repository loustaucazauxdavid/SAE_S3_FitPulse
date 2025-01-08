<?php
/**
 * @file coachNote.dao.php
 * @brief DAO pour les notes des coachs
 */

require_once 'config/constantes.php';

/**
 * @brief DAO pour les notes des coachs
 * @details Gère les requêtes vers la table coachNote
 */
class CoachNoteDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe CoachNoteDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les $nbResultats de meilleurs coachs selon la moyenne de leurs notes.
     * @param int $nbResultats Le nombre de coachs à récupérer.
     * @return array[] Un tableau de tableaux associatifs représentant les meilleurs coachs.
     */
    public function findTopNbByNote(int $nbResultats = 10): array {
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
     * Méthode pour hydrater un objet CoachNote
     * @param array $pratiquerAssoc Le tableau associatif représentant un objet CoachNote
     * @return CoachNote L'objet CoachNote hydraté
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
     * Méthode pour hydrater un tableau d'objets CoachNote
     * @param array $coachsAssoc Le tableau associatif représentant des objets CoachNote
     * @return CoachNote[] Les objets CoachNote hydratés
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
