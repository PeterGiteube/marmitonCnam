<?php

use Framework\Dao;

class RecipeIngredientDao extends Dao
{

    // Récupérer toutes les lignes des ingrédients associé à une recette dans recette_ingredient
    private function getRecipeIngredientIdByRecipeId($recipeId) {

        $sql = "SELECT id_recette_ingredient FROM recette_ingredient WHERE id_recette = :id_recette";

        $sth = $this->executeRequest($sql,['id_recette' => $recipeId]);

        $recipeIngredientIds = [];
        
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $recipeIngredientIds[] = $result['id_recette_ingredient'];
        }

        return $recipeIngredientIds;
    }
    
    public function insertIngredientByRecipeId($recipeId, $ingredientId, $quantity, $unitId) {

        $sql = "INSERT INTO recette_ingredient(`id_recette`, `id_ingredient`, `quantite`, `id_unite`) VALUES (:id_recette, :id_ingredient, :quantite, :id_unite)";
        
        $sth = $this->executeRequest($sql,["id_recette" => $recipeId, "id_ingredient" => $ingredientId, "quantite" => $quantity, "id_unite" => $unitId]);

    }
   
    public function getIngredientByIdRecipe($recipeId) {
        $sql = "SELECT id_recette_ingredient, id_recette, recette_ingredient.id_ingredient, quantite, unité.label, ingredient.nom
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

    public function updateIngredientByRecipeIngredientId($ingredientId, $quantity, $unitId, $recipeId) {
        $recipeIngredientIds = $this->getRecipeIngredientIdByRecipeId($recipeId);
        
        foreach($recipeIngredientIds as $recipeIngredientId) {
            try {
                $sql = "UPDATE recette_ingredient SET id_ingredient = :id_ingredient, quantite = :quantite, id_unite = :id_unite WHERE id_recette_ingredient = :id_recette_ingredient";
                $this->executeRequest($sql, ['id_ingredient' => $ingredientId, 'quantite' => $quantity, 'id_unite' => $unitId, 'id_recette_ingredient' => intval($recipeIngredientId)]);
            }
            catch (Exception $ex) {
                throw new Exception('updateIngredientByRecipeIngredientId failed');
            }
        }
    }

    public function deleteIngredientFromRecetteId($recipeId)
    {
        $sql = "DELETE FROM recette_ingredient WHERE id_recette = :id_recette";
        try {
            $this->executeRequest($sql,["id_recette" => $recipeId]);
        }
        catch(Exception $e) {
            throw new Exception('deleteIngredientFromRecetteId failed');
        }
    }

    public function mapIngredientRecipe($queryResult) {
        $ingredientRecipe = new RecipeIngredient();
        $ingredientRecipe->setIdRecipeIngredient($queryResult["id_recette_ingredient"]);
        $ingredientRecipe->setIdRecipe($queryResult["id_recette"]);
        $ingredientRecipe->setIdIngredient($queryResult["id_ingredient"]);
        $ingredientRecipe->setQuantity($queryResult["quantite"]);
        $ingredientRecipe->setUnitLabel($queryResult['label']);
        $ingredientRecipe->setIngredientName($queryResult['nom']);

        return $ingredientRecipe;
    }
}
