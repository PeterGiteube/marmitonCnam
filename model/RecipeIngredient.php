<?php 

class RecipeIngredient {
    private $unitLabel;

    private $idRecipeIngredient;
    private $idRecipe;
    private $idIngredient;
    private $ingredientName;
    private $quantity;

/**
     * @return mixed
     */
    public function getIdRecipeIngredient()
    {
        return $this->idRecipeIngredient;
    }

    /**
 * @param mixed $idRecipeIngredient
 */
    public function setIdRecipeIngredient($idRecipeIngredient)
    {
        $this->idRecipeIngredient = $idRecipeIngredient;
    }

    /**
     * @return mixed
     */
    public function getIdRecipe()
    {
        return $this->idRecipe;
    }

    /**
     * @param mixed $idRecipe
     */
    public function setIdRecipe($idRecipe)
    {
        $this->idRecipe = $idRecipe;
    }

    /**
     * @return mixed
     */
    public function getIdIngredient()
    {
        return $this->idIngredient;
    }

    /**
     * @param mixed $idIngredient
     */
    public function setIdIngredient($idIngredient)
    {
        $this->idIngredient = $idIngredient;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getUnitLabel() {
        return $this->unitLabel;
    }

    /**
     * @param mixed $unitLabel
     */
    public function setUnitLabel($unitLabel) {
        $this->unitLabel = $unitLabel;
    }

    /**
    * @return mixed
    */
   public function getIngredientName()
   {
       return $this->ingredientName;
   }

   /**
    * @param mixed $idRecipeIngredient
    */
   public function setIngredientName($ingredientName)
   {
       $this->ingredientName = $ingredientName;
   }
}