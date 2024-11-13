<?php

/**
 * Classe Creneau
 */

class Creneau {
    private ?int $id;
    private ?DateTime $dateDebut;
    private ?DateTime $dateFin;
    private ?int $capacite;
    private ?int $tarif;

    public function __construct(?int $id = null, ?DateTime $dateDebut = null, ?DateTime $dateFin = null, ?int $capacite = null, ?int $tarif = null) {
        $this->id = $id;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->capacite = $capacite;
        $this->tarif = $tarif;
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
}