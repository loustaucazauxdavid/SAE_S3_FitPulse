<?php

const TABLE_CRENEAU = PREFIXE_TABLE . 'Creneau';

class CreneauDao {
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

    public function find(int $id): ?Creneau {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_CRENEAU . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Creneau::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_CRENEAU);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Creneau::class);
        return $stmt->fetchAll();
    }

    public function hydrate(array $creneauAssoc): Creneau {
        $creneau = new Creneau();
        $creneau->setId($creneauAssoc['id']);
        $creneau->setDateDebut($creneauAssoc['heureDebut']);
        $creneau->setDateFin($creneauAssoc['heureFin']);
        $creneau->setCapacite($creneauAssoc['capacite']);
        $creneau->setIdCoach($creneauAssoc['idCoach']);
        $creneau->setTarif($creneauAssoc['tarif']);
        return $creneau;
    }

    public function hydrateAll(array $creneauxAssoc): array {
        $creneaux = [];
        foreach ($creneauxAssoc as $creneauAssoc) {
            $creneaux[] = $this->hydrate($creneauAssoc);
        }
        return $creneaux;
    }

}