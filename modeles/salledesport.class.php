<?php

/**
 * Classe SalleDeSport
 */

class SalleDeSport {
    private ?int $id;
    private ?string $nom;
    private ?string $photo;
    private ?string $description;
    private ?bool $accessPmr;
    private ?bool $enLigne;
    private ?string $adresse;
    private ?string $codePostal;
    private ?string $ville;
    private ?string $pays;
    private ?string $lienGoogleMaps;

    public function __construct(
        ?int $id = null, 
        ?string $nom = null,
        ?string $photo = null,
        ?string $description = null,
        ?bool $accessPmr = null,
        ?bool $enLigne = null,
        ?string $adresse = null,
        ?string $codePostal = null,
        ?string $ville = null,
        ?string $pays = null,
        ?string $lienGoogleMaps = null) 
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->photo = $photo;
        $this->description = $description;
        $this->accessPmr = $accessPmr;
        $this->enLigne = $enLigne;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->lienGoogleMaps = $lienGoogleMaps;
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
     * Getter de la variable membre accessPmr
     */ 
    public function getAccessPmr(): ?bool {
        return $this->accessPmr;
    }

    /**
     * Setter de la variable membre accessPmr
     */ 
    public function setAccessPmr(?bool $accessPmr): void {
        $this->accessPmr = $accessPmr;
    }

    /**
     * Getter de la variable membre enLigne
     */ 
    public function getEnLigne(): ?bool {
        return $this->enLigne;
    }

    /**
     * Setter de la variable membre enLigne
     */ 
    public function setEnLigne(?bool $enLigne): void {
        $this->enLigne = $enLigne;
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
     * Getter de la variable membre codePostal
     */ 
    public function getCodePostal(): ?string {
        return $this->codePostal;
    }

    /**
     * Setter de la variable membre codePostal
     */ 
    public function setCodePostal(?string $codePostal): void {
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

    /**
     * Getter de la variable membre lienGoogleMaps
     */ 
    public function getLienGoogleMaps(): ?string {
        return $this->lienGoogleMaps;
    }

    /**
     * Setter de la variable membre lienGoogleMaps
     */ 
    public function setLienGoogleMaps(?string $lienGoogleMaps): void {
        $this->lienGoogleMaps = $lienGoogleMaps;
    }
}