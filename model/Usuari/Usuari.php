<?php
class Usuari{
    private int $id;
    private string $nomUsuari;
    private string $contrasenya;
    private string $nom;
    private string $cognoms;
    private string $correu;
    private string $telefon;
    private string $rol;
    
    // public function __construct(int $id, string $nomUsuari, string $contrasenya, string $nom, string $cognoms, string $correu, string $telefon, string $rol){
    //     $this->id = $id;
    //     $this->nomUsuari = $nomUsuari;
    //     $this->contrasenya = $contrasenya;
    //     $this->nom = $nom;
    //     $this->cognoms = $cognoms;
    //     $this->correu = $correu;
    //     $this->telefon = $telefon;
    //     $this->rol = $rol;
    // }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nomUsuari
     */ 
    public function getNomUsuari()
    {
        return $this->nomUsuari;
    }

    /**
     * Get the value of contrasenya
     */ 
    public function getContrasenya()
    {
        return $this->contrasenya;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Get the value of cognoms
     */ 
    public function getCognoms()
    {
        return $this->cognoms;
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
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
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
     * Set the value of nomUsuari
     *
     * @return  self
     */ 
    public function setNomUsuari($nomUsuari)
    {
        $this->nomUsuari = $nomUsuari;

        return $this;
    }

    /**
     * Set the value of contrasenya
     *
     * @return  self
     */ 
    public function setContrasenya($contrasenya)
    {
        $this->contrasenya = $contrasenya;

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
     * Set the value of cognoms
     *
     * @return  self
     */ 
    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;

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

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
    public function toArray() {
        return [
            'id' => $this->id,
            'nomUsuari' => $this->nomUsuari,
            'contrasenya' => $this->contrasenya,
            'nom' => $this->nom,
            'cognoms' => $this->cognoms,
            'correu' => $this->correu,
            'telefon' => $this->telefon,
            'rol' => $this->rol
        ];
    }
}
?>