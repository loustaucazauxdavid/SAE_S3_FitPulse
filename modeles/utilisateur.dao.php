<?php
/**
 * @file utilisateur.dao.php
 * @brief DAO de la table Utilisateur
 */

require_once 'config/constantes.php';

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
     * Méthode pour trouver un utilisateur
     * @param int $id L'identifiant de l'utilisateur
     * @return Utilisateur|null L'utilisateur trouvé
     */
    public function find(int $id): ?Utilisateur {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_UTILISATEUR . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer tous les utilisateurs
     * @return Utilisateur[] Les utilisateurs récupérés
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_UTILISATEUR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un utilisateur
     * @param array $utilisateurAssoc Le tableau associatif représentant un utilisateur
     * @return Utilisateur L'utilisateur hydraté
     */
    public function hydrate(array $utilisateurAssoc): Utilisateur {
        $utilisateur = new Utilisateur();
        $utilisateur->setId($utilisateurAssoc['id']);
        $utilisateur->setNom($utilisateurAssoc['nom']);
        $utilisateur->setPrenom($utilisateurAssoc['prenom']);
        $utilisateur->setMail($utilisateurAssoc['email']);
        $utilisateur->setMotDePasse($utilisateurAssoc['motDePasse']);
        $utilisateur->setPhoto($utilisateurAssoc['photo']);
        $utilisateur->setDateInscription($utilisateurAssoc['dateInscription']);
        $utilisateur->setEstActif($utilisateurAssoc['estActif']);
        $utilisateur->setEstAdmin($utilisateurAssoc['estAdmin']);
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
}