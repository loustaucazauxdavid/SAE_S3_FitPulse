<?php
/**
 * @file pratiquer.dao.php
 * @brief Classe PratiquerDao
 */

require_once 'config/constantes.php';

/**
 * @brief Classe PratiquerDao
 * @details Cette classe permet de gérer les pratiques
 */
class PratiquerDao {
    private ?PDO $pdo;

    /**
     * Constructeur de la classe PratiquerDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }

    /**
     * Getter de la variable membre pdo
     * @return PDO|null
     */
    public function getPdo(): ?PDO {
        return $this->pdo;
    }

    /**
     * Setter de la variable membre pdo
     * @param PDO $pdo
     */
    public function setPdo(PDO $pdo): void {
        $this->pdo = $pdo;
    }

    /**
     * Méthode pour trouver une pratique par son identifiant
     * @param int $id L'identifiant de la pratique
     * @return Pratiquer|null La pratique trouvée
     */
    public function find(int $id): ?Pratiquer {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . TABLE_PRATIQUER . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquer::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer toutes les pratiques
     * @return Pratiquer[] Les pratiques récupérées
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . TABLE_PRATIQUER);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquer::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet Pratiquer
     * @param array $pratiquerAssoc Le tableau associatif représentant un objet Pratiquer
     * @return Pratiquer L'objet Pratiquer hydraté
     */
    public function hydrate(array $pratiquerAssoc): Pratiquer {
        $pratiquer = new Pratiquer();
        $pratiquer->setIdCoach($pratiquerAssoc['idCoach']);
        $pratiquer->setIdDiscipline($pratiquerAssoc['idDiscipline']);
        return $pratiquer;
    }

    /**
     * Méthode pour hydrater un tableau d'objets Pratiquer
     * @param array $pratiquerAssoc Le tableau associatif représentant des objets Pratiquer
     * @return Pratiquer Le tableau d'objets Pratiquer hydraté
     */
    public function hydrateAll(array $pratiquersAssoc): array {
        $pratiquers = [];
        foreach ($pratiquersAssoc as $pratiquerAssoc) {
            $pratiquers[] = $this->hydrate($pratiquerAssoc);
        }
        return $pratiquers;
    }


}