<?php
/**
 * @file utilisateur.class.php
 * @brief Classe Utilisateur
 */

/**
 * @brief Classe Utilisateur
 * @details Cette classe permet de gérer les utilisateurs
 */
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

    /**
     * @brief Constructeur de la classe Utilisateur
     * @param int|null $id Identifiant de l'utilisateur
     * @param string|null $motDePasse Mot de passe de l'utilisateur
     * @param string|null $nom Nom de l'utilisateur
     * @param string|null $prenom Prénom de l'utilisateur
     * @param string|null $mail Mail de l'utilisateur
     * @param string|null $photo Photo de l'utilisateur
     * @param DateTime|null $dateInscription Date d'inscription de l'utilisateur
     * @param bool|null $estActif Si l'utilisateur est actif
     * @param bool|null $estAdmin Si l'utilisateur est admin
     */
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

    /**
     * Getter de la variable membre id
     * @return int|null
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
     * Getter de la variable membre motDePasse
     * @return string|null
     */
    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    /**
     * Setter de la variable membre motDePasse
     * @param string|null $motDePasse
     */
    public function setMotDePasse(?string $motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * Getter de la variable membre nom
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Setter de la variable membre nom
     * @param string|null $nom
     */
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Getter de la variable membre prenom
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Setter de la variable membre prenom
     * @param string|null $prenom
     */
    public function setPrenom(?string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * Getter de la variable membre mail
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * Setter de la variable membre mail
     * @param string|null $mail
     */
    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * Getter de la variable membre photo
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * Setter de la variable membre photo
     * @param string|null $photo
     */
    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * Getter de la variable membre dateInscription
     * @return DateTime|null
     */
    public function getDateInscription(): ?DateTime
    {
        return $this->dateInscription;
    }

    /**
     * Setter de la variable membre dateInscription
     * @param DateTime|null $dateInscription
     */
    public function setDateInscription(?DateTime $dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * Getter de la variable membre estActif
     * @return bool|null
     */
    public function getEstActif(): ?bool
    {
        return $this->estActif;
    }

    /**
     * Setter de la variable membre estActif
     * @param bool|null $estActif
     */
    public function setEstActif(?bool $estActif): void
    {
        $this->estActif = $estActif;
    }

    /**
     * Getter de la variable membre estAdmin
     * @return bool|null
     */
    public function getEstAdmin(): ?bool
    {
        return $this->estAdmin;
    }

    /**
     * Setter de la variable membre estAdmin
     * @param bool|null $estAdmin
     */
    public function setEstAdmin(?bool $estAdmin): void
    {
        $this->estAdmin = $estAdmin;
    }
}

