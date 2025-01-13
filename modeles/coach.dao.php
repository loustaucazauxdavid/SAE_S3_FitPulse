<?php

/**
 * @file coach.dao.php
 * @brief DAO de la table Coach
 */

/**
 * @brief Classe CoachDao
 * @details DAO de la table Coach
 */

class CoachDao extends Dao
{

    /**
     * Constructeur de la classe CoachDao
     * @param PDO|null $pdo
     * @return void
     */

    public function __construct(?PDO $pdo = null)
    {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)

    }

    /**
     * Récupère un coach sous forme de tableau associatif par son ID.
     * @param int $idCoach L'ID du coach à récupérer.
     * @return array|null Le tableau associatif représentant un coach.
     */

    public function findAssoc(int $idCoach): ?array
    {
        $sql = "SELECT * FROM " . $this->tables['coach'] . " WHERE id = :idCoach";
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
        $sql = "SELECT * FROM " . $this->tables['coach'];
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
        $coach->setEstVerifie((bool) $coachAssoc['estVerifie']);
        $coach->setEmailPaypal($coachAssoc['emailPaypal']);
        $coach->setIdUtilisateur($coachAssoc['idUtilisateur']);

        if (isset($coachAssoc['creneaux'])) {
            $creneauxData = json_decode($coachAssoc['creneaux'], true);
            $creneaux = [];
            foreach ($creneauxData as $creneauAssoc) {
                $creneau = new Creneau();
                $creneau->setId($creneauAssoc['id']);
                $creneau->setDateDebut(new DateTime($creneauAssoc['dateDebut']));
                $creneau->setDateFin(new DateTime($creneauAssoc['dateFin']));
                $creneaux[] = $creneau;
            }
            $coach->setCreneaux($creneaux);
        }

        if (isset($coachAssoc['disciplines'])) {
            $disciplinesData = explode(',', $coachAssoc['disciplines']); // Sépare les noms des disciplines par des virgules
            $disciplines = [];
            foreach ($disciplinesData as $nom) {
                $discipline = new Discipline();
                $discipline->setNom($nom);
                $disciplines[] = $discipline;
            }
            $coach->setDisciplines($disciplines);
        }

        if (isset($coachAssoc['utilisateur_prenom']) && isset($coachAssoc['utilisateur_nom'])) {
            $utilisateur = new Utilisateur("", "");
            $utilisateur->setPrenom($coachAssoc['utilisateur_prenom']);
            $utilisateur->setNom($coachAssoc['utilisateur_nom']);
            $coach->setUtilisateur($utilisateur);
        }

        if (isset($coachAssoc['commentaire_note'])) {
            $coach->setNote($coachAssoc['commentaire_note']);
        }

        return $coach;
    }

    public function hydrateAll(array $coachsAssoc): array
    {
        $coachs = [];
        foreach ($coachsAssoc as $coachAssoc) {
            $coachs[] = $this->hydrate($coachAssoc);
        }
        return $coachs;
    }

    public function findAllWithDetails(array $filters): array
    {
        $now = date('Y-m-d H:i:s');
        $sql = "
        SELECT c.*,
        u.prenom AS utilisateur_prenom,
        u.nom AS utilisateur_nom,
        AVG(com.note) AS commentaire_note,
        JSON_ARRAYAGG(
           JSON_OBJECT(
               'id', cr.id,
               'dateDebut', cr.dateDebut,
               'dateFin', cr.dateFin
           )
        ) AS creneaux,
        GROUP_CONCAT(DISTINCT d.nom) AS disciplines
        FROM " . $this->tables['coach'] . " c
        INNER JOIN " . $this->tables['creneau'] . " cr ON c.id = cr.idCoach
        INNER JOIN " . $this->tables['utilisateur'] . " u ON u.id = c.idUtilisateur
        INNER JOIN " . $this->tables['pratiquer'] . " p ON c.id = p.idCoach
        INNER JOIN " . $this->tables['discipline'] . " d ON p.idDiscipline = d.id
        LEFT JOIN " . $this->tables['seance'] . " s ON cr.id = s.idCreneau
        LEFT JOIN " . $this->tables['commenter'] . " com ON c.id = com.idCoach
        WHERE cr.dateDebut >= :now AND s.id IS NULL
        ";

        // Filtrage par date
        if (isset($filters['date']) && $filters['date']) {
            $sql .= " AND cr.dateDebut >= :date";
        }

        // Filtrage par note minimale
        if (isset($filters['note']) && $filters['note']) {
            $sql .= " HAVING AVG(com.note) >= :note";
        }

        // Filtrage par nom ou prénom de coach
        if (isset($filters['search_name']) && $filters['search_name']) {
            $sql .= " AND (u.prenom LIKE :search_name OR u.nom LIKE :search_name)";
        }

        // Filtrage par budget
        if (isset($filters['budget']) && $filters['budget']) {
            $sql .= " AND cr.tarif <= :budget";
        }

        // Filtrage par type de séance
        if (isset($filters['seance_type']) && !empty($filters['seance_type'])) {
            $seanceTypes = implode("','", $filters['seance_type']);
            $sql .= " AND s.type IN ('$seanceTypes')";
        }

        // Filtrage par nombre de participants
        if (isset($filters['participants']) && $filters['participants']) {
            $sql .= " AND cr.nbParticipants <= :participants";
        }

        $sql .= " GROUP BY c.id, u.prenom, u.nom, s.id 
                  ORDER BY MIN(cr.dateDebut) ASC;
        ";

        $pdoStatement = $this->pdo->prepare($sql);
        $parameters = [':now' => $now];

        // Paramétrage dynamique des filtres
        if (isset($filters['date'])) {
            $parameters[':date'] = $filters['date'];
        }
        if (isset($filters['note'])) {
            $parameters[':note'] = $filters['note'];
        }
        if (isset($filters['search_name'])) {
            $parameters[':search_name'] = '%' . $filters['search_name'] . '%';
        }
        if (isset($filters['budget'])) {
            $parameters[':budget'] = $filters['budget'];
        }
        if (isset($filters['participants'])) {
            $parameters[':participants'] = $filters['participants'];
        }

        $pdoStatement->execute($parameters);
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $coachsAssoc = $pdoStatement->fetchAll();
        
        return $this->hydrateAll($coachsAssoc);
    }
}
