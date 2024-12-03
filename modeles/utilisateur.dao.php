<?php

const TABLE_UTILISATEUR = PREFIXE_TABLE . 'Utilisateur';

class UtilisateurDao {
    private ?PDO $pdo;

    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    public function getPdo(): ?PDO {
        return $this->pdo;
    }


    public function setPdo(PDO $pdo): void {
        $this->pdo = $pdo;
    }

    public function find(int $id): ?Utilisateur {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_UTILISATEUR . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_UTILISATEUR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        return $stmt->fetchAll();
    }

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

    public function hydrateAll(array $utilisateursAssoc): array {
        $utilisateurs = [];
        foreach ($utilisateursAssoc as $utilisateurAssoc) {
            $utilisateurs[] = $this->hydrate($utilisateurAssoc);
        }
        return $utilisateurs;
    }


}