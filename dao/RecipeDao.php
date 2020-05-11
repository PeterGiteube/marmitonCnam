<?php

use Framework\Dao;

class RecipeDao extends Dao {

    public function getRecipes() : array {
        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, id_utilisateur, id_categorie_recette FROM recette";
        $sth = $this->executeRequest($sql);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getValidRecipes($valid) : array {
        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, id_utilisateur, id_categorie_recette FROM recette WHERE valid = :valid";
        $sth = $this->executeRequest($sql,["valid" => $valid]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getRecipeById($id) : array {
        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, id_utilisateur, id_categorie_recette FROM recette WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function insertRecipe($name, $cost, $prepTime, $cookingTime, $releaseDate, $valid, $headcount, $userId, $RecipeCategoryId) {
        $sql = "INSERT INTO recette(nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, id_utilisateur, id_categorie_recette) VALUES (nom = :nom, cout = :cout, temps_preparation = :temps_preparation, temps_cuisson = :temps_cuisson, date_publication = :date_publication, valid = :valid, nb_personnes = :nb_personnes, id_utilisateur = :id_utilisateur, id_categorie_recette = :id_categorie_recette)";
        $sth = $this->executeRequest($sql,['nom' => $name, 'cout' => $cost, 'temps_preparation' => $prepTime, 'temps_cuisson' => $cookingTime, 'date_publication' => $releaseDate, 'valid' => $valid, 'nb_personnes' => $headcount, "id_utilisateur" => $userId, "id_categorie_recette" => $RecipeCategoryId]);
    }

    public function updateRecipeById($id, $name, $cost, $prepTime, $cookingTime, $releaseDate, $headcount, $userId, $RecipeCategoryId) {
        $sql = "UPDATE recette SET nom = :nom, cout = :cout, temps_preparation = :temps_preparation, temps_cuisson = :temps_cuisson, date_publication = :date_publication, nb_personnes = :nb_personnes WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id, 'nom' => $name, 'cout' => $cost, 'temps_preparation' => $prepTime, 'temps_cuisson' => $cookingTime, 'date_publication' => $releaseDate, 'nb_personnes' => $headcount, "id_utilisateur" => $userId, "id_categorie_recette" => $RecipeCategoryId]);
    }

    public function validRecipeById($id) {
        $sql = "UPDATE recette SET valid = :valid WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id]);
    }

    public function deleteRecipeById($id) {
        $sql = "DELETE FROM recette WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id]);
    }

    private function mapRecipe($queryResult) {
        $recipe = new Recipe();
        $recipe->setId($queryResult['id_utilisateur']);
        $recipe->setName($queryResult['nom']);
        $recipe->setCost($queryResult['cout']);
        $recipe->setPrepTime($queryResult['temps_preparation']);
        $recipe->setCookingTime($queryResult['temps_cuisson']);
        $recipe->setReleaseDate($queryResult['date_publication']);
        $recipe->setValid($queryResult['valid']);
        $recipe->setHeadcount($queryResult['nb_personnes']);
        $recipe->setUserId($queryResult['id_utilisateur']);
        $recipe->setRecipeCategoryId($queryResult['id_categorie_recette']);

        return $recipe;
    }

}