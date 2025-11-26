<?php
class LineaComanda_Ingredient{
    private int $id_lineaComanda;
    private int $id_Ingredient;
    private float $preuSiEsIngredientExtra;
    private int $quantitat;
    
    public function __construct(float $preuSiEsIngredientExtra, int $quantitat){
        $this-> preuSiEsIngredientExtra = $preuSiEsIngredientExtra;
        $this-> quantitat = $quantitat;
    }
}

?>