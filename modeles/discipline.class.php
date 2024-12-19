<?php
/**
 * @file discipline.class.php
 * @brief Classe Discipline
 */

/**
 * @brief Classe Discipline
 * @details Cette classe permet de gérer les disciplines
 */
class Discipline {
    private ?int $id;
    private ?string $nom;

    /**
     * @brief Constructeur de la classe Discipline
     * @param int|null $id Identifiant de la discipline
     * @param string|null $nom Nom de la discipline
     */
    public function __construct(
        ?int $id = null,
        ?string $nom = null)
    {
        $this->id = $id;
        $this->nom = $nom; 
    }   

    /**
     * Getter de la variable membre id
     * @return int|null L'identifiant de la discipline
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
     * @return string|null Le nom de la discipline
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
}