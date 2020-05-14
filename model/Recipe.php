<?php


class Recipe  {
    private $id;
    private $name;
    private $cost;
    private $prepTime;
    private $cookingTime;
    private $releaseDate;
    private $valid;
    private $headcount;
    private $userId;
    private $RecipeCategoryId;

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
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getPrepTime()
    {
        return $this->prepTime;
    }

    /**
     * @param mixed $prepTime
     */
    public function setPrepTime($prepTime)
    {
        $this->prepTime = $prepTime;
    }

    /**
     * @return mixed
     */
    public function getCookingTime()
    {
        return $this->cookingTime;
    }

    /**
     * @param mixed $cookingTime
     */
    public function setCookingTime($cookingTime)
    {
        $this->cookingTime = $cookingTime;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return mixed
     */
    public function getHeadcount()
    {
        return $this->headcount;
    }

    /**
     * @param mixed $headcount
     */
    public function setHeadcount($headcount)
    {
        $this->headcount = $headcount;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getRecipeCategoryId()
    {
        return $this->RecipeCategoryId;
    }

    /**
     * @param mixed $RecipeCategoryId
     */
    public function setRecipeCategoryId($RecipeCategoryId)
    {
        $this->RecipeCategoryId = $RecipeCategoryId;
    }


    
}
