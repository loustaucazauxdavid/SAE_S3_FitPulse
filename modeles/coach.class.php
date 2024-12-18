<?php
/**
 * @file coach.class.php
 * @brief Classe pour les coachs
 */

/**
 * @brief Classe pour les coachs
 * @details Gère les informations des coachs
 */
class Coach {
    private ?int $id;
    private ?string $contact;
    private ?string $description;
    private ?string $lieuCours; // Utilisation de l'énumération LieuCours
    private ?bool $estVerifie;
    private ?string $emailPaypal;
    private ?int $idUtilisateur;

    /**
     * Constructeur de la classe Coach
     * Initialise les variables membres de la classe
     * @param int|null $id
     * @param string|null $contact
     * @param string|null $description
     * @param LieuCours|null $lieuCours
     * @param bool|null $estVerifie
     * @param string|null $emailPaypal
     * @param int|null $idUtilisateur
     * @return void
     */
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
     * @return int|null L'identifiant du coach
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Setter de la variable membre id
     * @param int|null $id L'identifiant du coach
     */ 
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter de la variable membre contact
     * @return string|null Le contact du coach
     */ 
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * Setter de la variable membre contact
     * @param string|null $contact Le contact du coach
     */ 
    public function setContact(?string $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * Getter de la variable membre description
     * @return string|null La description du coach
     */ 
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Setter de la variable membre description
     * @param string|null $description La description du coach
     */ 
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * Getter de la variable membre lieuCours
     * @return LieuCours|null Le lieu des cours du coach
     */ 
    public function getLieuCours(): ?string
    {
        return $this->lieuCours;
    }

    /**
     * Setter de la variable membre lieuCours
     * @param LieuCours|null $lieuCours Le lieu des cours du coach
     */ 
    public function setLieuCours(?string $lieuCours): void
    {
        // Première version de controles des valeurs (cf. Videos Etcheverry)
        $valeursValides = ['Distanciel', 'Présentiel', 'Hybride'];
        
        if (!in_array($lieuCours, $valeursValides, true)) {
            throw new InvalidArgumentException("Valeur invalide passé dans LieuCours : $value");
        }

        $this->lieuCours = $lieuCours;
    }

    /**
     * Getter de la variable membre estVerifie
     * @return bool|null Le statut de vérification du coach
     */ 
    public function getEstVerifie(): ?bool
    {
        return $this->estVerifie;
    }

    /**
     * Setter de la variable membre estVerifie
     * @param bool|null $estVerifie Le statut de vérification du coach
     */ 
    public function setEstVerifie(?bool $estVerifie): void
    {
        $this->estVerifie = $estVerifie;
    }

    /**
     * Getter de la variable membre emailPaypal
     * @return string|null L'email PayPal du coach
     */ 
    public function getEmailPaypal(): ?string
    {
        return $this->emailPaypal;
    }

    /**
     * Setter de la variable membre emailPaypal
     * @param string|null $emailPaypal L'email PayPal du coach
     */ 
    public function setEmailPaypal(?string $emailPaypal): void
    {
        $this->emailPaypal = $emailPaypal;
    }

    /**
     * Getter de la variable membre idUtilisateur
     * @return int|null L'identifiant du compte utilisateur
     */ 
    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    /**
     * Setter de la variable membre idUtilisateur
     * @param int|null $idUtilisateur L'identifiant du compte utilisateur
     */ 
    public function setIdUtilisateur(?int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }
}