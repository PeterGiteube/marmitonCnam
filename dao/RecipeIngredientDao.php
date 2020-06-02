<?php

use Framework\Dao;

class RecipeIngredientDao extends Dao
{

    public function insertIngredientByRecipeId($recipeId, $ingredientId, $quantity, $unitId) {

        $sql = "INSERT INTO recette_ingredient(`id_recette`, `id_ingredient`, `quantite`, `id_unite`) VALUES (:id_recette, :id_ingredient, :quantite, :id_unite)";
        
        $sth = $this->executeRequest($sql,["id_recette" => $recipeId, "id_ingredient" => $ingredientId, "quantite" => $quantity, "id_unite" => $unitId]);

    }

    public function insertIfNotExistIngredientByRecipeId($recipeId, $ingredientId, $quantity, $unitId) {

        $sql = "INSERT INTO recette_ingredient(`id_recette`, `id_ingredient`, `quantite`, `id_unite`)
                SELECT :id_recette, :id_ingredient, :quantite, :id_unite
                WHERE 
                NOT EXISTS ( SELECT id_recette FROM recette_ingredient WHERE id_ingredient = :id_ingredient )";

        $sth = $this->executeRequest($sql,["id_recette" => $recipeId, "id_ingredient" => $ingredientId, "quantite" => $quantity, "id_unite" => $unitId]);
    }
   
    public function getIngredientByIdRecipe($recipeId) {
        $sql = "SELECT id_recette_ingredient, id_recette, recette_ingredient.id_ingredient, quantite, unité.label,ingredient.nom
                FROM recette_ingredient 
                INNER JOIN unité on recette_ingredient.id_unite = unité.id_unite
                INNER JOIN ingredient on recette_ingredient.id_ingredient = ingredient.id_ingredient
                WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql, ["id_recette" => $recipeId]);

        $ingredientsRecipe = [];
        
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $ingredientsRecipe[] = $this->mapIngredientRecipe($result);
        }

        return $ingredientsRecipe;
    }

    public function getIngredientByIdRecipeAndIdUser($recipeId, $userId) {
        $sql = "SELECT id_recette_ingredient, id_recette, recette_ingredient.id_ingredient, quantite, unité.label,ingredient.nom
                FROM recette_ingredient 
                INNER JOIN unité on recette_ingredient.id_unite = unité.id_unite
                INNER JOIN ingredient on recette_ingredient.id_ingredient = ingredient.id_ingredient
                WHERE id_recette = :id_recette AND id_utilisateur = :id_utilisateur";
        $sth = $this->executeRequest($sql, ["id_recette" => $recipeId, "id_utilisateur" => $userId]);

        $ingredientsRecipe = [];
        
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $ingredientsRecipe[] = $this->mapIngredientRecipe($result);
        }

        return $ingredientsRecipe;
    }

    public function updateIngredientByRecipeIngredientId($ingredientId, $quantity, $unitId, $recipeId) {
        try {
            $sql = "UPDATE recette_ingredient SET id_ingredient = :id_ingredient, quantite = :quantite, id_unite = :id_unite WHERE id_ingredient = :id_ingredient AND id_recette = id_recette";
            $this->executeRequest($sql, ['id_ingredient' => $ingredientId, 'quantite' => $quantity, 'id_unite' => $unitId, "id_recette" => $recipeId]);
        } 
        catch (Exception $ex) {
            throw new Exception('updateIngredientByRecipeIngredientId failed');
        }
    }

    public function deleteRecipeIngredientByRecipeId($recipeId)
    {
        $sql = "DELETE FROM recette_ingredient WHERE id_recette = :id_recette";
        try {
            $this->executeRequest($sql,["id_recette" => $recipeId]);
        }
        catch(Exception $e) {
            throw new Exception('deleteIngredientFromRecetteId failed');
        }
    }

    public function deleteRecipeIngredientById($recipeIngredientId)
    {
        $sql = "DELETE FROM recette_ingredient WHERE id_recette_ingredient = :id_recette_ingredient";
        try {
            $this->executeRequest($sql, ["id_recette_ingredient" => $recipeIngredientId]);
        }
        catch(Exception $e) {
            throw new Exception('deleteIngredientFromRecipeIngredientId failed');
        }
    }

    public function mapIngredientRecipe($queryResult) {
        $ingredientRecipe = new RecipeIngredient();
        $ingredientRecipe->setIdRecipeIngredient($queryResult["id_recette_ingredient"]);
        $ingredientRecipe->setIdRecipe($queryResult["id_recette"]);
        $ingredientRecipe->setIdIngredient($queryResult["id_ingredient"]);
        $ingredientRecipe->setQuantity($queryResult["quantite"]);
        

        $ingredient = new Ingredient();
        $ingredient->setName($queryResult['nom']);
        $ingredientRecipe->setIngredient($ingredient);

        $unit = new Unit();
        //$unit->setId($queryResult['id_unite']);
        $unit->setLabel($queryResult['label']);

        $ingredientRecipe->setUnit($unit);

        return $ingredientRecipe;
    }
}
