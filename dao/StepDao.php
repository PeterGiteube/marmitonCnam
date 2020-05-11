<?php

use Framework\Dao;

class StepDao extends Dao {

    public function getSteps() : array {
        $sql = "SELECT id_etape, numero, description, id_recette FROM etape";
        $sth = $this->executeRequest($sql);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getStepById($id) : array {
        $sql = "SELECT id_etape, numero, description, id_recette FROM etape WHERE id_etape = :id_etape";
        $sth = $this->executeRequest($sql,['id_etape' => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function insertStep($number, $description, $recipeId) {
        $sql = "INSERT INTO etape(numero, description, id_recette) VALUES (numero = :numero, description = :description, id_recette = :id_recette)";
        $sth = $this->executeRequest($sql,['numero' => $number, 'description' => $description, 'id_recette' => $recipeId]);
    }

    public function updateStepById($id, $number, $description, $recipeId) {
        $sql = "UPDATE etape SET numero = :numero, description = :description, id_recette = :id_recette WHERE id_etape = :id_etape";
        $sth = $this->executeRequest($sql,['id_recette' => $id, 'numero' => $number, 'description' => $description, 'id_recette' => $recipeId]);
    }

    public function deleteStepById($id) {
        $sql = "DELETE FROM etape WHERE id_etape = :id_etape";
        $sth = $this->executeRequest($sql,['id_etape' => $id]);
    }

    private function mapStep($queryResult) {
        $step = new Step();
        $step->setId($queryResult['id_utilisateur']);
        $step->setNumber($queryResult['numero']);
        $step->setDecription($queryResult['description']);
        $step->setRecipeId($queryResult['id_recette']);

        return $step;
    }

}