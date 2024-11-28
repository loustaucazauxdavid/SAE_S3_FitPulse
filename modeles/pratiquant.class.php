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
     */ 
    public function getId(): ?int{
        return $id;
    }

    /**
     * Getter de la variable membre contact
     */
    public function getContact(): ?int{
        return $contact;
    }

    /**
     * Getter de la variable membre description
     */
    public function getDescription(): ?int{
        return $description;
    }

    /**
     * Setter de la variable membre id
     */
    public function setId(?int $id): void{
        $this->id = $id;
    }

    /**
     * Setter de la variable membre contact
     */
    public function setContact(?string $contact): void{
        $this->contact = $contact;
    }

    /**
     * Setter de la variable membre description
     */
    public function setDescription(?string $description): void{
        $this->description = $description;
    }
}
