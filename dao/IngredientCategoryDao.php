<?php

use Framework\Dao;

class IngredientCategoryDao extends Dao {
    public function getIngredientCategories() : array {
        $sql = "SELECT id_categorie_ingredient, nom FROM categorie_ingredient";
        $sth = $this->executeRequest($sql);

        $ingredientCategories = [];
        
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $ingredientCategories[] = $this->mapIngredientCategory($result);
        }
        return $ingredientCategories;
    }

    public function getIdIngredientCategoryByName($name) : string {
        $sql = "SELECT id_categorie_ingredient FROM categorie_ingredient WHERE nom = :nom";
        $sth = $this->executeRequest($sql, ["nom" => $name]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result['id_categorie_ingredient'];
    }

    public function getIdIngredientCategoryById($id) : object {
        $sql = "SELECT id_categorie_ingredient, nom FROM categorie_ingredient WHERE id_categorie_ingredient = :id_categorie_ingredient";
        $sth = $this->executeRequest($sql, ["id_categorie_ingredient" => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->mapIngredientCategory($result);
    }

    private function mapIngredientCategory($queryResult) {
        $ingredientCategory = new IngredientCategory();
        $ingredientCategory->setIdCategoryIngredient($queryResult['id_categorie_ingredient']);
        $ingredientCategory->setName($queryResult['nom']);

        return $ingredientCategory;
    }
}