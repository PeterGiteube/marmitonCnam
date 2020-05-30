<?php

use Framework\Dao;

class RecipeCategoryDao extends Dao {
    
    public function getRecipeCategories() : array {
        $sql = "SELECT id_categorie_recette, nom, id_categorie_recette_parent FROM categorie_recette";
        $sth = $this->executeRequest($sql);

        $recipeCategories = [];
        
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $recipeCategories[] = $this->mapRecipeCategory($result);
        }
        return $recipeCategories;
    }

    public function getRecipeCategoryById($id) : RecipeCategory {
        $sql = "SELECT id_categorie_recette, nom, id_categorie_recette_parent FROM categorie_recette WHERE id_categorie_recette = :id";
        $sth = $this->executeRequest($sql, ["id" => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->mapRecipeCategory($result);
    }

    public function getRecipeCategoryByName($name) : RecipeCategory {
        $sql = "SELECT id_categorie_recette, nom, id_categorie_recette_parent FROM categorie_recette WHERE nom = :nom";
        $sth = $this->executeRequest($sql, ["nom" => $name]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->mapRecipeCategory($result);
    }

    public function insertRecipeCategory($name, $recipeCategoryParentId) {
        $sql = "INSERT INTO categorie_recette(nom, id_categorie_recette_parent) VALUES (nom = :nom, id_categorie_recette_parent = :id_categorie_recette_parent)";
        $sth = $this->executeRequest($sql,['nom' => $name, 'id_categorie_recette_parent' => $recipeCategoryParentId]);
    }

    public function updateRecipeCategoryById($id, $name, $recipeCategoryParentId) {
        $sql = "UPDATE ingredient SET nom = :nom, id_categorie_recette_parent = :id_categorie_recette_parent WHERE id_categorie_recette = :id_categorie_recette";
        $sth = $this->executeRequest($sql,['id_categorie_recette' => $id, 'nom' => $name, 'id_categorie_recette_parent' => $recipeCategoryParentId]);
    }

    public function deleteRecipeCategoryById($id) {
        $sql = "DELETE FROM categorie_recette WHERE id_categorie_recette = :id_categorie_recette";
        $sth = $this->executeRequest($sql,['id_categorie_recette' => $id]);
    }

    

    public function mapRecipeCategory($queryResult) {
        $recipeCategory = new RecipeCategory();
        $recipeCategory->setIdCategory($queryResult['id_categorie_recette']);
        $recipeCategory->setName($queryResult['nom']);
        $recipeCategory->setIdCategoryRecipeParents($queryResult['id_categorie_recette_parent']);

        return $recipeCategory;
    }
}