<?php

use Framework\Dao;

class UserDao extends Dao {

    private $lastAddedId;

    public function __construct() 
    {
        $this->lastAddedId = self::getPDO()->lastInsertId();
    }

    public function getLastId() 
    {
        return $this->lastAddedId;
    }

    // j'ai changé le type qu'on return pour manageUserView
    public function getUsers() : array {
        $sql = "SELECT id_utilisateur, pseudo, mot_de_passe, nom, prenom, mail, telephone, ville, role FROM utilisateur";
        $sth = $this->executeRequest($sql);

        $users = [];

        while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $this->mapUser($result);
        }

        return $users;
    }

    public function getUserByCredentials($userName, $password) {
        $sql = "SELECT id_utilisateur, pseudo, mot_de_passe, nom, prenom, mail, telephone, ville, role FROM utilisateur WHERE pseudo = :pseudo AND mot_de_passe = :mot_de_passe";
        $sth = $this->executeRequest($sql, ["pseudo" => $userName, "mot_de_passe" => $password]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if(!$result) {
            return null;
        }

        return $this->mapUser($result);
    }

    public function getUserById($id) : User {
        $sql = "SELECT id_utilisateur, pseudo, mot_de_passe, nom, prenom, mail, telephone, ville, role FROM utilisateur WHERE id_utilisateur = :id";
        $sth = $this->executeRequest($sql, ["id" => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $this->mapUser($result);
    }

    public function insertUser($pseudo, $password, $lastName, $firstName, $mail, $phoneNumber, $city, $role) {  
        $sql = "INSERT INTO utilisateur (pseudo, mot_de_passe, nom, prenom, mail, telephone, ville, role) 
            VALUES (:pseudo, :mot_de_passe, :nom, :prenom, :mail, :telephone, :ville, :role)";

        try {
            $this->executeRequest($sql, ["pseudo" => $pseudo, "mot_de_passe" => $password, "nom" => $lastName, "prenom" => $firstName, "mail" => $mail, "telephone" => $phoneNumber, "ville" => $city, "role" => $role]);
            $this->lastAddedId = self::getPDO()->lastInsertId();
        }
        catch(Exception $e) {
            throw new Exception('insert user failed');
        }
    }

    public function insertUnconfirmedUser($pseudo, $password, $lastName, $firstName, $mail, $phoneNumber, $city, $role, $token) {

        $this->insertUser($pseudo, $password, $lastName, $firstName, $mail, $phoneNumber, $city, $role);

        $sql = "INSERT INTO non_confirme_utilisateur(id_utilisateur, token) VALUES (:id_utilisateur, :token)";
        $sth = $this->executeRequest($sql,['id_utilisateur' => $this->lastAddedId, 'token' => $token]);
    }

    public function isConfirmationValid($userId, $token) {
        $sql = "SELECT id_utilisateur, token FROM non_confirme_utilisateur WHERE id_utilisateur = :id_utilisateur AND token = :token";
        $sth = $this->executeRequest($sql, ['id_utilisateur' => $userId, 'token' => $token]);
        
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function deleteUnconfirmedUser($idUser) {
        $sql = "DELETE FROM non_confirme_utilisateur WHERE id_utilisateur = :id_utilisateur";
        $this->executeRequest($sql,['id_utilisateur' => $idUser]);
    }

    public function updateUserInfosById($id, $pseudo, $lastName, $firstName, $mail, $phoneNumber, $city, $role) {
        $sql = "UPDATE utilisateur SET pseudo = :pseudo, nom = :nom, prenom = :prenom, mail = :mail, telephone = :telephone, ville = :ville, role = :role WHERE id_utilisateur = :id_utilisateur";
        $this->executeRequest($sql, ["id_utilisateur" => $id, "pseudo" => $pseudo, "nom" => $lastName, "prenom" => $firstName, "mail" => $mail, "telephone" => $phoneNumber, "ville" => $city, "role" => $role]);
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
        $this->deleteUnconfirmedUser($id);

        $sql = "DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur";
        return $this->executeRequest($sql, ["id_utilisateur" => $id]);
    }

    public function existsByUniqueEmail($email) {
        $sql = "SELECT mail FROM utilisateur WHERE mail = :email";
        $sth = $this->executeRequest($sql, ['email' => $email]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result !== false;
    }

    public function userConfirmed($id) {
        $sql = "SELECT id_utilisateur FROM non_confirme_utilisateur WHERE id_utilisateur = :id_utilisateur";
        $sth = $this->executeRequest($sql, ['id_utilisateur' => $id]);

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result === false;
    }

    private function mapUser($queryResult) {
        $user = new User();
        $user->setId($queryResult['id_utilisateur']);
        $user->setPassword($queryResult['mot_de_passe']);
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
