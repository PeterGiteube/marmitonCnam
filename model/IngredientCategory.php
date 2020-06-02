<?php

class IngredientCategory {
    private $idCategoryIngredient;
    private $name;

    /**
     * @return mixed
     */
    public function getIdCategoryIngredient()
    {
        return $this->idCategoryIngredient;
    }

    /**
    * @param mixed $idCategoryIngredient
    */
    public function setIdCategoryIngredient($idCategoryIngredient)
    {
        $this->idCategoryIngredient = $idCategoryIngredient;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}