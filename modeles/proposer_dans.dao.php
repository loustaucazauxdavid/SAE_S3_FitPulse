<?php

const TABLE_PROPOSER_DANS = PREFIXE_TABLE . 'proposer_dans';

class ProposerDansDao {
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

    public function find(int $id): ?ProposerDans {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_PROPOSER_DANS . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ProposerDans::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_PROPOSER_DANS);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ProposerDans::class);
        return $stmt->fetchAll();
    }

    public function hydrate(array $proposerDansAssoc): ProposerDans {
        $proposerDans = new ProposerDans();
        $proposerDans->setIdCreneau($proposerDansAssoc['idCreneau']);
        $proposerDans->setIdSalleDeSport($proposerDansAssoc['idSalleDeSport']);
        return $proposerDans;
    }

    public function hydrateAll(array $proposerDansAssoc): array {
        $proposerDanss = [];
        foreach ($proposerDansAssoc as $proposerDansAssoc) {
            $proposerDanss[] = $this->hydrate($proposerDansAssoc);
        }
        return $proposerDanss;
    }

}