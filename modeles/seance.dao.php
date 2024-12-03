<?php

const TABLE_SEANCE = PREFIXE_TABLE . 'Seance';

class SeanceDao {
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

    public function find(int $id): ?Seance {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_SEANCE . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Seance::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_SEANCE);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Seance::class);
        return $stmt->fetchAll();
    }

    public function hydrate(array $seanceAssoc): Seance {
        $seance = new Seance();
        $seance->setId($seanceAssoc['id']);
        $seance->setEstPaye($seanceAssoc['estPaye']);
        $seance->setEstAnnule($seanceAssoc['estAnnule']);
        return $seance;
    }

    public function hydrateAll(array $seancesAssoc): array {
        $seances = [];
        foreach ($seancesAssoc as $seanceAssoc) {
            $seances[] = $this->hydrate($seanceAssoc);
        }
        return $seances;
    }

}