<?php
class Productes{
    private int $id;
    private string $nom;
    private int $en_carta; // 0 false 1 true
    private string $descripcio;
    private float $preu_unitat;
    private string $imatge;
    
    // public function __construct(int $id, string $nom, string $descripcio, string $preu_unitat, string $imatge, int $en_carta){
    //         $this-> id = $id;
    //         $this-> nom = $nom;
    //         $this-> descripcio = $descripcio;
    //         $this-> preu_unitat = $preu_unitat;
    //         $this-> imatge = $imatge;
    //         $this-> en_carta = $en_carta;
    //     }

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
     * Get the value of preu_unitat
     */ 
    public function getPreuUnitat()
    {
        return $this->preu_unitat;
    }

    /**
     * Get the value of temps_coaccio
     */ 


    /**
     * Get the value of imatge
     */ 
    public function getImatge()
    {
        return $this->imatge;
    }

    /**
     * Get the value of en_carta
     */ 
    public function getEnCarta()
    {
        return $this->en_carta;
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
     * Set the value of en_carta
     *
     * @return  self
     */ 
    public function setEn_carta($en_carta)
    {
        $this->en_carta = $en_carta;

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
     * Set the value of preu_unitat
     *
     * @return  self
     */ 
    public function setPreu_unitat($preu_unitat)
    {
        $this->preu_unitat = $preu_unitat;

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