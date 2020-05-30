<?php 

class RecipeCategory  {
    private $idCategory;
    private $name;
    private $idCategoryRecipeParents;

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
 * @param mixed $idCategory
 */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
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
    public function getIdCategoryRecipeParents()
    {
        return $this->idCategoryRecipeParents;
    }

    /**
     * @param mixed $idCategoryRecipeParents
     */
    public function setIdCategoryRecipeParents($idCategoryRecipeParents)
    {
        $this->idCategoryRecipeParents = $idCategoryRecipeParents;
    }
}