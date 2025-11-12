<?php
class Usuari{
    private $id;
    private $nom;
    private $cognoms;
    private $correu;
    private $telefon;
    private $rol;

    

    /**
     * Get the value of id, nom, cognom. correu. telefon i rol
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getCognoms()
    {
        return $this->cognoms;
    }

    public function getCorreu()
    {
        return $this->correu;
    }

    public function getTelefon()
    {
        return $this->telefon;
    }

    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of id
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set the value of nom
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Set the value of cognoms
     * @return  self
     */ 
    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;
        return $this;
    }

    /**
     * Set the value of correu
     * @return  self
     */ 
    public function setCorreu($correu)
    {
        $this->correu = $correu;
        return $this;
    }

    /**
     * Set the value of telefon
     * @return  self
     */ 
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;
        return $this;
    }

    /**
     * Set the value of rol
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;
        return $this;
    }
}
?>