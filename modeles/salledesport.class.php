<?php

/**
 * Classe SalleDeSport
 */

class SalleDeSport {
    private ?int $id;
    private ?string $nom;
    private ?string $photo;
    private ?string $description;
    private ?string $adresse;
    private ?int $codePostal;
    private ?string $ville;
    private ?string $pays;

    public function __construct(?int $id = null, ?string $nom = null, ?string $photo = null, ?string $description = null, ?string $adresse = null, ?int $codePostal = null, ?string $ville = null, ?string $pays = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->photo = $photo;
        $this->description = $description;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
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

    /**
     * Getter de la variable membre photo
     */ 
    public function getPhoto(): ?string {
        return $this->photo;
    }

    /**
     * Setter de la variable membre photo
     */ 
    public function setPhoto(?string $photo): void {
        $this->photo = $photo;
    }

    /**
     * Getter de la variable membre description
     */ 
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * Setter de la variable membre description
     */ 
    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    /**
     * Getter de la variable membre adresse
     */ 
    public function getAdresse(): ?string {
        return $this->adresse;
    }

    /**
     * Setter de la variable membre adresse
     */ 
    public function setAdresse(?string $adresse): void {
        $this->adresse = $adresse;
    }

    /**
     * Getter de la variable membre code postal
     */ 
    public function getCodePostal(): ?int {
        return $this->codePostal;
    }

    /**
     * Setter de la variable membre code postal
     */ 
    public function setCodePostal(?int $codePostal): void {
        $this->codePostal = $codePostal;
    }

    /**
     * Getter de la variable membre ville
     */ 
    public function getVille(): ?string {
        return $this->ville;
    }

    /**
     * Setter de la variable membre ville
     */ 
    public function setVille(?string $ville): void {
        $this->ville = $ville;
    }

    /**
     * Getter de la variable membre pays
     */ 
    public function getPays(): ?string {
        return $this->pays;
    }

    /**
     * Setter de la variable membre pays
     */ 
    public function setPays(?string $pays): void {
        $this->pays = $pays;
    }
}