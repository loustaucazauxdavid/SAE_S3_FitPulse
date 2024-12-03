<?php

class ProposerDans
{
    private ?int $idCreneau;
    private ?int $idSalleDeSport;
    
    public function __construct(?int $idCreneau = null, ?int $idSalleDeSport = null)
    {
        $this->idCreneau = $idCreneau;
        $this->idSalleDeSport = $idSalleDeSport;
    }

    public function getIdCreneau(): ?int
    {
        return $this->idCreneau;
    }

    public function setIdCreneau(?int $idCreneau): self
    {
        $this->idCreneau = $idCreneau;

        return $this;
    }

    public function getIdSalleDeSport(): ?int
    {
        return $this->idSalleDeSport;
    }

    public function setIdSalleDeSport(?int $idSalleDeSport): self
    {
        $this->idSalleDeSport = $idSalleDeSport;

        return $this;
    }
}
