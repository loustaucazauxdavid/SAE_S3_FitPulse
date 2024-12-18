<?php
/**
 * @file proposer_dans.class.php
 * @brief Classe ProposerDans
 */

/**
 * @brief Classe ProposerDans
 * @details Cette classe permet de gérer la table ProposerDans, qui permet de savoir dans quelles salles de sport sont proposés les créneaux
 */
class ProposerDans
{
    private ?int $idCreneau;
    private ?int $idSalleDeSport;
    
    /**
     * @brief Constructeur de la classe ProposerDans
     * @param int|null $idCreneau Identifiant du créneau
     * @param int|null $idSalleDeSport Identifiant de la salle de sport
     */
    public function __construct(?int $idCreneau = null, ?int $idSalleDeSport = null)
    {
        $this->idCreneau = $idCreneau;
        $this->idSalleDeSport = $idSalleDeSport;
    }

    /**
     * Getter de la variable membre idCreneau
     * @return int|null
     */
    public function getIdCreneau(): ?int
    {
        return $this->idCreneau;
    }

    /**
     * Setter de la variable membre idCreneau
     * @param int|null $idCreneau
     */
    public function setIdCreneau(?int $idCreneau): self
    {
        $this->idCreneau = $idCreneau;
        return $this;
    }

    /**
     * Getter de la variable membre idSalleDeSport
     * @return int|null
     */
    public function getIdSalleDeSport(): ?int
    {
        return $this->idSalleDeSport;
    }

    /**
     * Setter de la variable membre idSalleDeSport
     * @param int|null $idSalleDeSport
     */
    public function setIdSalleDeSport(?int $idSalleDeSport): self
    {
        $this->idSalleDeSport = $idSalleDeSport;
        return $this;
    }
}
