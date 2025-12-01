<?php

class LineaComandes{
    private int $id;
    private float $preuUnitat;
    private int $idComanda;
    private int $idProducte;
    
    // public function __construct(float $preuUnitat, int $idComanda, int $idProducte){
    //     $this-> preuUnitat = $preuUnitat;
    //     $this-> idComanda = $idComanda;
    //     $this-> idProducte = $idProducte;
    // }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of preuUnitat
     */ 
    public function getPreuUnitat()
    {
        return $this->preuUnitat;
    }

    /**
     * Get the value of idComanda
     */ 
    public function getIdComanda()
    {
        return $this->idComanda;
    }

    /**
     * Get the value of idProducte
     */ 
    public function getIdProducte()
    {
        return $this->idProducte;
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
     * Set the value of preuUnitat
     *
     * @return  self
     */ 
    public function setPreuUnitat($preuUnitat)
    {
        $this->preuUnitat = $preuUnitat;

        return $this;
    }

    /**
     * Set the value of idComanda
     *
     * @return  self
     */ 
    public function setIdComanda($idComanda)
    {
        $this->idComanda = $idComanda;

        return $this;
    }

    /**
     * Set the value of idProducte
     *
     * @return  self
     */ 
    public function setIdProducte($idProducte)
    {
        $this->idProducte = $idProducte;

        return $this;
    }
}

?>