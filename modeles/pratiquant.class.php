<?php


class Pratiquant {
    private ?int $id;
    private ?string $contact;
    private ?string $description;
    
    public function __construct(?int $id = null, ?string $contact = null, ?string $description = null){
        $this->id = $id;
        $this->contact = $contact;
        $this->description = $description;
    }

    // getters et setters 
    public function getId(): ?int{
        return $id;
    }

    public function getContact(): ?int{
        return $contact;
    }

    public function getDescription(): ?int{
        return $description;
    }

    public function setId(?int $id): void{
        $this->id = $id;
    }

    public function setContact(?string $contact): void{
        $this->contact = $contact;
    }

    public function setDescription(?string $description): void{
        $this->description = $description;
    }
}
