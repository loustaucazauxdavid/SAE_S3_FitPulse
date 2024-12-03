<?php

const TABLE_PRATIQUER = PREFIXE_TABLE . 'pratiquer';

class PratiquerDao {
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

    public function find(int $id): ?Pratiquer {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_PRATIQUER . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquer::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_PRATIQUER);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquer::class);
        return $stmt->fetchAll();
    }

    public function hydrate(array $pratiquerAssoc): Pratiquer {
        $pratiquer = new Pratiquer();
        $pratiquer->setIdCoach($pratiquerAssoc['idCoach']);
        $pratiquer->setIdDiscipline($pratiquerAssoc['idDiscipline']);
        return $pratiquer;
    }

    public function hydrateAll(array $pratiquersAssoc): array {
        $pratiquers = [];
        foreach ($pratiquersAssoc as $pratiquerAssoc) {
            $pratiquers[] = $this->hydrate($pratiquerAssoc);
        }
        return $pratiquers;
    }


}