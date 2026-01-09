<?php
class Categoria{
    private int $id;
    private string $nom;
    // Ruta relativa (p. ex. IMG/categories/entrants.webp)
    private ?string $imatge = null;
    
    // public function __construct(string $nom){
    //     $this-> nom = $nom;
    // }

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
     * Get the value of imatge
     */
    public function getImatge()
    {
        return $this->imatge;
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
     * Set the value of imatge
     *
     * @return self
     */
    public function setImatge($imatge)
    {
        $this->imatge = $imatge;

        return $this;
    }
}