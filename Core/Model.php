<?php

    namespace Core;
    use PDO;
    use App\Config;

    abstract class Model {

        protected static $conn = null;

        protected static function getConnection() {
            if (self::$conn === null) {
                try {
                    self::$conn = new PDO(Config::DB_SOURCE, Config::DB_USER, Config::DB_PASSWORD);
                    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
            }
            return self::$conn;
        }

    }