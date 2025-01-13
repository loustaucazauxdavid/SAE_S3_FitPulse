<?php
/**
 * @file utilisateur.dao.php
 * @brief DAO de la table Utilisateur
 */

/**
 * @brief Classe UtilisateurDao
 * @details DAO de la table Utilisateur
 */
class UtilisateurDao extends Dao {
     // Config
     private $authConfig;

    /**
     * Constructeur de la classe UtilisateurDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(?PDO $pdo = null) {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
        $this->authConfig = Config::getInstance()->getAuthConfig();
    }

    /**
     * Méthode pour trouver un utilisateur par son identifiant
     * @param int $idUtilisateur L'identifiant de l'utilisateur
     * @return Utilisateur|null L'utilisateur si trouvé, null sinon
     */
    public function findAssoc(int $idUtilisateur): ?array {
        $sql = "SELECT * FROM " . $this->tables['utilisateur'] . " WHERE id = :idUtilisateur";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute([':idUtilisateur' => $idUtilisateur]);
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetch();
    }

    /**
     * Méthode pour trouver un utilisateur par son mail
     * @param string $mail L'adresse mail de l'utilisateur
     * @return Utilisateur|null L'utilisateur si trouvé, null sinon
     */
    public function findAssocByMail(string $mail): ?array {
        $sql = "SELECT * FROM " . $this->tables['utilisateur'] . " WHERE mail = :mail";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute([':mail' => $mail]);
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetch() ?: null;
    }

    /**
     * Méthode pour récupérer tous les utilisateurs
     * @return Utilisateur[] Les utilisateurs récupérés
     */
    public function findAllAssoc(): array {
        $sql = "SELECT * FROM " . $this->tables['utilisateur'];
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetchAll();
    }

    /**
     * Méthode pour hydrater un utilisateur
     * @param array $utilisateurAssoc Le tableau associatif représentant un utilisateur
     * @return Utilisateur L'utilisateur hydraté
     */
    public function hydrate(array $utilisateurAssoc): Utilisateur {
        $utilisateur = new Utilisateur($utilisateurAssoc['mail'], $utilisateurAssoc['motDePasse']);
        $utilisateur->setId($utilisateurAssoc['id']);
        $utilisateur->setNom($utilisateurAssoc['nom']);
        $utilisateur->setPrenom($utilisateurAssoc['prenom']);
        $utilisateur->setPhoto($utilisateurAssoc['photo']);
        $utilisateur->setDateInscription(strToDateTime($utilisateurAssoc['dateInscription']));
        $utilisateur->setStatutCompte($utilisateurAssoc['statutCompte']);
        $utilisateur->setEstAdmin($utilisateurAssoc['estAdmin']);
        $utilisateur->setTentativesEchoueesConn($utilisateurAssoc['tentativesEchoueesConn']);
        $utilisateur->setDateDernierEchecConn(strToDateTime($utilisateurAssoc['dateDernierEchecConn']));
        $utilisateur->setTokenReinitialisation($utilisateurAssoc['tokenReinitialisation']);
        $utilisateur->setExpirationToken(strToDateTime($utilisateurAssoc['expirationToken']));
        return $utilisateur;
    }

    /**
     * Méthode pour hydrater un tableau d'Utilisateur
     * @param array $utilisateursAssoc Le tableau associatif représentant des utilisateurs
     * @return Utilisateur[] Le tableau d'Utilisateurs hydraté
     */
    public function hydrateAll(array $utilisateursAssoc): array {
        $utilisateurs = [];
        foreach ($utilisateursAssoc as $utilisateurAssoc) {
            $utilisateurs[] = $this->hydrate($utilisateurAssoc);
        }
        return $utilisateurs;
    }

    /**
     * Retourne vrai si un utilisateur avec ce mail existe, faux sinon
     * @param string $mail
     * @return bool
     */
    public function mailExiste(string $mail): bool {
        $sql = "SELECT COUNT(*) FROM " . $this->tables['utilisateur'] . " WHERE mail = :mail";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute([':mail' => $mail]);
        return $pdoStatement->fetchColumn() > 0;
    }

    /**
     * Méthode pour ajouter un nouvel utilisateur dans la BD
     * @param Utilisateur $utilisateur
     * @return bool
     */
    public function add(Utilisateur $utilisateur): bool {
        $sql = "INSERT INTO " . $this->tables['utilisateur'] . " 
                (motDePasse, nom, prenom, mail, photo, dateInscription, estAdmin, statutCompte, tentativesEchoueesConn, dateDernierEchecConn, tokenReinitialisation, expirationToken)
                VALUES (:motDePasse, :nom, :prenom, :mail, :photo, NOW(), :estAdmin, :statutCompte, :tentativesEchoueesConn, :dateDernierEchecConn, :tokenReinitialisation, :expirationToken)";
        
        $pdoStatement = $this->pdo->prepare($sql);
        return $pdoStatement->execute([
            ':motDePasse' => $utilisateur->getMotDePasse(),
            ':nom' => $utilisateur->getNom(),
            ':prenom' => $utilisateur->getPrenom(),
            ':mail' => $utilisateur->getMail(),
            ':photo' => NULL, // Photo de profil par défaut, traitement à part
            ':estAdmin' => (int)$utilisateur->getEstAdmin(),
            ':statutCompte' => $utilisateur->getStatutCompte(),
            ':tentativesEchoueesConn' => $utilisateur->getTentativesEchoueesConn(),
            ':dateDernierEchecConn' => $utilisateur->getDateDernierEchecConn()?->format('Y-m-d H:i:s'),
            ':tokenReinitialisation' => $utilisateur->getTokenReinitialisation(),
            ':expirationToken' => $utilisateur->getExpirationToken()?->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Méthode pour mettre à jour le nom d'un utilisateur
     * @param Utilisateur $utilisateur
     * @return bool
     */
    public function updateNom(Utilisateur $utilisateur): bool {
        $sql = "UPDATE " . $this->tables['utilisateur'] . " SET nom = :nom WHERE id = :idUtilisateur";
        $pdoStatement = $this->pdo->prepare($sql);
        return $pdoStatement->execute([
            ':nom' => $utilisateur->getNom(),
            ':idUtilisateur' => $utilisateur->getId()
        ]);
    }

    /**
     * Méthode pour mettre à jour le prénom d'un utilisateur
     * @param Utilisateur $utilisateur
     * @return bool
     */
    public function updatePrenom(Utilisateur $utilisateur): bool {
        $sql = "UPDATE " . $this->tables['utilisateur'] . " SET prenom = :prenom WHERE id = :idUtilisateur";
        $pdoStatement = $this->pdo->prepare($sql);
        return $pdoStatement->execute([
            ':prenom' => $utilisateur->getPrenom(),
            ':idUtilisateur' => $utilisateur->getId()
        ]);
    }

    /**
     * Méthode pour mettre à jour le mail d'un utilisateur
     * @param Utilisateur $utilisateur
     * @return bool
     */
    public function updateMail(Utilisateur $utilisateur): bool {
        $sql = "UPDATE " . $this->tables['utilisateur'] . " SET mail = :mail WHERE id = :idUtilisateur";
        $pdoStatement = $this->pdo->prepare($sql);
        return $pdoStatement->execute([
            ':mail' => $utilisateur->getMail(),
            ':idUtilisateur' => $utilisateur->getId()
        ]);
    }

    /**
     * Méthode pour mettre à jour la photo d'un utilisateur
     * @param Utilisateur $utilisateur
     * @return bool
     */
    public function updatePhoto(Utilisateur $utilisateur): bool {
        $sql = "UPDATE " . $this->tables['utilisateur'] . " SET photo = :photo WHERE id = :idUtilisateur";
        $pdoStatement = $this->pdo->prepare($sql);
        return $pdoStatement->execute([
            ':photo' => $utilisateur->getPhoto(),
            ':idUtilisateur' => $utilisateur->getId()
        ]);
    }

    /**
     * Gère un échec d'authentification, incrémente les tentatives échouées et désactive le compte si nécessaire.
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function gererEchecConnexion(Utilisateur $utilisateur): void {
        $idUtilisateur = $utilisateur->getId();
        $tentativesEchoueesConn = $utilisateur->getTentativesEchoueesConn();

        $sql = ($tentativesEchoueesConn >=  $this->authConfig['max_failed_logins'])
            ? "UPDATE " . $this->tables['utilisateur'] . " SET tentativesEchoueesConn = :tentatives, dateDernierEchecConn = NOW(), statutCompte = 'desactive' WHERE id = :idUtilisateur"
            : "UPDATE " . $this->tables['utilisateur'] . " SET tentativesEchoueesConn = :tentatives, dateDernierEchecConn = NOW() WHERE id = :idUtilisateur";

        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute([
            'tentatives' => $tentativesEchoueesConn,
            'idUtilisateur' => $idUtilisateur
        ]);
    }

    /**
     * Méthode pour réactiver un compte utilisateur
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function reactiverCompte(Utilisateur $utilisateur): void {
        $sql = "UPDATE " . $this->tables['utilisateur'] . " SET tentativesEchoueesConn = 0, dateDernierEchecConn = NULL, statutCompte = 'active' WHERE id = :idUtilisateur";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(['idUtilisateur' => $utilisateur->getId()]);
    }

    /**
     * Méthode pour réinitialiser les tentatives échouées d'un utilisateur
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function reinitialiserTentativesConnexions(Utilisateur $utilisateur): void {
        $sql = "UPDATE " . $this->tables['utilisateur'] . " SET tentativesEchoueesConn = 0, dateDernierEchecConn = NULL WHERE id = :idUtilisateur";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute([':idUtilisateur' => $utilisateur->getId()]);
    }
}
