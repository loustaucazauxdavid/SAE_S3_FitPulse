<?php

const TABLE_DOSSIER = PREFIXE_TABLE . 'Dossier';

class DossierDao {
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

    public function find(int $id): ?Dossier {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_DOSSIER . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Dossier::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_DOSSIER);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Dossier::class);
        return $stmt->fetchAll();
    }

    public function hydrate(array $dossierAssoc): Dossier {
        $dossier = new Dossier();
        $dossier->setId($dossierAssoc['id']);
        $dossier->setIdentiteRecto($dossierAssoc['identiteRecto']); 
        $dossier->setIdentiteVerso($dossierAssoc['identiteVerso']);
        $dossier->setCertificat($dossierAssoc['certificat']);
        $dossier->setCV($dossierAssoc['cv']);
        $dossier->setIdCoach($dossierAssoc['idCoach']);
        return $dossier;
    }

    public function hydrateAll(array $dossiersAssoc): array {
        $dossiers = [];
        foreach ($dossiersAssoc as $dossierAssoc) {
            $dossiers[] = $this->hydrate($dossierAssoc);
        }
        return $dossiers;
    }

}