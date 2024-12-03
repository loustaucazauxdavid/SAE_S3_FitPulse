<?php

const TABLE_DISCPLINE = PREFIXE_TABLE . 'Discipline';

class DisciplineDao {
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

    public function find(int $id): ?Discipline {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_DISCPLINE . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Discipline::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_DISCPLINE);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Discipline::class); 
        return $stmt->fetchAll();
    }

    public function hydrate(array $disciplineAssoc): Discipline {
        $discipline = new Discipline();
        $discipline->setId($disciplineAssoc['id']);
        $discipline->setNom($disciplineAssoc['nom']);
        return $discipline;
    }

    public function hydrateAll(array $disciplinesAssoc): array {
        $disciplines = [];
        foreach ($disciplinesAssoc as $disciplineAssoc) {
            $disciplines[] = $this->hydrate($disciplineAssoc);
        }
        return $disciplines;
    }

}