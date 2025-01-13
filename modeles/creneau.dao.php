<?php

/**
 * @file creneau.dao.php
 * @brief DAO pour creneau
 */

/**
 * @brief Classe CreneauDao
 * @details Cette classe permet de gérer les créneaux
 */
class CreneauDao extends Dao
{
    /**
     * Constructeur de la classe CreneauDao
     * @param PDO|null $pdo Objet PDO à utiliser pour la communication avec la base de données.
     */
    public function __construct(?PDO $pdo = null)
    {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
    }

    /**
     * Méthode pour trouver un créneau à partir de son identifiant
     * @param int $id L'identifiant du créneau
     * @return Creneau|null Le créneau trouvé
     */
    public function find(int $id): ?Creneau
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->tables['creneau'] . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Creneau::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer tous les créneaux
     * @return Creneau[] Les créneaux récupérés
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM ' . $this->tables['creneau']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Creneau::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Creneau
     * @param array $creneauAssoc Le tableau associatif représentant un objet Creneau
     * @param array $creneauAssoc Le tableau associatif représentant un objet Creneau
     * @return Creneau L'objet Creneau hydraté
     */
    public function hydrate(array $creneauAssoc): Creneau
    {
        $creneau = new Creneau();
        $creneau->setId($creneauAssoc['id']);
        $creneau->setDateDebut($creneauAssoc['dateDebut']);
        $creneau->setDateFin($creneauAssoc['dateFin']);
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
    public function hydrateAll(array $creneauxAssoc): array
    {
        $creneaux = [];
        foreach ($creneauxAssoc as $creneauAssoc) {
            $creneaux[] = $this->hydrate($creneauAssoc);
        }
        return $creneaux;
    }

    /**
     * Récupère le tarif maximum des créneaux.
     * 
     * @return int Le tarif maximum des créneaux.
     */
    public function fetchMaxTarif(): int
    {
        $sql = "SELECT MAX(tarif) FROM " . $this->tables['creneau'] . " ;";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $maxTarif = $pdoStatement->fetchColumn();

        return (int) round($maxTarif);
    }

    /**
     * Récupère le tarif minimum des créneaux.
     * 
     * @return float Le tarif minimum des créneaux.
     */
    public function fetchMinTarif(): int
    {
        $sql = "SELECT MIN(tarif) FROM " . $this->tables['creneau'];
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $minTarif = $pdoStatement->fetchColumn();

        return (int) round($minTarif);
    }
}
