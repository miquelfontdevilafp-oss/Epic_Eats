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
    
    public function __construct(int $id, string $nomUsuari, string $contrasenya, string $nom, string $cognoms, string $correu, string $telefon, string $rol){
        $this->id = $id;
        $this->nomUsuari = $nomUsuari;
        $this->contrasenya = $contrasenya;
        $this->nom = $nom;
        $this->cognoms = $cognoms;
        $this->correu = $correu;
        $this->telefon = $telefon;
        $this->rol = $rol;
    }

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
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
}
?>