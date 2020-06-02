<?php 


class RecipeIngredient {
    private $idRecipeIngredient;
    private $idRecipe;
    private $idIngredient;
    private $quantity;
    private $unit;
    private $ingredient;

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

    public function setUnit($unit) 
    {
        $this->unit = $unit;
    }

    public function getUnit() 
    {
        return $this->unit;
    }

    /*
    * @return mixed
    */
   public function getIngredient()
   {
       return $this->ingredient;
   }

   /**
    * @param mixed $idRecipeIngredient
    */
   public function setIngredient($ingredient)
   {
       $this->ingredient = $ingredient;
   }
}