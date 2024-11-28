<?php

const TABLE_COACH = PREFIXE_TABLE . 'Coach';

class CoachDao {
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

    public function find(int $id): ?Coach {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_COACH . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Coach::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_COACH);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Coach::class);
        return $stmt->fetchAll();
    }

    public function hydrate(array $coachAssoc): Coach {
        $coach = new Coach();
        $coach->setId($coachAssoc['id']);
        $coach->setContact($coachAssoc['contact']);
        $coach->setDescription($coachAssoc['description']);
        $coach->setLieuCours(LieuCours::from($coachAssoc['lieuCours'])); // Conversion en Enum
        $coach->setEstVerifie((bool) $coachAssoc['estVerifie']); // Conversion en booléen
        $coach->setEmailPaypal($coachAssoc['emailPaypal']);
        $coach->setIdUtilisateur($coachAssoc['idUtilisateur']);
        return $coach;
    }

    public function hydrateAll(array $coachsAssoc): array {
        $coachs = [];
        foreach ($coachsAssoc as $coachAssoc) {
            $coachs[] = $this->hydrate($coachAssoc);
        }
        return $coachs;
    }
}