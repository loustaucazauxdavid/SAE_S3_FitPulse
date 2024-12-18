<?php
/**
 * @file commenter.class.php
 * @brief Classe Commenter
 */

/**
 * @brief Classe Commenter
 * @details Cette classe permet de créer un commentaire
 */
class Commenter {
    private ?int $idPratiquant;
    private ?int $idCoach;
    private ?float $note;
    private ?string $titre;
    private ?string $contenu;
    private ?DateTime $datePost;

    /**
     * @brief Constructeur de la classe Commenter
     * @param int $idPratiquant Identifiant du pratiquant
     * @param int $idCoach Identifiant du coach
     * @param float $note Note attribuée au coach
     * @param string $titre Titre du commentaire
     * @param string $contenu Contenu du commentaire
     * @param DateTime $datePost Date de publication du commentaire
     */
    public function __construct(
        ?int $idPratiquant = null,
        ?int $idCoach = null,
        ?float $note = null,
        ?string $titre = null,
        ?string $contenu = null,
        ?DateTime $datePost = null
    ) {
        $this->idPratiquant = $idPratiquant;
        $this->idCoach = $idCoach;
        $this->note = $note;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->datePost = $datePost;
    }

    /**
     * Getter de la variable membre idPratiquant
     * @return int|null L'identifiant du pratiquant
     */ 
    public function getIdPratiquant(): ?int
    {
        return $this->idPratiquant;
    }

    /**
     * Setter de la variable membre idPratiquant
     * @param int|null $idPratiquant
     */ 
    public function setIdPratiquant(?int $idPratiquant): void
    {
        $this->idPratiquant = $idPratiquant;
    }

    /**
     * Getter de la variable membre idCoach
     * @return int|null L'identifiant du coach
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

    /**
     * Getter de la variable membre note
     * @return float|null La note attribuée au coach
     */ 
    public function getNote(): ?float
    {
        return $this->note;
    }

    /**
     * Setter de la variable membre note
     * @param float|null $note
     */ 
    public function setNote(?float $note): void
    {
        $this->note = $note;
    }

    /**
     * Getter de la variable membre titre
     * @return string|null Le titre du commentaire
     */ 
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * Setter de la variable membre titre
     * @param string|null $titre
     */ 
    public function setTitre(?string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * Getter de la variable membre contenu
     * @return string|null Le contenu du commentaire
     */ 
    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    /**
     * Setter de la variable membre contenu
     * @param string|null $contenu
     */ 
    public function setContenu(?string $contenu): void
    {
        $this->contenu = $contenu;
    }

    /**
     * Getter de la variable membre datePost
     * @return DateTime|null La date de publication du commentaire
     */ 
    public function getDatePost(): ?DateTime
    {
        return $this->datePost;
    }

    /**
     * Setter de la variable membre datePost
     * @param DateTime|null $datePost
     */ 
    public function setDatePost(?DateTime $datePost): void
    {
        $this->datePost = $datePost;
    }
}
