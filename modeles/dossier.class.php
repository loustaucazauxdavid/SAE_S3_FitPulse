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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Setter de la variable membre id
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter de la variable membre identiteRecto
     * @return string|null
     */
    public function getIdentiteRecto(): ?string
    {
        return $this->identiteRecto;
    }

    /**
     * Setter de la variable membre identiteRecto
     * @param string|null $identiteRecto
     */
    public function setIdentiteRecto(?string $identiteRecto): void
    {
        $this->identiteRecto = $identiteRecto;
    }

    /**
     * Getter de la variable membre identiteVerso
     * @return string|null
     */
    public function getIdentiteVerso(): ?string
    {
        return $this->identiteVerso;
    }

    /**
     * Setter de la variable membre identiteVerso
     * @param string|null $identiteVerso
     */
    public function setIdentiteVerso(?string $identiteVerso): void
    {
        $this->identiteVerso = $identiteVerso;
    }

    /**
     * Getter de la variable membre certificat
     * @return string|null
     */
    public function getCertificat(): ?string
    {
        return $this->certificat;
    }

    /**
     * Setter de la variable membre certificat
     * @param string|null $certificat
     */
    public function setCertificat(?string $certificat): void
    {
        $this->certificat = $certificat;
    }

    /**
     * Getter de la variable membre cv
     * @return string|null
     */
    public function getCv(): ?string
    {
        return $this->cv;
    }

    /**
     * Setter de la variable membre cv
     * @param string|null $cv
     */
    public function setCv(?string $cv): void
    {
        $this->cv = $cv;
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
    public function setIdCoach(?int $idCoach): void
    {
        $this->idCoach = $idCoach;
    }
}