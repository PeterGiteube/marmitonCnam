<?php

use Framework\Dao;

class AllergenDao extends Dao {

    public function getAllergens() : array {
        $sql = "SELECT id_allergene, nom FROM allergene";
        $sth = $this->executeRequest($sql);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllergenById($id) : array {
        $sql = "SELECT id_allergene, nom FROM allergene WHERE id_allergene = :id_allergene";
        $sth = $this->executeRequest($sql,['id_allergene' => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function insertAllergen($name) {
        $sql = "INSERT INTO allergene(nom) VALUES (nom = :nom)";
        $sth = $this->executeRequest($sql,['nom' => $name]);
    }

    public function updateAllergenById($id, $name) {
        $sql = "UPDATE allergene SET nom = :nom WHERE id_allergene = :id_allergene";
        $sth = $this->executeRequest($sql,['id_allergene' => $id, 'nom' => $name]);
    }

      public function deleteAllergenById($id) {
        $sql = "DELETE FROM allergene WHERE id_allergene = :id_allergene";
        $sth = $this->executeRequest($sql,['id_allergene' => $id]);
    }

    private function mapAllergen($queryResult) {
        $allergen = new Allergen();
        $allergen->setId($queryResult['id_allergene']);
        $allergen->setName($queryResult['nom']);

        return $allergen;
    }

}