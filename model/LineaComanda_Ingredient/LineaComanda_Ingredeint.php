<?php
class LineaComanda_Ingredient{
    private int $id_lineaComanda;
    private int $id_Ingredient;
    private float $preuSiEsIngredientExtra;
    private int $quantitat;
    
    // public function __construct(float $preuSiEsIngredientExtra, int $quantitat){
    //     $this-> preuSiEsIngredientExtra = $preuSiEsIngredientExtra;
    //     $this-> quantitat = $quantitat;
    // }

    /**
     * Get the value of id_lineaComanda
     */ 
    public function getId_lineaComanda()
    {
        return $this->id_lineaComanda;
    }

    /**
     * Get the value of id_Ingredient
     */ 
    public function getId_Ingredient()
    {
        return $this->id_Ingredient;
    }

    /**
     * Get the value of preuSiEsIngredientExtra
     */ 
    public function getPreuSiEsIngredientExtra()
    {
        return $this->preuSiEsIngredientExtra;
    }

    /**
     * Get the value of quantitat
     */ 
    public function getQuantitat()
    {
        return $this->quantitat;
    }

    /**
     * Set the value of id_lineaComanda
     *
     * @return  self
     */ 
    public function setId_lineaComanda($id_lineaComanda)
    {
        $this->id_lineaComanda = $id_lineaComanda;

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
     * Set the value of preuSiEsIngredientExtra
     *
     * @return  self
     */ 
    public function setPreuSiEsIngredientExtra($preuSiEsIngredientExtra)
    {
        $this->preuSiEsIngredientExtra = $preuSiEsIngredientExtra;

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
}

?>