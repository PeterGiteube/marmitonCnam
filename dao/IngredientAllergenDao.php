<?php

use Framework\Dao;

class IngredientAllergenDao extends Dao {

    public function deleteIngredientAllergenByIngredientId($id) {
        $sql = "DELETE FROM ingredient_allergene WHERE id_ingredient = :id_ingredient";
        $sth = $this->executeRequest($sql,['id_ingredient' => $id]);
    }
}