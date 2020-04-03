<?php

use Framework\Dao;

class UserDao extends Dao {

    public function getUserByCredentials($userName, $password) {
        $sql = "SELECT id_utilisateur, pseudo, nom, prenom, mail, telephone, ville FROM utilisateur WHERE pseudo = :pseudo AND mot_de_passe = :mot_de_passe";
        $sth = $this->executeRequest($sql, array("pseudo" => $userName, "mot_de_passe" => $password));

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->createUser($result);
    }

    public function getUserById($id) {
        $sql = "SELECT id_utilisateur, pseudo, nom, prenom, mail, telephone, ville FROM utilisateur WHERE id_utilisateur = :id";
        $sth = $this->executeRequest($sql, array("id" => $id));

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->createUser($result);
    }

    private function createUser($queryResult) {
        $user = new User();
        $user->setId($queryResult['id_utilisateur']);
        $user->setFirstName($queryResult['nom']);
        $user->setPseudo($queryResult['pseudo']);
        $user->setLastName($queryResult['prenom']);
        $user->setEmail($queryResult['mail']);
        $user->setPhoneNumber($queryResult['telephone']);
        $user->setCity($queryResult['ville']);

        return $user;
    }
}
