<?php

class CategorieDao{
    private ?PDO $pdo;

    public function __construct(?PDO $pdo=null){
        $this->pdo = $pdo;
    }

    

    /**
     * Get the value of pdo
     */ 
    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     */ 
    public function setPdo($pdo): void
    {
        $this->pdo = $pdo;
    }


    public function find(?int $id): ?Categorie
    {
        $sql="SELECT * FROM ".PREFIXE_TABLE."categorie WHERE id= :id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array("id"=>$id));
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
        $categorie = $pdoStatement->fetch();
        return $categorie;
    }

    public function findAll(){
        $sql="SELECT * FROM ".PREFIXE_TABLE."categorie";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
        $categorie = $pdoStatement->fetchAll();
        return $categorie;
    }

    public function findAssoc(?int $id): ?array
    {
        $sql="SELECT * FROM ".PREFIXE_TABLE."categorie WHERE id= :id";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute(array("id"=>$id));
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $categorie = $pdoStatement->fetch();
        return $categorie;
    }

    public function findAllAssoc(){
        $sql="SELECT * FROM ".PREFIXE_TABLE."categorie";
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
        $categorie = $pdoStatement->fetchAll();
        return $categorie;
    }

    public function hydrate($tableauAssoc): ?Categorie
    {
        $categorie = new Categorie();
        $categorie->setId($tableauAssoc['id']);
        $categorie->setNom($tableauAssoc['nom']);
        $categorie->setImage($tableauAssoc['image']);
        return $categorie;
    }

    public function hydrateAll($tableau): ?array{
        $categories = [];
        foreach($tableau as $tableauAssoc){
            $categorie = $this->hydrate($tableauAssoc);
            $categories[] = $categorie;
        }
        return $categories;
    }
}