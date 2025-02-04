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
        parent::__construct($pdo);

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

    /**
     * Méthode pour hydrater un tableau d'objets Coach
     * @param array[] $coachsAssoc Le tableau associatif représentant un tableau d'objets Coach
     * @return Coach[] Le tableau d'objets Coach hydratés
     */

    public function hydrateAll(array $coachsAssoc): array
    {
        $coachs = [];
        foreach ($coachsAssoc as $coachAssoc) {
            $coachs[] = $this->hydrate($coachAssoc);
        }
        return $coachs;
    }

    /**
     * Récupère tous les coachs avec leurs détails.
     * @param array|null $filtres Les filtres de recherche.
     * @return Coach[] Le tableau d'objets Coach hydratés.
     */

    public function findAllWithDetails(?array $filtres): array
    {
        $now = date('Y-m-d H:i:s');
        $sql = "
            SELECT 
            c.*,
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
            MIN(cr.dateDebut) AS min_dateDebut,
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

        $parameters = [':now' => $now];

        // Gestion dynamique des filtres
        if (!empty($filtres)) {
            if (!empty($filtres['date'])) {
                $sql .= " AND cr.dateDebut >= :date";
                $parameters[':date'] = $filtres['date'];
            }

            if (!empty($filtres['nom'])) {
                $sql .= " AND (u.prenom LIKE :nom OR u.nom LIKE :nom)";
                $parameters[':nom'] = '%' . $filtres['nom'] . '%';
            }

            if (!empty($filtres['budget'])) {
                $sql .= " AND cr.tarif <= :budget";
                $parameters[':budget'] = $filtres['budget'];
            }

            if (!empty($filtres['seance_type'])) {
                $sql .= " AND c.lieuCours = :seance_type";
                $parameters[':seance_type'] = $filtres['seance_type'];
            }

            if (!empty($filtres['participants'])) {
                $sql .= " AND cr.capacite <= :participants";
                $parameters[':participants'] = $filtres['participants'];
            }

        }

        $sql .= " GROUP BY c.id, u.prenom, u.nom";

        if (!empty($filtres['note'])) {
            $sql .= " HAVING AVG(com.note) >= :note";
            $parameters[':note'] = $filtres['note'];
        }

        $sql .= " ORDER BY min_dateDebut ASC";

        // Préparation et exécution de la requête
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute($parameters);

        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $coachsAssoc = $pdoStatement->fetchAll();

        return $this->hydrateAll($coachsAssoc);
    }
}
