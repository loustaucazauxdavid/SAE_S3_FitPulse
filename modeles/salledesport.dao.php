<?php

const TABLE_SALLE_DE_SPORT = PREFIXE_TABLE . 'Salle_de_sport';

class SalleDeSportDao {
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

    public function find(int $id): ?SalleDeSport {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_SALLE_DE_SPORT . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, SalleDeSport::class);
        return $stmt->fetch();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_SALLE_DE_SPORT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, SalleDeSport::class);
        return $stmt->fetchAll();
    }

    public function hydrate(array $salleDeSportAssoc): SalleDeSport {
        $salleDeSport = new SalleDeSport();
        $salleDeSport->setId($salleDeSportAssoc['id']);
        $salleDeSport->setNom($salleDeSportAssoc['nom']);
        $salleDeSport->setAdresse($salleDeSportAssoc['adresse']);
        $salleDeSport->setDescription($salleDeSportAssoc['description']);
        $salleDeSport->setAccessPmr($salleDeSportAssoc['accessPMR']);
        $salleDeSport->setEnLigne($salleDeSportAssoc['enLigne']);
        $salleDeSport->setAdresse($salleDeSportAssoc['adresse']);
        $salleDeSport->setCodePostal($salleDeSportAssoc['codePostal']);
        $salleDeSport->setVille($salleDeSportAssoc['ville']);
        $salleDeSport->setPays($salleDeSportAssoc['pays']);
        $salleDeSport->setLienGoogleMaps($salleDeSportAssoc['lienGoogleMaps']);
        return $salleDeSport;
    }

    public function hydrateAll(array $salleDeSportsAssoc): array {
        $salleDeSports = [];
        foreach ($salleDeSportsAssoc as $salleDeSportAssoc) {
            $salleDeSports[] = $this->hydrate($salleDeSportAssoc);
        }
        return $salleDeSports;
    }

}