<?php

class Utilisateur {
    private ?int $id;
    private ?string $motDePasse;
    private ?string $nom;
    private ?string $prenom;
    private ?string $mail;
    private ?string $photo;
    private ?DateTime $dateInscription;    
    private ?bool $estActif;
    private ?bool $estAdmin;

    public function __construct(
        ?int $id = null,
        ?string $motDePasse = null,
        ?string $nom = null,
        ?string $prenom = null,
        ?string $mail = null,
        ?string $photo = null,
        ?DateTime $dateInscription = null,
        ?bool $estActif = null,
        ?bool $estAdmin = null
    ) {
        $this->id = $id;
        $this->motDePasse = $motDePasse;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->photo = $photo;
        $this->dateInscription = $dateInscription;
        $this->estActif = $estActif;
        $this->estAdmin = $estAdmin;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(?string $motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    public function getDateInscription(): ?DateTime
    {
        return $this->dateInscription;
    }

    public function setDateInscription(?DateTime $dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    public function getEstActif(): ?bool
    {
        return $this->estActif;
    }

    public function setEstActif(?bool $estActif): void
    {
        $this->estActif = $estActif;
    }

    public function getEstAdmin(): ?bool
    {
        return $this->estAdmin;
    }

    public function setEstAdmin(?bool $estAdmin): void
    {
        $this->estAdmin = $estAdmin;
    }

}

