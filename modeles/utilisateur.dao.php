<?php
/**
 * @file utilisateur.dao.php
 * @brief DAO de la table Utilisateur
 */

require_once 'config/constantes.php';
require_once 'utils/datetime.php';

/**
 * @brief Classe UtilisateurDao
 * @details DAO de la table Utilisateur
 */
class UtilisateurDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe UtilisateurDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Getter de la variable membre pdo
     * @return PDO|null
     */
    public function getPdo(): ?PDO {
        return $this->pdo;
    }

    /**
     * Setter de la variable membre pdo
     * @param PDO $pdo
     */
    public function setPdo(PDO $pdo): void {
        $this->pdo = $pdo;
    }

    /**
     * Méthode pour trouver un utilisateur par son identifiant
     * @param int $id L'identifiant de l'utilisateur
     * @return Utilisateur|null L'utilisateur si trouvé, null sinon
     */
    public function findAssoc(int $idUtilisateur): ?array {
        $sql = "SELECT * FROM " . TABLE_UTILISATEUR . " WHERE id = :idUtilisateur";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':idUtilisateur' => $idUtilisateur));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        return $pdoStatement->fetch();
    }

    /**
     * Méthode pour trouver un utilisateur par son mail
     * @param int $mail L'adresse mail de l'utilisateur à trouver
     * @return Utilisateur|null L'utilisateur si trouvé, null sinon
     */
    public function findAssocByMail(string $mail): ?array {
        $sql = "SELECT * FROM " . TABLE_UTILISATEUR . " WHERE mail = :mail";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array(':mail' => $mail));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $fetchResult = $pdoStatement->fetch();
        return $fetchResult ? $fetchResult : null;
    }

    /**
     * Méthode pour récupérer tous les utilisateurs
     * @return Utilisateur[] Les utilisateurs récupérés
     */
    public function findAllAssoc(): array {
        $sql = "SELECT * FROM " . TABLE_UTILISATEUR;
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
     * @param array $utilisateursAssoc Le tableau associatif représentant un utilisateur
     * @return Utilisateur[] Le tableau d'Utilisateur hydraté
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
        $sql = "SELECT COUNT(*) FROM " . TABLE_UTILISATEUR . " WHERE mail = :mail";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute([':mail' => $mail]);
        return $pdoStatement->fetchColumn() > 0;
    }

/**
 * Méthode pour ajouter un nouvel utilisateur dans la BD
 * La photo de profil n'est pas traitée ici, elle est traitée proprement dans une autre fonction du DAO
 * @param Utilisateur $utilisateur
 * @return bool
 */
public function add(Utilisateur $utilisateur): bool {
    $sql = "INSERT INTO " . TABLE_UTILISATEUR . " 
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
    $sql = "UPDATE " . TABLE_UTILISATEUR . " SET nom = :nom WHERE id = :idUtilisateur";
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
    $sql = "UPDATE " . TABLE_UTILISATEUR . " SET prenom = :prenom WHERE id = :idUtilisateur";
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
    $sql = "UPDATE " . TABLE_UTILISATEUR . " SET mail = :mail WHERE id = :idUtilisateur";
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
    $sql = "UPDATE " . TABLE_UTILISATEUR . " SET photo = :photo WHERE id = :idUtilisateur";
    $pdoStatement = $this->pdo->prepare($sql);
    return $pdoStatement->execute([
        ':photo' => $utilisateur->getPhoto(),
        ':idUtilisateur' => $utilisateur->getId()
    ]);
}

/**
 * Gère un échec d'authentification, incrémente les tentatives échouées et désactive le compte si nécessaire.
 * @param Utilisateur $utilisateur L'objet utilisateur contenant les données nécessaires
 * @return void
 */
public function gererEchecConnexion(Utilisateur $utilisateur): void {
    $idUtilisateur = $utilisateur->getId(); // Utilisation du getter pour récupérer l'ID
    $tentativesEchoueesConn = $utilisateur->getTentativesEchoueesConn(); // Utilisation du getter pour récupérer les tentatives échouées

    // Si les tentatives échouées dépassent ou égalent le maximum autorisé, on désactive le compte
    if ($tentativesEchoueesConn >= MAX_CONNEXIONS_ECHOUEES) {
        $sql = "UPDATE " . TABLE_UTILISATEUR . " 
                SET tentativesEchoueesConn = :tentatives, dateDernierEchecConn = NOW(), statutCompte = 'desactive' 
                WHERE id = :idUtilisateur";
    } else {
        $sql = "UPDATE " . TABLE_UTILISATEUR . " 
                SET tentativesEchoueesConn = :tentatives, dateDernierEchecConn = NOW() 
                WHERE id = :idUtilisateur";
    }

    $pdoStatement = $this->pdo->prepare($sql);
    $pdoStatement->execute([
        'tentatives' => $tentativesEchoueesConn,
        'idUtilisateur' => $idUtilisateur,
    ]);
}

public function reactiverCompte(Utilisateur $utilisateur): void {
    $idUtilisateur = $utilisateur->getId(); // Utilisation du getter pour récupérer l'ID

    $sql = "UPDATE " . TABLE_UTILISATEUR . " 
                SET tentativesEchoueesConn = 0, dateDernierEchecConn = NULL , statutCompte = 'active' 
                WHERE id = :idUtilisateur";
    $pdoStatement = $this->pdo->prepare($sql);
    $pdoStatement->execute(['idUtilisateur' => $idUtilisateur]);
}

/**
 * Méthode pour réinitialiser les tentatives échouées d'un utilisateur
 * @param Utilisateur $utilisateur L'objet utilisateur contenant les données nécessaires
 * @return void
 */
public function reinitialiserTentativesConnexions(Utilisateur $utilisateur): void {
    $idUtilisateur = $utilisateur->getId(); // Utilisation du getter pour récupérer l'ID

    $sql = "UPDATE " . TABLE_UTILISATEUR . " 
            SET tentativesEchoueesConn = 0, dateDernierEchecConn = NULL 
            WHERE id = :idUtilisateur";
    $pdoStatement = $this->pdo->prepare($sql);
    $pdoStatement->execute([':idUtilisateur' => $idUtilisateur]);
}
}