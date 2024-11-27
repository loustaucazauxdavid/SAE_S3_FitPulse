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
     * @brief Constructeur de la classe Creneau
     * @param int $id Identifiant du créneau
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
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Setter de la variable membre id
     */ 
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter de la variable membre dateDebut
     */ 
    public function getDateDebut(): ?DateTime
    {
        return $this->dateDebut;
    }

    /**
     * Setter de la variable membre dateDebut
     */ 
    public function setDateDebut(?DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * Getter de la variable membre dateFin
     */ 
    public function getDateFin(): ?DateTime
    {
        return $this->dateFin;
    }

    /**
     * Setter de la variable membre dateFin
     */ 
    public function setDateFin(?DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * Getter de la variable membre capacite
     */ 
    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    /**
     * Setter de la variable membre capacite
     */ 
    public function setCapacite(?int $capacite): void
    {
        $this->capacite = $capacite;
    }

    /**
     * Getter de la variable membre tarif
     */ 
    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    /**
     * Setter de la variable membre tarif
     */ 
    public function setTarif(?int $tarif): void
    {
        $this->tarif = $tarif;
    }

    /**
     * Getter de la variable membre idDiscipline
     */ 
    public function getIdDiscipline(): ?int
    {
        return $this->idDiscipline;
    }

    /**
     * Setter de la variable membre idDiscipline
     */ 
    public function setIdDiscipline(?int $idDiscipline): void
    {
        $this->idDiscipline = $idDiscipline;
    }

    /**
     * Getter de la variable membre idCoach
     */ 
    public function getIdCoach(): ?int
    {
        return $this->idCoach;
    }

    /**
     * Setter de la variable membre idCoach
     */ 
    public function setIdCoach(?int $idCoach): void
    {
        $this->idCoach = $idCoach;
    }
}