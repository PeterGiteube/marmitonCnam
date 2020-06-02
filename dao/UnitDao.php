<?php

use Framework\Dao;

class UnitDao extends Dao {
    
    public function getUnits() : array {
        $sql = "SELECT id_unite, label FROM unité";
        $sth = $this->executeRequest($sql);

        $recipeCategories = [];
        
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $recipeCategories[] = $this->mapUnit($result);
        }
        return $recipeCategories;
    }

    public function getUnitByLabel($label) : string {
        $sql = "SELECT id_unite FROM unité WHERE label = :label";
        $sth = $this->executeRequest($sql,["label" => $label]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result['id_unite'];
    }

    public function mapUnit($queryResult) {
        $unit = new Unit();
        $unit->setId($queryResult['id_unite']);
        $unit->setLabel($queryResult['label']);

        return $unit;
    }
}