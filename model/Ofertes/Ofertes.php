<?php
class Ofertes{
    private int $id;
    private string $nom;
    private string $tipus;
    private DateTime $dataInici;
    private DateTime $dataFi;
    private float $xifraDescompte;
    private float $persentatjeDescompte;
    
    // public function __construct(string $nom, string $tipus, DateTime $dataInici, DateTime $dataFi, bool $persentatge, float $valorDescompte){ //Crear boolean per decidir si valor o persentatge
    //     $this-> nom = $nom;
    //     $this-> tipus = $tipus;
    //     $this-> dataInici = $dataInici;
    //     $this-> dataFi = $dataFi;
    //     if ($persentatge == true) {
    //         $this-> persentatjeDescompte = $valorDescompte;
    //         $this-> xifraDescompte = 0;
    //     }
    //     $this-> xifraDescompte = $valorDescompte;
    //     $this-> persentatjeDescompte = 0;
    // }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of persentatjeDescompte
     */ 
    public function getPersentatjeDescompte()
    {
        return $this->persentatjeDescompte;
    }

    /**
     * Get the value of xifraDescompte
     */ 
    public function getXifraDescompte()
    {
        return $this->xifraDescompte;
    }

    /**
     * Get the value of dataFi
     */ 
    public function getDataFi()
    {
        return $this->dataFi;
    }

    /**
     * Get the value of dataInici
     */ 
    public function getDataInici()
    {
        return $this->dataInici;
    }

    /**
     * Get the value of tipus
     */ 
    public function getTipus()
    {
        return $this->tipus;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
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
     * Set the value of tipus
     *
     * @return  self
     */ 
    public function setTipus($tipus)
    {
        $this->tipus = $tipus;

        return $this;
    }

    /**
     * Set the value of dataInici
     *
     * @return  self
     */ 
    public function setDataInici($dataInici)
    {
        $this->dataInici = $dataInici;

        return $this;
    }

    /**
     * Set the value of dataFi
     *
     * @return  self
     */ 
    public function setDataFi($dataFi)
    {
        $this->dataFi = $dataFi;

        return $this;
    }

    /**
     * Set the value of xifraDescompte
     *
     * @return  self
     */ 
    public function setXifraDescompte($xifraDescompte)
    {
        $this->xifraDescompte = $xifraDescompte;

        return $this;
    }

    /**
     * Set the value of persentatjeDescompte
     *
     * @return  self
     */ 
    public function setPersentatjeDescompte($persentatjeDescompte)
    {
        $this->persentatjeDescompte = $persentatjeDescompte;

        return $this;
    }
}
?>