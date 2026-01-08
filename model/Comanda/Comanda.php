<?php
class Comanda{
    private int $id;
    private float $preu_total;
    private int $id_usuari;

    // public function __construct(float $preu_total, int $id_usuari){
    //         $this -> preu_total = $preu_total;
    //         $this -> id_usuari = $id_usuari;
    //     }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of preu_total
     */ 
    public function getPreuTotal()
    {
        return $this->preu_total;
    }

    /**
     * Get the value of id_usuari
     */ 
    public function getId_usuari()
    {
        return $this->id_usuari;
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
     * Set the value of preu_total
     *
     * @return  self
     */ 
    public function setPreuTotal($preu_total)
    {
        $this->preu_total = $preu_total;

        return $this;
    }

    /**
     * Set the value of id_usuari
     *
     * @return  self
     */ 
    public function setId_usuari($id_usuari)
    {
        $this->id_usuari = $id_usuari;

        return $this;
    }
}

?>