<?php

use Framework\Dao;

class IngredientDao extends Dao {

    public function getIngredients() : array {
        $sql = "SELECT id_ingredient, nom, id_categorie_ingredient FROM ingredient";
        $sth = $this->executeRequest($sql);

        $ingredients = [];
        
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $ingredients[] = $this->mapIngredient($result);
        }

        return $ingredients;
    }

    public function getIngredientById($id) : array {
        $sql = "SELECT id_ingredient, nom, id_categorie_ingredient FROM ingredient WHERE id_ingredient = :id_ingredient";
        $sth = $this->executeRequest($sql,['id_ingredient' => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getIngredientIdByName($name) : string {
        $sql = "SELECT id_ingredient FROM ingredient WHERE nom = :nom";
        $sth = $this->executeRequest($sql,['nom' => $name]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result['id_ingredient'];
    }



    public function insertIngredient($name, $idIngredientCategory) {
        $sql = "INSERT INTO ingredient(nom, id_categorie_ingredient) VALUES (nom = :nom, id_categorie_ingredient = :id_categorie_ingredient)";
        $sth = $this->executeRequest($sql,['nom' => $name, 'id_categorie_ingredient' => $idIngredientCategory]);
    }

    

    public function updateIngredientById($id, $name, $idIngredientCategory) {
        $sql = "UPDATE ingredient SET nom = :nom, id_categorie_ingredient = :id_categorie_ingredient WHERE id_ingredient = :id_ingredient";
        $sth = $this->executeRequest($sql,['id_ingredient' => $id, 'nom' => $name, 'id_categorie_ingredient' => $idIngredientCategory]);
    }

    public function deleteIngredientById($id) {
        $sql = "DELETE FROM ingredient WHERE id_ingredient = :id_ingredient";
        $sth = $this->executeRequest($sql,['id_ingredient' => $id]);
    }

    private function mapIngredient($queryResult) {
        $ingredient = new Ingredient();
        $ingredient->setId($queryResult['id_utilisateur']);
        $ingredient->setName($queryResult['nom']);
        $ingredient->setIdIngredientCategory($queryResult['id_categorie_ingredient']);

        return $ingredient;
    }



    

}