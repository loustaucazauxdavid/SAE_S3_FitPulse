<?php

/**
 * Enumération pour LieuCours
 */
enum LieuCours: string {
    case DISTANCIEL = 'Distanciel';
    case PRESENTIEL = 'Présentiel';
    case HYBRIDE = 'Hybride';
}

/**
 * Classe Coach
 */

class Coach {
    private ?int $id;
    private ?string $contact;
    private ?string $description;
    private ?LieuCours $lieuCours; // Utilisation de l'énumération LieuCours
    private ?bool $estVerifie;
    private ?string $emailPaypal;
    private ?int $idUtilisateur;

    public function __construct(
        ?int $id = null,
        ?string $contact = null,
        ?string $description = null,
        ?LieuCours $lieuCours = null,
        ?bool $estVerifie = null,
        ?string $emailPaypal = null,
        ?int $idUtilisateur = null)
    {
        $this->id = $id;
        $this->contact = $contact;
        $this->description = $description;
        $this->lieuCours = $lieuCours;
        $this->estVerifie = $estVerifie;
        $this->emailPaypal = $emailPaypal;
        $this->idUtilisateur = $idUtilisateur;
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
     * Getter de la variable membre contact
     */ 
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * Setter de la variable membre contact
     */ 
    public function setContact(?string $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * Getter de la variable membre description
     */ 
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Setter de la variable membre description
     */ 
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * Getter de la variable membre lieuCours
     */ 
    public function getLieuCours(): ?LieuCours
    {
        return $this->lieuCours;
    }

    /**
     * Setter de la variable membre lieuCours
     */ 
    public function setLieuCours(?LieuCours $lieuCours): void
    {
        $this->lieuCours = $lieuCours;
    }

    /**
     * Getter de la variable membre estVerifie
     */ 
    public function getEstVerifie(): ?bool
    {
        return $this->estVerifie;
    }

    /**
     * Setter de la variable membre estVerifie
     */ 
    public function setEstVerifie(?bool $estVerifie): void
    {
        $this->estVerifie = $estVerifie;
    }

    /**
     * Getter de la variable membre emailPaypal
     */ 
    public function getEmailPaypal(): ?string
    {
        return $this->emailPaypal;
    }

    /**
     * Setter de la variable membre emailPaypal
     */ 
    public function setEmailPaypal(?string $emailPaypal): void
    {
        $this->emailPaypal = $emailPaypal;
    }

    /**
     * Getter de la variable membre idUtilisateur
     */ 
    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    /**
     * Setter de la variable membre idUtilisateur
     */ 
    public function setIdUtilisateur(?int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }
}