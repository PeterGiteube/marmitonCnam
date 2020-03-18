<?php

abstract class Model {

    private static $bdd;

    protected function executeRequest($sql, $params = null) {
        if($params == null) {
            $result = self::getPDO()->query($sql);
        } else {
            $result = self::getPDO()->prepare($sql);
            $result->execute($params);
        }

        return $result;
    }

    protected static function getPDO() {
        if (self::$bdd == null) {
          // Création de la connexion
          self::$bdd = new PDO("mysql:host=mysql-marmitoncnam.alwaysdata.net;dbname=marmitoncnam_bdd", "202153", "Cnam123");
        }

        return self::$bdd;
      }
}

?>