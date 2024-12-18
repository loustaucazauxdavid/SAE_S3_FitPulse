<?php
/**
 * @file pratiquant.class.php
 * @brief Classe Pratiquant
 */

/**
 * @brief Classe Pratiquant
 * @details Cette classe permet de gérer les pratiquants
 */
class Pratiquant {
    private ?int $id;
    private ?string $contact;
    private ?string $description;
    private ?int $idUtilisateur;
    
    /**
     * @brief Constructeur de la classe Pratiquant
     * @param int|null $id Identifiant du pratiquant
     * @param string|null $contact Contact du pratiquant
     * @param string|null $description Description du pratiquant
     */
    public function __construct(?int $id = null, ?string $contact = null, ?string $description = null){
        $this->id = $id;
        $this->contact = $contact;
        $this->description = $description;
    }

    /**
     * Getter de la variable membre id
     * @return int|null
     */ 
    public function getId(): ?int{
        return $this->id;
    }

    /**
     * Getter de la variable membre contact
     * @return string|null
     */
    public function getContact(): ?string{
        return $this->contact;
    }

    /**
     * Getter de la variable membre description
     * @return string|null
     */
    public function getDescription(): ?string{
        return $this->description;
    }

    /**
     * Setter de la variable membre id
     * @param int|null $id
     */
    public function setId(?int $id): void{
        $this->id = $id;
    }

    /**
     * Setter de la variable membre contact
     * @param string|null $contact
     */
    public function setContact(?string $contact): void{
        $this->contact = $contact;
    }

    /**
     * Setter de la variable membre description
     * @param string|null $description
     */
    public function setDescription(?string $description): void{
        $this->description = $description;
    }

    /**
     * Getter de la variable membre idUtilisateur
     * @return int|null
     */
    public function getIdUtilisateur(): ?int{
        return $this->idUtilisateur;
    }

    /**
     * Setter de la variable membre idUtilisateur
     * @param int|null $idUtilisateur
     */
    public function setIdUtilisateur(?int $idUtilisateur): void{
        $this->idUtilisateur = $idUtilisateur;
    }
}
