<?php
/**
 * @file salle_de_sport.class.php
 * @brief Classe SalleDeSport
 */

/**
 * @brief Classe SalleDeSport
 * @details Cette classe permet de gérer les salles de sport
 */
class SalleDeSport {
    private ?int $id;
    private ?string $nom;
    private ?string $photo;
    private ?string $description;
    private ?bool $accessPmr;
    private ?bool $enLigne;
    private ?string $adresse;
    private ?string $codePostal;
    private ?string $ville;
    private ?string $pays;
    private ?string $lienGoogleMaps;

    /**
     * @brief Constructeur de la classe SalleDeSport
     * @param int|null $id Identifiant de la salle de sport
     * @param string|null $nom Nom de la salle de sport
     * @param string|null $photo Chemin de la photo de la salle de sport
     * @param string|null $description Description de la salle de sport
     * @param bool|null $accessPmr Accessibilité PMR de la salle de sport
     * @param bool|null $enLigne En ligne ou non
     * @param string|null $adresse Adresse de la salle de sport
     * @param string|null $codePostal Code postal de la salle de sport
     * @param string|null $ville Ville de la salle de sport
     * @param string|null $pays Pays de la salle de sport
     * @param string|null $lienGoogleMaps Lien Google Maps de la salle de sport
     */
    public function __construct(
        ?int $id = null, 
        ?string $nom = null,
        ?string $photo = null,
        ?string $description = null,
        ?bool $accessPmr = null,
        ?bool $enLigne = null,
        ?string $adresse = null,
        ?string $codePostal = null,
        ?string $ville = null,
        ?string $pays = null,
        ?string $lienGoogleMaps = null) 
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->photo = $photo;
        $this->description = $description;
        $this->accessPmr = $accessPmr;
        $this->enLigne = $enLigne;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->lienGoogleMaps = $lienGoogleMaps;
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
     * Getter de la variable membre nom
     * @return string|null
     */ 
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Setter de la variable membre nom
     * @param string|null $nom
     */ 
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Getter de la variable membre photo
     * @return string|null
     */ 
    public function getPhoto(): ?string {
        return $this->photo;
    }

    /**
     * Setter de la variable membre photo
     * @param string|null $photo
     */ 
    public function setPhoto(?string $photo): void {
        $this->photo = $photo;
    }

    /**
     * Getter de la variable membre description
     * @return string|null
     */ 
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * Setter de la variable membre description
     * @param string|null $description
     */ 
    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    /**
     * Getter de la variable membre accessPmr
     * @return bool|null
     */ 
    public function getAccessPmr(): ?bool {
        return $this->accessPmr;
    }

    /**
     * Setter de la variable membre accessPmr
     * @param bool|null $accessPmr
     */ 
    public function setAccessPmr(?bool $accessPmr): void {
        $this->accessPmr = $accessPmr;
    }

    /**
     * Getter de la variable membre enLigne
     * @return bool|null
     */ 
    public function getEnLigne(): ?bool {
        return $this->enLigne;
    }

    /**
     * Setter de la variable membre enLigne
     * @param bool|null $enLigne
     */ 
    public function setEnLigne(?bool $enLigne): void {
        $this->enLigne = $enLigne;
    }

    /**
     * Getter de la variable membre adresse
     * @return string|null
     */ 
    public function getAdresse(): ?string {
        return $this->adresse;
    }

    /**
     * Setter de la variable membre adresse
     * @param string|null $adresse
     */ 
    public function setAdresse(?string $adresse): void {
        $this->adresse = $adresse;
    }

    /**
     * Getter de la variable membre codePostal
     * @return string|null
     */ 
    public function getCodePostal(): ?string {
        return $this->codePostal;
    }

    /**
     * Setter de la variable membre codePostal
     * @param string|null $codePostal
     */ 
    public function setCodePostal(?string $codePostal): void {
        $this->codePostal = $codePostal;
    }

    /**
     * Getter de la variable membre ville
     * @return string|null $ville
     */ 
    public function getVille(): ?string {
        return $this->ville;
    }

    /**
     * Setter de la variable membre ville
     * @param string|null $ville
     */ 
    public function setVille(?string $ville): void {
        $this->ville = $ville;
    }

    /**
     * Getter de la variable membre pays
     * @return string|null $pays
     */ 
    public function getPays(): ?string {
        return $this->pays;
    }

    /**
     * Setter de la variable membre pays
     * @param string|null $pays
     */ 
    public function setPays(?string $pays): void {
        $this->pays = $pays;
    }

    /**
     * Getter de la variable membre lienGoogleMaps
     * @return string|null
     */ 
    public function getLienGoogleMaps(): ?string {
        return $this->lienGoogleMaps;
    }

    /**
     * Setter de la variable membre lienGoogleMaps
     * @param string|null $lienGoogleMaps
     */ 
    public function setLienGoogleMaps(?string $lienGoogleMaps): void {
        $this->lienGoogleMaps = $lienGoogleMaps;
    }
}