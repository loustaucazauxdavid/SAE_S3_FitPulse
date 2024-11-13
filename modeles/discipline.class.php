<?php

/**
 * Classe Discipline
 */

class Discipline {
    private ?int $id;
    private ?string $nom;

    public function __construct(?int $id = null, ?string $nom = null) {
        $this->id = $id;
        $this->nom = $nom; 
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
     * Getter de la variable membre nom
     */ 
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Setter de la variable membre nom
     */ 
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }
}