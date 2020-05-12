<?php

use Framework\Dao;

class UserDao extends Dao {

    // j'ai changé le type qu'on return pour manageUserView
    public function getUsers() : array {
        $sql = "SELECT id_utilisateur, pseudo, nom, prenom, mail, telephone, ville, role FROM utilisateur";
        $sth = $this->executeRequest($sql);

        $users = array();
        $i = 0;
        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $users[$i] = $this->mapUser($result);
            $i++;
        }

        return $users;
    }

    public function getUserByCredentials($userName, $password) : User {
        $sql = "SELECT id_utilisateur, pseudo, nom, prenom, mail, telephone, ville, role FROM utilisateur WHERE pseudo = :pseudo AND mot_de_passe = :mot_de_passe";
        $sth = $this->executeRequest($sql, ["pseudo" => $userName, "mot_de_passe" => $password]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->mapUser($result);
    }

    public function getUserById($id) : User {
        $sql = "SELECT id_utilisateur, pseudo, nom, prenom, mail, telephone, ville FROM utilisateur WHERE id_utilisateur = :id";
        $sth = $this->executeRequest($sql, ["id" => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->mapUser($result);
    }

    public function insertUser($pseudo, $password, $lastName, $firstName, $mail, $city) {
        $sql = "INSERT INTO utilisateur (pseudo, mot_de_passe, nom, prenom, mail, ville) VALUES (pseudo = :pseudo, mot_de_passe = :mot_de_passe, nom = :nom, prenom = :prenom, mail = :mail, ville = :ville";
        $sth = $this->executeRequest($sql, ["pseudo" => $pseudo, "mot_de_passe" => $password, "nom" => $lastName, "prenom" => $firstName, "mail" => $mail, "ville" => $city]);
    }

    public function updateUserInfosById($id, $pseudo, $firstName, $lastName, $city) {
        $sql = "UPDATE utilisateur SET pseudo = :pseudo, prenom = :prenom, nom = :nom, ville = :ville WHERE id_utilisateur = :id";

        $this->executeRequest($sql, ["id" => $id, "pseudo" => $pseudo, "prenom" => $firstName, "nom" => $lastName, "ville" => $city]);
    }

    public function updateUserCredentialsById($id, $mail, $password) {
        $sql = "UPDATE utilisateur SET mail = :mail, mot_de_passe = :mot_de_passe WHERE id_utilisateur = :id";
        $this->executeRequest($sql, ["id" => $id, "mail" => $mail, "mot_de_passe" => $password]);
    }

    public function updateUserRoleById($id, $role) {
        $sql = "UPDATE utilisateur_role SET role = :role WHERE id_utilisateur = :id";
        $this->executeRequest($sql, ["id" => $id, "role" => $role]);
    }

    public function deleteUserById($id)
    {
        $sql = "DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur";
        return $this->executeRequest($sql, ["id_utilisateur" => $id]);
    }

    private function mapUser($queryResult) {
        $user = new User();
        $user->setId($queryResult['id_utilisateur']);
        $user->setFirstName($queryResult['prenom']);
        $user->setPseudo($queryResult['pseudo']);
        $user->setLastName($queryResult['nom']);
        $user->setEmail($queryResult['mail']);
        $user->setPhoneNumber($queryResult['telephone']);
        $user->setCity($queryResult['ville']);
        $user->setRole($queryResult['role']);

        return $user;
    }
}
