<?php

const TABLE_PRATIQUANT = PREFIXE_TABLE . 'Pratiquant';

class PratiquantDao {
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

    public function find(int $id): ?Pratiquant {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_PRATIQUANT . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquant::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_PRATIQUANT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquant::class);
        return $stmt->fetchAll();
    }

    public function hydrate(array $pratiquantAssoc): Pratiquant {
        $pratiquant = new Pratiquant();
        $pratiquant->setId($pratiquantAssoc['id']);
        $pratiquant->setContact($pratiquantAssoc['contact']);
        $pratiquant->setDescription($pratiquantAssoc['prenom']);
        $pratiquant->setIdUtilisateur($pratiquantAssoc['idUtilisateur']);
        return $pratiquant;
    }

    public function hydrateAll(array $pratiquantsAssoc): array {
        $pratiquants = [];
        foreach ($pratiquantsAssoc as $pratiquantAssoc) {
            $pratiquants[] = $this->hydrate($pratiquantAssoc);
        }
        return $pratiquants;
    }

}