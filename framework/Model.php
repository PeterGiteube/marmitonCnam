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
            $dns = Configuration::get("dns");
            $login = Configuration::get("login");
            $password = Configuration::get("password");

            self::$bdd = new PDO($dns, $login, $password);
        }

        return self::$bdd;
      }
}

?>