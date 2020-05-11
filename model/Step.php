<?php


class Step
{
    private $id;
    private $number;
    private $decription;
    private $recipeId;

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

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getDecription()
    {
        return $this->decription;
    }

    /**
     * @param mixed $decription
     */
    public function setDecription($decription)
    {
        $this->decription = $decription;
    }

    /**
     * @return mixed
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }

    /**
     * @param mixed $recipeId
     */
    public function setRecipeId($recipeId)
    {
        $this->recipeId = $recipeId;
    }


}