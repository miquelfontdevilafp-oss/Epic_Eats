<?php

class Reserva{
    private int $id;
    private DateTime $data;
    private DateTime $hora;
    private int $numeroPersones;
    private int $id_usuari;

    public function __construct(DateTime $data, DateTime $hora, int $numeroPersones, int $id_usuari){
            $this->data = $data;
            $this->hora = $hora;
            $this->numeroPersones = $numeroPersones;
            $this->id_usuari = $id_usuari;
        }

    /**
     * Get the value of id_usuari
     */ 
    public function getId_usuari(){
        return $this->id_usuari;
    }

    /**
     * Get the value of numeroPersones
     */ 
    public function getNumeroPersones(){
        return $this->numeroPersones;
    }

    /**
     * Get the value of hora
     */ 
    public function getHora(){
        return $this->hora;
    }

    /**
     * Get the value of data
     */ 
    public function getData(){
        return $this->data;
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data){
        $this->data = $data;

        return $this;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */ 
    public function setHora($hora){
        $this->hora = $hora;

        return $this;
    }

    /**
     * Set the value of numeroPersones
     *
     * @return  self
     */ 
    public function setNumeroPersones($numeroPersones){
        $this->numeroPersones = $numeroPersones;

        return $this;
    }

    /**
     * Set the value of id_usuari
     *
     * @return  self
     */ 
    public function setId_usuari($id_usuari){
        $this->id_usuari = $id_usuari;

        return $this;
    }
}