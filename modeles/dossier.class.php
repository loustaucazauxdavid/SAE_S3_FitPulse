<?php

class Dossier {

    private ?int $id;
    private ?string $identiteRecto;
    private ?string $identiteVerso;
    private ?string $certificat;
    private ?string $cv;
    private ?int $idCoach;

    public function __construct(
        ?int $id = null, 
        ?string $identiteRecto = null,
        ?string $identiteVerso = null,
        ?string $certificat = null,
        ?string $cv = null,
        ?int $idCoach = null) 
    {
        $this->id = $id;
        $this->identiteRecto = $identiteRecto;
        $this->identiteVerso = $identiteVerso;
        $this->certificat = $certificat;
        $this->cv = $cv;
        $this->idCoach = $idCoach;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdentiteRecto(): ?string
    {
        return $this->identiteRecto;
    }

    public function setIdentiteRecto(?string $identiteRecto): void
    {
        $this->identiteRecto = $identiteRecto;
    }

    public function getIdentiteVerso(): ?string
    {
        return $this->identiteVerso;
    }

    public function setIdentiteVerso(?string $identiteVerso): void
    {
        $this->identiteVerso = $identiteVerso;
    }

    public function getCertificat(): ?string
    {
        return $this->certificat;
    }

    public function setCertificat(?string $certificat): void
    {
        $this->certificat = $certificat;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): void
    {
        $this->cv = $cv;
    }

    public function getIdCoach(): ?int
    {
        return $this->idCoach;
    }

    public function setIdCoach(?int $idCoach): void
    {
        $this->idCoach = $idCoach;
    }



}