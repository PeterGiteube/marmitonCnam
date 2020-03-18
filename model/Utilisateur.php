<?php

require_once 'model/Model.php';
class Utilisateur extends Model {

    public function getUserByCredentials($userName, $password) {
        $sql = "SELECT id_utilisateur, pseudo FROM utilisateur WHERE pseudo = :pseudo AND mot_de_passe = :mot_de_passe";
        $result = $this->executeRequest($sql, array("pseudo" => $userName, "mot_de_passe" => $password));

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function isUserAdminByUserId($userId) {
        $role = $this->getAdminRoleByUserId($userId);

        if($role) { 
            return true;
        }

        return false;
    }

    public function getUserById($id) {
        $sql = "SELECT id_utilisateur, pseudo, nom, prenom, mail, telephone, ville FROM utilisateur WHERE id_utilisateur = :id";
        $result = $this->executeRequest($sql, array("id" => $id));

        return $result->fetch();
    }

    public function getUsers() {
        $sql = "SELECT id_utilisateur, pseudo, nom, prenom, mail, telephone, ville FROM utilisateur ORDER BY id_utilisateur DESC";
        $result = $this->executeRequest($sql);

        return $result;
    }

    private function getAdminRoleByUserId($userId) {
        $ADMIN_ROLE_FLAG = 2;

        $sql = "SELECT id_role FROM utilisateur_role WHERE id_utilisateur = :id_utilisateur AND id_role = :id_role";
        $result = $this->executeRequest($sql, ["id_utilisateur" => $userId, "id_role" => $ADMIN_ROLE_FLAG]);

        return $result;
    }
}
