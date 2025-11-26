<?php
class Ingredients{
    private int $id;
    private string $nom;
    private float $quantitat;
    
    public function __construct(string $nom, float $quantitat){
        $this-> nom = $nom;
        $this-> quantitat = $quantitat;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Get the value of quantitat
     */ 
    public function getQuantitat()
    {
        return $this->quantitat;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Set the value of quantitat
     *
     * @return  self
     */ 
    public function setQuantitat($quantitat)
    {
        $this->quantitat = $quantitat;

        return $this;
    }
}


?>