<?php

use Framework\Dao;

class RecipeDao extends Dao {

    public function getRecipe() : array {
        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, id_utilisateur, id_categorie_recette FROM recette";
        $sth = $this->executeRequest($sql);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getRecipeById($id) : array {
        $sql = "SELECT id_recette, nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes, id_utilisateur, id_categorie_recette FROM recette WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function insertRecipe($nom, $cout, $tempsPreparation, $tempsCuisson, $datePublication, $valid, $nbPersonnes) {
        $sql = "INSERT INTO recette(nom, cout, temps_preparation, temps_cuisson, date_publication, valid, nb_personnes VALUES (nom = :nom, cout = :cout, temps_preparation = :temps_preparation, temps_cuisson = :temps_cuisson, date_publication = :date_publication, valid = :valid, nb_personnes = :nb_personnes)";
        $sth = $this->executeRequest($sql,['nom' => $nom, 'cout' => $cout, 'temps_preparation' => $tempsPreparation, 'temps_cuisson' => $tempsCuisson, 'date_publication' => $datePublication, 'valid' => $valid, 'nb_personnes' => $nbPersonnes]);
    }

    public function updateRecipeById($id, $nom, $cout, $tempsPreparation, $tempsCuisson, $datePublication, $nbPersonnes) {
        $sql = "UPDATE recette SET nom = :nom, cout = :cout, temps_preparation = :temps_preparation, temps_cuisson = :temps_cuisson, date_publication = :date_publication, nb_personnes = :nb_personnes WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id, 'nom' => $nom, 'cout' => $cout, 'temps_preparation' => $tempsPreparation, 'temps_cuisson' => $tempsCuisson, 'date_publication' => $datePublication, 'nb_personnes' => $nbPersonnes]);
    }

    public function validRecipeById($id) {
        $sql = "UPDATE recette SET valid = :valid WHERE id_recette = :id_recette";
        $sth = $this->executeRequest($sql,['id_recette' => $id]);
    }






}