<?php
class Alergans{
    private int $id;
    private string $nom;
    private string $descripcio;
    private string $imatge;
    
    public function __construct(string $nom, string $descripcio, string $imatge){
        $this-> nom = $nom;
        $this-> descripcio = $descripcio;
        $this-> imatge = $imatge;
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
     * Get the value of descripcio
     */ 
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     * Get the value of imatge
     */ 
    public function getImatge()
    {
        return $this->imatge;
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
     * Set the value of descripcio
     *
     * @return  self
     */ 
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;

        return $this;
    }

    /**
     * Set the value of imatge
     *
     * @return  self
     */ 
    public function setImatge($imatge)
    {
        $this->imatge = $imatge;

        return $this;
    }
}
?>