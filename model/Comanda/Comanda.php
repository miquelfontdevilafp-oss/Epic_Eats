<?php
class Comanda{
    private int $id;
    private float $preuTotal;
    private int $idUsuari;

    public function __construct(float $preuTotal, int $idUsuari){
            $this -> preuTotal = $preuTotal;
            $this -> idUsuari = $idUsuari;
        }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of preuTotal
     */ 
    public function getPreuTotal()
    {
        return $this->preuTotal;
    }

    /**
     * Get the value of idUsuari
     */ 
    public function getIdUsuari()
    {
        return $this->idUsuari;
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
     * Set the value of preuTotal
     *
     * @return  self
     */ 
    public function setPreuTotal($preuTotal)
    {
        $this->preuTotal = $preuTotal;

        return $this;
    }

    /**
     * Set the value of idUsuari
     *
     * @return  self
     */ 
    public function setIdUsuari($idUsuari)
    {
        $this->idUsuari = $idUsuari;

        return $this;
    }
}

?>