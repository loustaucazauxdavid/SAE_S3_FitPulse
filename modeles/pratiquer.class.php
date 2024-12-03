<?php

class Pratiquer
{
    private ?int $idCoach;
    private ?int $idDiscipline;
    
    public function __construct(?int $idCoach = null, ?int $idDiscipline = null)
    {
        $this->idCoach = $idCoach;
        $this->idDiscipline = $idDiscipline;
    }

    public function getIdCoach(): ?int
    {
        return $this->idCoach;
    }

    public function setIdCoach(?int $idCoach): self
    {
        $this->idCoach = $idCoach;

        return $this;
    }

    public function getIdDiscipline(): ?int
    {
        return $this->idDiscipline;
    }   

    public function setIdDiscipline(?int $idDiscipline): self
    {
        $this->idDiscipline = $idDiscipline;

        return $this;
    }
}
