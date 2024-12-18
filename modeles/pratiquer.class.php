<?php
/**
 * @file pratiquer.class.php
 * @brief Classe Pratiquer
 */

/**
 * @brief Classe Pratiquer
 * @details Cette classe permet de gérer les pratiques
 */
class Pratiquer
{
    private ?int $idCoach;
    private ?int $idDiscipline;
    
    /**
     * @brief Constructeur de la classe Pratiquer
     * @param int|null $idCoach Identifiant du coach
     * @param int|null $idDiscipline Identifiant de la discipline
     */
    public function __construct(?int $idCoach = null, ?int $idDiscipline = null)
    {
        $this->idCoach = $idCoach;
        $this->idDiscipline = $idDiscipline;
    }

    /**
     * Getter de la variable membre idCoach
     * @return int|null
     */
    public function getIdCoach(): ?int
    {
        return $this->idCoach;
    }

    /**
     * Setter de la variable membre idCoach
     * @param int|null $idCoach
     */
    public function setIdCoach(?int $idCoach): self
    {
        $this->idCoach = $idCoach;
        return $this;
    }

    /**
     * Getter de la variable membre idDiscipline
     * @return int|null
     */
    public function getIdDiscipline(): ?int
    {
        return $this->idDiscipline;
    }   

    /**
     * Setter de la variable membre idDiscipline
     * @param int|null $idDiscipline
     */
    public function setIdDiscipline(?int $idDiscipline): self
    {
        $this->idDiscipline = $idDiscipline;

        return $this;
    }
}
