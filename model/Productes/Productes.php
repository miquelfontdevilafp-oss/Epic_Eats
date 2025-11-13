<?php
class Usuari{
    private int $id;
    private string $nom;
    private int $enCarta; // 0 false 1 true
    private string $descripcio;
    private float $preuUnitat;
    private DateTime $tempsCoaccio;
    private string $imatge;
    
    public function __construct(int $id, string $nom, string $descripcio, string $preuUnitat, DateTime $tempsCoaccio, string $imatge, int $enCarta){
            $this-> id = $id;
            $this-> nom = $nom;
            $this-> descripcio = $descripcio;
            $this-> preuUnitat = $preuUnitat;
            $this-> tempsCoaccio = $tempsCoaccio;
            $this-> imatge = $imatge;
            $this-> enCarta = $enCarta;
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
     * Get the value of preuUnitat
     */ 
    public function getPreuUnitat()
    {
        return $this->preuUnitat;
    }

    /**
     * Get the value of tempsCoaccio
     */ 
    public function getTempsCoaccio()
    {
        return $this->tempsCoaccio;
    }

    /**
     * Get the value of imatge
     */ 
    public function getImatge()
    {
        return $this->imatge;
    }

    /**
     * Get the value of enCarta
     */ 
    public function getEnCarta()
    {
        return $this->enCarta;
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
}

?>