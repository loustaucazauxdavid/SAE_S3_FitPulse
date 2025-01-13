<?php
/**
 * @file pratiquer.dao.php
 * @brief Classe PratiquerDao
 */

/**
 * @brief Classe PratiquerDao
 * @details Cette classe permet de gérer les pratiques
 */
class PratiquerDao extends Dao {
    /**
     * Constructeur de la classe PratiquerDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(PDO $pdo = null) {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
    }

    /**
     * Méthode pour trouver une pratique par son identifiant
     * @param int $id L'identifiant de la pratique
     * @return Pratiquer|null La pratique trouvée
     */
    public function find(int $id): ?Pratiquer {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->tables['pratiquer'] . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Pratiquer::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer toutes les pratiques
     * @return Pratiquer[] Les pratiques récupérées
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . $this->tables['pratiquer']);
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
     * @return Pratiquer[] Le tableau d'objets Pratiquer hydraté
     */
    public function hydrateAll(array $pratiquerAssoc): array {
        $pratiquers = [];
        foreach ($pratiquerAssoc as $pratiquer) {
            $pratiquers[] = $this->hydrate($pratiquer);
        }
        return $pratiquers;
    }
}
