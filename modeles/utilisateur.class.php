<?php
/**
 * @file utilisateur.class.php
 * @brief Classe Utilisateur
 */

require_once 'utils/datetime.php';

/**
 * @brief Classe Utilisateur
 * @details Cette classe permet de gérer les utilisateurs
 */
class Utilisateur {
    private ?int $id = null;
    private ?string $mail;
    private ?string $motDePasse;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $photo = null;
    private ?DateTime $dateInscription = null;
    private ?string $statutCompte = 'active';
    private ?bool $estAdmin = false;
    private ?int $tentativesEchoueesConn = 0;
    private ?DateTime $dateDernierEchecConn = null;
    private ?string $tokenReinitialisation = null;
    private ?DateTime $expirationToken = null;

    // Config
    private $authConfig;

    /**
     * @brief Constructeur de la classe Utilisateur
     * @param string $mail Mail de l'utilisateur
     * @param string $motDePasse Mot de passe de l'utilisateur
     */
    public function __construct(string $mail, string $motDePasse) {
        $this->authConfig = Config::getInstance()->getAuthConfig();
       
        $this->mail = $mail;
        $this->motDePasse = $motDePasse;
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

    public function getMail(): ?string {
        return $this->mail;
    }

    public function setMail(?string $mail): void {
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

    /**
     * Vérifie si le délai d'attente est écoulé pour réactiver le compte.
     *
     * @return bool true si le délai est écoulé, false sinon.
     */
    public function delaiAttenteEstEcoule(): bool {
        return $this->tempsRestantAvantReactivationCompte() === 0;
    }

    /**
     * Calcule le temps restant avant que le compte soit réactivé.
     *
     * @return int Temps restant en secondes. Retourne 0 si le délai est écoulé.
     */
    public function tempsRestantAvantReactivationCompte(): int {
        if (!$this->dateDernierEchecConn) {
            return 0;
        }

        $dernierEchecTimestamp = strtotime($this->dateDernierEchecConn->format('Y-m-d H:i:s'));
        $tempsEcoule = time() - $dernierEchecTimestamp;

        return max(0, $this->authConfig['getlockout_duration'] - $tempsEcoule);
    }

    /**
     * Réactive un compte désactivé si le délai d'attente est écoulé.
     */
    private function reactiverCompte(): void {
        $this->tentativesEchoueesConn = 0;
        $this->dateDernierEchecConn = null;
        $this->statutCompte = 'active';
    }

    private function reinitialiserTentativesConnexions(): void {
        $this->tentativesEchoueesConn = 0;
        $this->dateDernierEchecConn = null;
    }

    private function gererEchecConnexion(): void {
        $this->tentativesEchoueesConn++;

        // Si les tentatives échouées dépassent ou égalent le maximum autorisé, on désactive le compte
        if ($this->getTentativesEchoueesConn() >= $this->authConfig['max_failed_logins']) {
            $this->statutCompte = 'desactive';
            $this->dateDernierEchecConn = new DateTime();
        } else {
            $this->statutCompte = 'active';
            $this->dateDernierEchecConn = new DateTime();
        }
    }


    /**
     * Met à jour les données de l'utilisateur depuis les informations contenues BD
     */
    public function mettreAJourDepuisBD($pdo): bool {
        $managerUtilisateur = new UtilisateurDao($pdo);
        $utilisateurAssoc = $managerUtilisateur->findAssocByMail($this->mail);

        // Si l'utilisateur n'existe pas, refuser la connexion
        if (is_null($utilisateurAssoc)) {
            return false;
        } 
        else 
        {
         // Hydrate l'instance avec les données récupérées depuis la BD
         $this->setMail($utilisateurAssoc['mail']);
         $this->setMotDePasse($utilisateurAssoc['motDePasse']);
         $this->setId($utilisateurAssoc['id']);
         $this->setNom($utilisateurAssoc['nom']);
         $this->setPrenom($utilisateurAssoc['prenom']);
         $this->setPhoto($utilisateurAssoc['photo']);
         $this->setDateInscription(strToDateTime($utilisateurAssoc['dateInscription']));
         $this->setStatutCompte($utilisateurAssoc['statutCompte']);
         $this->setEstAdmin($utilisateurAssoc['estAdmin']);
         $this->setTentativesEchoueesConn($utilisateurAssoc['tentativesEchoueesConn']);
         $this->setDateDernierEchecConn(strToDateTime($utilisateurAssoc['dateDernierEchecConn']));
         $this->setTokenReinitialisation($utilisateurAssoc['tokenReinitialisation']);
         $this->setExpirationToken(strToDateTime($utilisateurAssoc['expirationToken']));
         }

        return true;
    }

    public function authentification($pdo): bool {
        $mail = $this->mail;
        $motDePasse = $this->motDePasse;

        $managerUtilisateur = new UtilisateurDao($pdo);
        $utilisateurAssoc = $managerUtilisateur->findAssocByMail($this->mail);

        $this->mettreAJourDepuisBD($pdo);

        // Vérification du statut du compte
        if ($this->statutCompte === 'desactive') {
            if (!$this->delaiAttenteEstEcoule()) {
                // Lever une exception si le délai d'attente n'est pas écoulé
                throw new Exception("compte_desactive");
            }
            $this->reactiverCompte(); // Réactiver le compte si le délai est écoulé
            $managerUtilisateur->reactiverCompte($this); // BD
       }

        // Vérification du mot de passe
        if (!password_verify($motDePasse, $this->getMotDePasse())) {
            $this->gererEchecConnexion(); // Gérer un échec de connexion
            $managerUtilisateur->gererEchecConnexion($this); // BD
            return false; // Authentification échouée
        } 

            // Réinitialiser les tentatives échouées si nécessaire
            if ($this->tentativesEchoueesConn > 0) {
                $this->reinitialiserTentativesConnexions(); // Réinitialiser les tentatives échouées en mémoire
                $managerUtilisateur->reinitialiserTentativesConnexions($this); // Réinitialiser les tentatives échouées en BD
            }

            return true; // Authentification réussie
      
    }

    private function estRobuste(string $password): bool {
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'; // Regex pour un mot de passe robuste

        return preg_match($regex, $password) === 1; // Retourne 1 si l'évaluation regex réussie.
    }

    public function inscription($pdo): void {
        $managerUtilisateur = new UtilisateurDao($pdo);

        // Vérifie si le mot de passe est robuste
        if (!$this->estRobuste($this->motDePasse)) {
            throw new Exception("mdp_faible");
        }

        // Vérifie si l'email existe déjà
        if ($managerUtilisateur->mailExiste($this->mail)) {
            throw new Exception("compte_existant");
        }

        // Hachage du mot de passe
        $passwordHache = password_hash($this->motDePasse, PASSWORD_BCRYPT);

        // Remplace le mot de passe en clair par le mot de passe haché
        $this->motDePasse = $passwordHache; 

        // Ajout de l'utilisateur en BD
        $utilisateurAssoc = $managerUtilisateur->add($this);

        $this->mettreAJourDepuisBD($pdo);
    }
}
