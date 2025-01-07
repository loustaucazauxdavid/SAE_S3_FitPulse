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
    private ?string $mail;
    private ?string $motDePasse;
    private ?string $nom;
    private ?string $prenom;
    private ?string $photo;
    private ?DateTime $dateInscription;    
    private ?string $statutCompte;
    private ?bool $estAdmin;
    private ?int $tentativesEchoueesConn;
    private ?DateTime $dateDernierEchecConn;
    private ?string $tokenReinitialisation;
    private ?DateTime $expirationToken;

    /**
     * @brief Constructeur de la classe Utilisateur
     * @param int|null $id Identifiant de l'utilisateur
     * @param string|null $motDePasse Mot de passe de l'utilisateur
     * @param string|null $nom Nom de l'utilisateur
     * @param string|null $prenom Prénom de l'utilisateur
     * @param string|null $mail mail de l'utilisateur
     * @param string|null $photo Photo de l'utilisateur
     * @param DateTime|null $dateInscription Date d'inscription de l'utilisateur
     * @param string|null $statutCompte Statut du compte ("active" ou "desactive")
     * @param bool|null $estAdmin Si l'utilisateur est admin
     * @param int|null $tentativesEchoueesConn Nombre de tentatives de connexion échouées
     * @param DateTime|null $dateDernierEchecConn Date du dernier échec de connexion
     * @param string|null $tokenReinitialisation Token de réinitialisation de mot de passe
     * @param DateTime|null $expirationToken Expiration du token de réinitialisation
     */
    public function __construct(
        ?int $id = null,
        ?string $motDePasse = null,
        ?string $nom = null,
        ?string $prenom = null,
        ?string $mail = null,
        ?string $photo = null,
        ?DateTime $dateInscription = null,
        ?string $statutCompte = null,
        ?bool $estAdmin = null,
        ?int $tentativesEchoueesConn = null,
        ?DateTime $dateDernierEchecConn = null,
        ?string $tokenReinitialisation = null,
        ?DateTime $expirationToken = null
    ) {
        $this->id = $id;
        $this->motDePasse = $motDePasse;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->photo = $photo;
        $this->dateInscription = $dateInscription;
        $this->statutCompte = $statutCompte;
        $this->estAdmin = $estAdmin;
        $this->tentativesEchoueesConn = $tentativesEchoueesConn;
        $this->dateDernierEchecConn = $dateDernierEchecConn;
        $this->tokenReinitialisation = $tokenReinitialisation;
        $this->expirationToken = $expirationToken;
    }

    /**
     * Getter et setter pour chaque variable membre
     */

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getMotDePasse(): ?string {
        return $this->motDePasse;
    }

    public function setMotDePasse(?string $motDePasse): void {
        $this->motDePasse = $motDePasse;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getmail(): ?string {
        return $this->mail;
    }

    public function setmail(?string $mail): void {
        $this->mail = $mail;
    }

    public function getPhoto(): ?string {
        return $this->photo;
    }

    public function setPhoto(?string $photo): void {
        $this->photo = $photo;
    }

    public function getDateInscription(): ?DateTime {
        return $this->dateInscription;
    }

    public function setDateInscription(?DateTime $dateInscription): void {
        $this->dateInscription = $dateInscription;
    }

    public function getStatutCompte(): ?string {
        return $this->statutCompte;
    }

    public function setStatutCompte(?string $statutCompte): void {
        $this->statutCompte = $statutCompte;
    }

    public function getEstAdmin(): ?bool {
        return $this->estAdmin;
    }

    public function setEstAdmin(?bool $estAdmin): void {
        $this->estAdmin = $estAdmin;
    }

    public function getTentativesEchoueesConn(): ?int {
        return $this->tentativesEchoueesConn;
    }

    public function setTentativesEchoueesConn(?int $tentativesEchoueesConn): void {
        $this->tentativesEchoueesConn = $tentativesEchoueesConn;
    }

    public function getDateDernierEchecConn(): ?DateTime {
        return $this->dateDernierEchecConn;
    }

    public function setDateDernierEchecConn(?DateTime $dateDernierEchecConn): void {
        $this->dateDernierEchecConn = $dateDernierEchecConn;
    }

    public function getTokenReinitialisation(): ?string {
        return $this->tokenReinitialisation;
    }

    public function setTokenReinitialisation(?string $tokenReinitialisation): void {
        $this->tokenReinitialisation = $tokenReinitialisation;
    }

    public function getExpirationToken(): ?DateTime {
        return $this->expirationToken;
    }

    public function setExpirationToken(?DateTime $expirationToken): void {
        $this->expirationToken = $expirationToken;
    }
}
