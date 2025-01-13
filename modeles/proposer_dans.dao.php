<?php
/**
 * @file proposer_dans.dao.php
 * @brief Classe ProposerDansDao
 */

/**
 * @brief Classe ProposerDansDao
 * @details Cette classe permet de gérer les propositions de créneaux dans des salles de sport
 */
class ProposerDansDao extends Dao {
    /**
     * Constructeur de la classe ProposerDansDao
     * @param PDO|null $pdo
     * @return void
     */
    public function __construct(?PDO $pdo = null) {
        parent::__construct($pdo);  // Appelle le constructeur de la classe parent (Dao)
    }

    /**
     * Méthode pour trouver une proposition de créneau dans une salle de sport par son identifiant
     * @param int $id L'identifiant de la proposition de créneau
     * @return ProposerDans|null La proposition de créneau trouvée
     */
    public function find(int $id): ?ProposerDans {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->tables['proposer_dans'] . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ProposerDans::class);
        return $stmt->fetch();
    }

    /**
     * Méthode pour récupérer toutes les propositions de créneaux dans des salles de sport
     * @return ProposerDans[] Les propositions de créneaux récupérées
     */
    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM ' . $this->tables['proposer_dans']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ProposerDans::class);
        return $stmt->fetchAll();
    }

    /**
     * Méthode pour hydrater un objet ProposerDans
     * @param array $proposerDansAssoc Le tableau associatif représentant un objet ProposerDans
     * @return ProposerDans L'objet ProposerDans hydraté
     */
    public function hydrate(array $proposerDansAssoc): ProposerDans {
        $proposerDans = new ProposerDans();
        $proposerDans->setIdCreneau($proposerDansAssoc['idCreneau']);
        $proposerDans->setIdSalleDeSport($proposerDansAssoc['idSalleDeSport']);
        return $proposerDans;
    }

    /**
     * Méthode pour hydrater un tableau d'objets ProposerDans
     * @param array $proposerDansAssoc Le tableau associatif représentant des objets ProposerDans
     * @return ProposerDans[] Le tableau d'objets ProposerDans hydraté
     */
    public function hydrateAll(array $proposerDansAssoc): array {
        $proposerDanss = [];
        foreach ($proposerDansAssoc as $proposerDansAssoc) {
            $proposerDanss[] = $this->hydrate($proposerDansAssoc);
        }
        return $proposerDanss;
    }
}
