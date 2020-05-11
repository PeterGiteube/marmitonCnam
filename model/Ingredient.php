<?php


class Ingredient
{
    private $id;
    private $name;
    private $idIngredientCategory;

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

    /**
     * @return mixed
     */
    public function getIdIngredientCategory()
    {
        return $this->idIngredientCategory;
    }

    /**
     * @param mixed $idIngredientCategory
     */
    public function setIdIngredientCategory($idIngredientCategory)
    {
        $this->idIngredientCategory = $idIngredientCategory;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}