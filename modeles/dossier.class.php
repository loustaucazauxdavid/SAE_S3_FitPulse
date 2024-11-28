<?php
/**
 * @file dossier.class.php
 * @brief Classe Dossier
 */

/**
 * @brief Classe Dossier
 * @details Cette classe permet de gérer les dossiers
 */
class Dossier {
    private ?int $id;
    private ?string $identiteRecto;
    private ?string $identiteVerso;
    private ?string $certificat;
    private ?string $cv;
    private ?int $idCoach;

    /**
     * @brief Constructeur de la classe Dossier
     * @param int|null $id Identifiant du dossier
     * @param string|null $identiteRecto Chemin du fichier de l'identité recto
     * @param string|null $identiteVerso Chemin du fichier de l'identité verso
     * @param string|null $certificat Chemin du fichier du certificat
     * @param string|null $cv Chemin du fichier du CV
     * @param int|null $idCoach Identifiant du coach
     */
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

    /**
     * Getter de la variable membre id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Setter de la variable membre id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter de la variable membre identiteRecto
     */
    public function getIdentiteRecto(): ?string
    {
        return $this->identiteRecto;
    }

    /**
     * Setter de la variable membre identiteRecto
     */
    public function setIdentiteRecto(?string $identiteRecto): void
    {
        $this->identiteRecto = $identiteRecto;
    }

    /**
     * Getter de la variable membre identiteVerso
     */
    public function getIdentiteVerso(): ?string
    {
        return $this->identiteVerso;
    }

    /**
     * Setter de la variable membre identiteVerso
     */
    public function setIdentiteVerso(?string $identiteVerso): void
    {
        $this->identiteVerso = $identiteVerso;
    }

    /**
     * Getter de la variable membre certificat
     */
    public function getCertificat(): ?string
    {
        return $this->certificat;
    }

    /**
     * Setter de la variable membre certificat
     */
    public function setCertificat(?string $certificat): void
    {
        $this->certificat = $certificat;
    }

    /**
     * Getter de la variable membre cv
     */
    public function getCv(): ?string
    {
        return $this->cv;
    }

    /**
     * Setter de la variable membre cv
     */
    public function setCv(?string $cv): void
    {
        $this->cv = $cv;
    }

    /**
     * Getter de la variable membre idCoach
     */
    public function getIdCoach(): ?int
    {
        return $this->idCoach;
    }

    /**
     * Setter de la variable membre idCoach
     */
    public function setIdCoach(?int $idCoach): void
    {
        $this->idCoach = $idCoach;
    }
}