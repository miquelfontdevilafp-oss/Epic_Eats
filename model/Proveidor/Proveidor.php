<?php
class Proveidor{
    private int $id;
    private string $nom;
    private string $correu;
    private string $telefon;
    
    public function __construct(string $nom, string $correu, string $telefon){
        $this-> nom = $nom;
        $this-> correu = $correu;
        $this-> telefon = $telefon;
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
     * Get the value of correu
     */ 
    public function getCorreu()
    {
        return $this->correu;
    }

    /**
     * Get the value of telefon
     */ 
    public function getTelefon()
    {
        return $this->telefon;
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
     * Set the value of correu
     *
     * @return  self
     */ 
    public function setCorreu($correu)
    {
        $this->correu = $correu;

        return $this;
    }

    /**
     * Set the value of telefon
     *
     * @return  self
     */ 
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;

        return $this;
    }
}