<?php
/**
 * @file creneau.class.php
 * @brief Classe Creneau
 */

/**
 * @brief Classe Creneau
 * @details Cette classe permet de gérer les créneaux
 */
class Creneau {
    private ?int $id;
    private ?DateTime $dateDebut;
    private ?DateTime $dateFin;
    private ?int $capacite;
    private ?int $tarif;
    private ?int $idDiscipline;
    private ?int $idCoach;

    /**
     * Constructeur de la classe Creneau
     * Initialise les variables membres de la classe
     * @param int|null $id
     * @param DateTime|null $dateDebut
     * @param DateTime|null $dateFin
     * @param int|null $capacite
     * @param int|null $tarif
     * @param int|null $idDiscipline
     * @param int|null $idCoach
     * @return void
     */
    public function __construct(
        ?int $id = null,
        ?DateTime $dateDebut = null,
        ?DateTime $dateFin = null,
        ?int $capacite = null,
        ?int $tarif = null,
        ?int $idDiscipline = null,
        ?int $idCoach = null) 
    {
        $this->id = $id;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->capacite = $capacite;
        $this->tarif = $tarif;
        $this->idDiscipline = $idDiscipline;
        $this->idCoach = $idCoach;
    }

    /**
     * Getter de la variable membre id
     * @return int|null L'identifiant du créneau
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Setter de la variable membre id
     * @param int|null $id
     */ 
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter de la variable membre dateDebut
     * @return DateTime|null La date de début du créneau
     */ 
    public function getDateDebut(): ?DateTime
    {
        return $this->dateDebut;
    }

    /**
     * Setter de la variable membre dateDebut
     * @param DateTime|null $dateDebut
     */ 
    public function setDateDebut(?DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * Getter de la variable membre dateFin
     * @return DateTime|null La date de fin du créneau
     */ 
    public function getDateFin(): ?DateTime
    {
        return $this->dateFin;
    }

    /**
     * Setter de la variable membre dateFin
     * @param DateTime|null $dateFin
     */ 
    public function setDateFin(?DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * Getter de la variable membre capacite
     * @return int|null La capacité du créneau
     */ 
    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    /**
     * Setter de la variable membre capacite
     * @param int|null $capacite
     */ 
    public function setCapacite(?int $capacite): void
    {
        $this->capacite = $capacite;
    }

    /**
     * Getter de la variable membre tarif
     * @return int|null Le tarif du créneau
     */ 
    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    /**
     * Setter de la variable membre tarif
     * @param int|null $tarif
     */ 
    public function setTarif(?int $tarif): void
    {
        $this->tarif = $tarif;
    }

    /**
     * Getter de la variable membre idDiscipline
     * @return int|null L'identifiant de la discipline
     */ 
    public function getIdDiscipline(): ?int
    {
        return $this->idDiscipline;
    }

    /**
     * Setter de la variable membre idDiscipline
     * @param int|null $idDiscipline
     */ 
    public function setIdDiscipline(?int $idDiscipline): void
    {
        $this->idDiscipline = $idDiscipline;
    }

    /**
     * Getter de la variable membre idCoach
     * @return int|null L'identifiant du coach
     */ 
    public function getIdCoach(): ?int
    {
        return $this->idCoach;
    }

    /**
     * Setter de la variable membre idCoach
     * @param int|null $idCoach
     */ 
    public function setIdCoach(?int $idCoach): void
    {
        $this->idCoach = $idCoach;
    }
}