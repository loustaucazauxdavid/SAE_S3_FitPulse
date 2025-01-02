<?php

/**
 * @file coach.dao.php
 * @brief DAO de la table Coach
 */

require_once 'config/constantes.php';

/**
 * @brief Classe CoachDao
 * @details DAO de la table Coach
 */
class CoachDao
{
    private ?PDO $pdo;

    /**
     * Constructeur de la classe CoachDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère un coach sous forme de tableau associatif par son ID.
     * @param int $idCoach L'ID du coach à récupérer.
     * @return array|null Le tableau associatif représentant un coach.
     */
    public function findAssoc(int $idCoach): ?array
    {
        $sql = "SELECT * FROM " . TABLE_COACH . " WHERE id = :idCoach;";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':idCoach' => $idCoach));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetch();
    }


    /**
     * Récupère tous les coachs sous forme de tableaux associatifs.
     * @return array[] Un tableau de tableaux associatifs représentant tous les coachs.
     */
    public function findAllAssoc(): array
    {
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
    public function hydrate(array $coachAssoc): Coach
    {
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
    public function hydrateAll(array $coachsAssoc): array
    {
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
    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    /**
     * Setter de la variable membre PDO
     * @param PDO $pdo L'objet PDO à utiliser pour la communication avec la base de données.
     */
    public function setPdo(PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les coachs disponibles pour des séances futures.
     * @return array Un tableau associatif représentant les coachs et leurs séances.
     */
    public function findAvailableCoachs(): array
    {
        $now = date('Y-m-d H:i:s');
        $sql = "
        SELECT c.*,
        u.prenom,
        u.nom,
        s.id AS seance_id, 
        GROUP_CONCAT(d.nom ORDER BY d.nom) AS sports, 
        cr.dateDebut, 
        cr.dateFin
        FROM " . TABLE_CRENEAU . " cr
        INNER JOIN " . TABLE_COACH . " c ON cr.idCoach = c.id
        INNER JOIN " . TABLE_UTILISATEUR . " u ON u.id = c.idUtilisateur
        INNER JOIN " . TABLE_SEANCE . " s ON cr.id = s.idCreneau
        LEFT JOIN " . TABLE_DISCIPLINE . " d ON cr.idDiscipline = d.id
        WHERE cr.dateDebut <= :now
        GROUP BY c.id, s.id, cr.dateDebut, cr.dateFin
        ORDER BY cr.dateDebut ASC;
        ";

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute([':now' => $now]);
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $coachsAssoc = $pdoStatement->fetchAll();

        // Organiser les coachs et leurs séances
        $coachs = [];
        foreach ($coachsAssoc as $row) {
            if (!isset($coachs[$row['id']])) {
                $coachs[$row['id']] = [
                    'coach' => $row,
                    'seances' => []
                ];
            }

            $coachs[$row['id']]['seances'][] = [
                'seance_id' => $row['seance_id'],
                'date_debut' => $row['dateDebut'],
                'date_fin' => $row['dateFin'],
            ];
        }

        // Récupérer et ajouter la note moyenne pour chaque coach
        foreach ($coachs as &$coachData) {
            $noteMoyenne = $this->getNoteMoyenne($coachData['coach']['id']);
            $coachData['coach']['note_moyenne'] = $noteMoyenne;
        }

        return $coachs;
    }

    /**
     * Récupère un coach et ses séances par son ID.
     * @param int $idCoach L'ID du coach à récupérer.
     * @return array|null Le tableau associatif représentant un coach et ses séances.
     */
    public function getNoteMoyenne(int $idCoach): float
    {
        $sql = "
        SELECT AVG(note) AS moyenne
        FROM " . TABLE_COMMENTER . "
        WHERE idCoach = :idCoach;
        ";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute([':idCoach' => $idCoach]);
        $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        /* Si la moyenne est NULL, on retourne 0.0 */
        return $result['moyenne'] ? (float) $result['moyenne'] : 0.0;
    }
}
