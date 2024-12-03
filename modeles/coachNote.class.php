<?php

/**
 * Classe CoachNote
 */

class CoachNote {
    private ?Coach $coach;
    private ?float $noteMoyenne;

    public function __construct(
        ?Coach $coach = null,
        ?int $noteMoyenne = null)
    {
        $this->coach = $coach;
        $this->noteMoyenne = $noteMoyenne;
    }

    /**
     * Getter de la variable membre noteMoyenne
     */ 
    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    /**
     * Setter de la variable membre noteMoyenne
     */ 
    public function setCoach(?Coach $coach): void
    {
        $this->coach = $coach;
    }

    /**
     * Getter de la variable membre noteMoyenne
     */ 
    public function getNoteMoyenne(): ?float
    {
        return $this->noteMoyenne;
    }

    /**
     * Setter de la variable membre noteMoyenne
     */ 
    public function setNoteMoyenne(?float $noteMoyenne): void
    {
        $this->noteMoyenne = $noteMoyenne;
    }
}
