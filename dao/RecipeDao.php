<?php

use Framework\Dao;

class RecipeDao extends Dao {

    private $lastAddedId;
    
    public function __construct()
    {
        $this->lastAddedId = self::getPDO()->lastInsertId();
    }

    public function getValidRecipes() : array {
        $VALID_RECIPE_TAG = 1;

        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, :valid, nb_personnes, image_source, id_utilisateur, id_categorie_recette FROM recette WHERE valid = :valid";
        $sth = $this->executeRequest($sql, ['valid' => $VALID_RECIPE_TAG]);

        $recipes = [];

        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = $this->mapRecipe($result);
        }

        return $recipes;
    }

    public function getWaitingRecipes() : array {
        $WAITING_RECIPE_TAG = 0;

        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, :valid, nb_personnes, id_utilisateur, id_categorie_recette FROM recette WHERE valid = :valid";
        $sth = $this->executeRequest($sql, ['valid' => $WAITING_RECIPE_TAG]);

        $recipes = [];

        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = $this->mapRecipe($result);
        }

        return $recipes;
    }

    public function getRecipeById($id) : object {
        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, image_source, id_utilisateur, id_categorie_recette FROM recette WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->mapRecipe($result);
    }

    public function getRecipesByUserId($id) : array {
        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, image_source, id_utilisateur, id_categorie_recette FROM recette WHERE id_utilisateur = :id_utilisateur";
        $sth = $this->executeRequest($sql, ['id_utilisateur' => $id]);
        
        $recipes = [];

        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = $this->mapRecipe($result);
        }


        return $recipes;
    }

    public function insertRecipe($name, $cost, $prepTime, $cookingTime, $releaseDate, $valid, $headcount, $imageSource, $userId, $RecipeCategoryId) {
        $sql = "INSERT INTO recette(nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, image_source, id_utilisateur, id_categorie_recette) VALUES (:nom, :cout, :temps_preparation, :temps_cuisson, :date_publication, :valid, :nb_personnes, :image_source, :id_utilisateur, :id_categorie_recette)";     
        $sth = $this->executeRequest($sql,['nom' => $name, 'cout' => $cost, 'temps_preparation' => $prepTime, 'temps_cuisson' => $cookingTime, 'date_publication' => $releaseDate, 'valid' => $valid, 'nb_personnes' => $headcount, "image_source" => $imageSource, 'id_utilisateur' => $userId, 'id_categorie_recette' => $RecipeCategoryId]);
        
        $this->lastAddedId = self::getPDO()->lastInsertId(); 
    }


    public function getLastRecipeInsertedId() 
    {
        return $this->lastAddedId;
    }


    public function updateRecipeById($id, $name, $cost, $prepTime, $cookingTime, $releaseDate, $valid, $headcount, $imageSource, $recipeCategoryId) {
        $sql = "UPDATE recette SET nom = :nom, cout = :cout, temps_preparation = :temps_preparation, temps_cuisson = :temps_cuisson, date_publication = :date_publication, valid = :valid, nb_personnes = :nb_personnes, image_source = :image_source, id_categorie_recette = :id_categorie_recette WHERE id_recette = :id_recette";
        
        try {
            $sth = $this->executeRequest($sql,['id_recette' => $id, 'nom' => $name, 'cout' => $cost, 'temps_preparation' => $prepTime, 'temps_cuisson' => $cookingTime, 'date_publication' => $releaseDate, 'valid' => $valid, 'nb_personnes' => $headcount, "image_source" => $imageSource, 'id_categorie_recette' => $recipeCategoryId]);
        } 
        catch (Exception $ex) {
            throw new Exception('updateRecipeById failed');
        }
    }

    public function updateRecipeByIdWithoutImage($id, $name, $cost, $prepTime, $cookingTime, $releaseDate, $valid, $headcount, $recipeCategoryId) {
        $sql = "UPDATE recette SET nom = :nom, cout = :cout, temps_preparation = :temps_preparation, temps_cuisson = :temps_cuisson, date_publication = :date_publication, valid = :valid, nb_personnes = :nb_personnes, id_categorie_recette = :id_categorie_recette WHERE id_recette = :id_recette";
        
        try {
            $sth = $this->executeRequest($sql,['id_recette' => $id, 'nom' => $name, 'cout' => $cost, 'temps_preparation' => $prepTime, 'temps_cuisson' => $cookingTime, 'date_publication' => $releaseDate, 'valid' => $valid, 'nb_personnes' => $headcount, 'id_categorie_recette' => $recipeCategoryId]);
        } 
        catch (Exception $ex) {
            throw new Exception('updateRecipeByIdWithoutImage failed');
        }
    }

    public function validRecipeById($id) {
        $sql = "UPDATE recette SET valid = :valid WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id]);
    }

    public function deleteRecipeById($id) {
        $sql = "DELETE FROM recette WHERE id_recette = :id_recette";

        try {
            $this->executeRequest($sql,['id_recette' => $id]);
        }
        catch(Exception $e) {
            throw new Exception('delete recip failed');
        }
    }

    public function mapRecipe($queryResult) {
        $recipe = new Recipe();
        $recipe->setId($queryResult['id_recette']);
        $recipe->setName($queryResult['nom']);
        $recipe->setCost($queryResult['cout']);
        $recipe->setPrepTime($queryResult['temps_preparation']);
        $recipe->setCookingTime($queryResult['temps_cuisson']);
        $recipe->setReleaseDate($queryResult['date_publication']);
        $recipe->setValid($queryResult['valid']);
        $recipe->setHeadcount($queryResult['nb_personnes']);
        $recipe->setImageSource($queryResult['image_source']);
        $recipe->setUserId($queryResult['id_utilisateur']);
        $recipe->setRecipeCategoryId($queryResult['id_categorie_recette']);

        return $recipe;
    }

}