<?php
class Productes_ingredients{
    private int $idProducte;
    private int $id_Ingredient;
    private int $quantitat;
    private float $preuSiEsIngredientExtra;
    private float $preuPerDefecte;
    
    public function __construct(int $quantitat, float $preuSiEsIngredientExtra, float $preuPerDefecte){
        $this-> quantitat = $quantitat;
        $this-> preuSiEsIngredientExtra = $preuSiEsIngredientExtra;
        $this-> preuPerDefecte = $preuPerDefecte;
    }

    /**
     * Get the value of idProducte
     */ 
    public function getIdProducte()
    {
        return $this->idProducte;
    }

    /**
     * Get the value of id_Ingredient
     */ 
    public function getId_Ingredient()
    {
        return $this->id_Ingredient;
    }

    /**
     * Get the value of quantitat
     */ 
    public function getQuantitat()
    {
        return $this->quantitat;
    }

    /**
     * Get the value of preuSiEsIngredientExtra
     */ 
    public function getPreuSiEsIngredientExtra()
    {
        return $this->preuSiEsIngredientExtra;
    }

    /**
     * Get the value of preuPerDefecte
     */ 
    public function getPreuPerDefecte()
    {
        return $this->preuPerDefecte;
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

    /**
     * Set the value of quantitat
     *
     * @return  self
     */ 
    public function setQuantitat($quantitat)
    {
        $this->quantitat = $quantitat;

        return $this;
    }

    /**
     * Set the value of id_Ingredient
     *
     * @return  self
     */ 
    public function setId_Ingredient($id_Ingredient)
    {
        $this->id_Ingredient = $id_Ingredient;

        return $this;
    }

    /**
     * Set the value of preuPerDefecte
     *
     * @return  self
     */ 
    public function setPreuPerDefecte($preuPerDefecte)
    {
        $this->preuPerDefecte = $preuPerDefecte;

        return $this;
    }

    /**
     * Set the value of preuSiEsIngredientExtra
     *
     * @return  self
     */ 
    public function setPreuSiEsIngredientExtra($preuSiEsIngredientExtra)
    {
        $this->preuSiEsIngredientExtra = $preuSiEsIngredientExtra;

        return $this;
    }
}