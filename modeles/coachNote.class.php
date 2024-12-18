<?php
/**
 * @file coachNote.class.php
 * @brief Classe pour coachNote
 */

/**
 * @brief Classe pour coachNote
 * @details Gère les informations liées à coachNote
 */
class CoachNote {
    private ?Coach $coach;
    private ?float $noteMoyenne;

    /**
     * Constructeur de la classe CoachNote
     * @param Coach|null $coach
     * @param int|null $noteMoyenne
     * @return void
     */
    public function __construct(?Coach $coach = null, ?int $noteMoyenne = null)
    {
        $this->coach = $coach;
        $this->noteMoyenne = $noteMoyenne;
    }

    /**
     * Getter de la variable membre noteMoyenne
     * @return Coach|null Le coach
     */ 
    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    /**
     * Setter de la variable membre noteMoyenne
     * @param Coach|null $coach
     */ 
    public function setCoach(?Coach $coach): void
    {
        $this->coach = $coach;
    }

    /**
     * Getter de la variable membre noteMoyenne
     * @return int|null La note moyenne du coach
     */ 
    public function getNoteMoyenne(): ?float
    {
        return $this->noteMoyenne;
    }

    /**
     * Setter de la variable membre noteMoyenne
     * @param int|null $noteMoyenne
     */ 
    public function setNoteMoyenne(?float $noteMoyenne): void
    {
        $this->noteMoyenne = $noteMoyenne;
    }
}
