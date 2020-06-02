<?php

use Framework\Dao;

class StepDao extends Dao {

    private function getStepIdByRecipeId($recipeId) {
        $sql = "SELECT id_etape FROM etape WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $recipeId]);

        $recipeStepIds = [];
        
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $recipeStepIds[] = $result['id_etape'];
        }

        return $recipeStepIds;
    }

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

    public function getStepByRecipeId($idRecipe) : array {
        $sql = "SELECT id_etape, numero, description, id_recette FROM etape WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $idRecipe]);

        $stepsRecipe = [];

        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $stepsRecipe[] = $this->mapStep($result);
        }

        return $stepsRecipe;
    }

    public function insertStep($number, $description, $recipeId) {
        $sql = "INSERT INTO etape(numero, description, id_recette) VALUES (:numero, :description, :id_recette)";
        $sth = $this->executeRequest($sql,['numero' => $number, 'description' => $description, 'id_recette' => $recipeId]);
    }

    public function insertIfNotExistStepByRecipeId($stepNumber, $description, $recipeId) {

        $sql = "INSERT INTO etape(`numero`, `description`, `id_recette`)
                SELECT :numero, :description, :id_recette
                WHERE 
                NOT EXISTS ( SELECT id_recette FROM etape WHERE numero = :numero )";

        $sth = $this->executeRequest($sql,["id_recette" => intval($recipeId), "numero" => intval($stepNumber), "description" => $description]);
    }

    public function updateStepByRecipeId($recipeId, $number, $description) {

        $sql = "UPDATE etape SET description = :description WHERE id_recette = :id_recette AND numero = :numero";
    
        try {
            $this->executeRequest($sql,['numero' => intval($number), 'description' => $description, 'id_recette' => $recipeId]);            
        }
        catch (Exception $ex) {
            throw new Exception('updateStepByRecipeId failed');
        }
    }

    public function deleteStepByStepId($id) {
        $sql = "DELETE FROM etape WHERE id_etape = :id_etape";

        try {
            $this->executeRequest($sql, ['id_etape' => $id]);
        }
        catch(Exception $e) {
            throw new Exception('delete steps failed');
        }
    }

    public function deleteStepByRecipeId($id) {
        $sql = "DELETE FROM etape WHERE id_recette = :id_recette";

        try {
            $this->executeRequest($sql, ['id_recette' => $id]);
        }
        catch(Exception $e) {
            throw new Exception('delete steps failed');
        }
    }


    private function mapStep($queryResult) {
        $step = new Step();
        $step->setId($queryResult['id_etape']);
        $step->setNumber($queryResult['numero']);
        $step->setDescription($queryResult['description']);
        $step->setRecipeId($queryResult['id_recette']);

        return $step;
    }

}