<?php

/**
 * Classe Seance
 */

class Seance {
    private ?int $id;
    private ?bool $estPaye;
    private ?bool $estAnnule;

    public function __construct(
        ?int $id = null,
        ?bool $estPaye = null,
        ?bool $estAnnule = null
    ) {
        $this->id = $id;
        $this->estPaye = $estPaye;
        $this->estAnnule = $estAnnule;
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
     * Getter de la variable membre estPaye
     */ 
    public function getEstPaye(): ?bool
    {
        return $this->estPaye;
    }

    /**
     * Setter de la variable membre estPaye
     */ 
    public function setEstPaye(?bool $estPaye): void
    {
        $this->estPaye = $estPaye;
    }

    /**
     * Getter de la variable membre estAnnule
     */ 
    public function getEstAnnule(): ?bool
    {
        return $this->estAnnule;
    }

    /**
     * Setter de la variable membre estAnnule
     */ 
    public function setEstAnnule(?bool $estAnnule): void
    {
        $this->estAnnule = $estAnnule;
    }
}