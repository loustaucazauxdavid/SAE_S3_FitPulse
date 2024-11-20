<?php
/**
 * @file commenter.class.php
 * @brief Classe Commenter
 */

class Commenter {
    private ?int $idPratiquant;
    private ?int $idCoach;
    private ?float $note;
    private ?string $titre;
    private ?string $contenu;
    private ?DateTime $datePost;

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
     */ 
    public function getIdPratiquant(): ?int
    {
        return $this->idPratiquant;
    }

    /**
     * Setter de la variable membre idPratiquant
     */ 
    public function setIdPratiquant(?int $idPratiquant): void
    {
        $this->idPratiquant = $idPratiquant;
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

    /**
     * Getter de la variable membre note
     */ 
    public function getNote(): ?float
    {
        return $this->note;
    }

    /**
     * Setter de la variable membre note
     */ 
    public function setNote(?float $note): void
    {
        $this->note = $note;
    }

    /**
     * Getter de la variable membre titre
     */ 
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * Setter de la variable membre titre
     */ 
    public function setTitre(?string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * Getter de la variable membre contenu
     */ 
    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    /**
     * Setter de la variable membre contenu
     */ 
    public function setContenu(?string $contenu): void
    {
        $this->contenu = $contenu;
    }

    /**
     * Getter de la variable membre datePost
     */ 
    public function getDatePost(): ?DateTime
    {
        return $this->datePost;
    }

    /**
     * Setter de la variable membre datePost
     */ 
    public function setDatePost(?DateTime $datePost): void
    {
        $this->datePost = $datePost;
    }
}
