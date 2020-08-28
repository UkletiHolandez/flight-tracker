<?php

    namespace App\Models;
    use PDO;

    class __Database extends \Core\Model {

        protected $db,
            $rowCount = 0;

        public function __construct() {
            $this->db = self::getConnection();
        }

        public function genericQuery($sql) {
            $stmt = $this->db->prepare($sql);
            $exec = $stmt->execute();

            if ($exec) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $this->rowCount = $stmt->rowCount();
            } else {
                return $stmt->errorInfo();
            }
            return $result;
        }

        /* --------------------------------------------------------------------
         *   Query method below supports various SELECT formats. 
         *   For query formatting see example in file Airline.php
         * --------------------------------------------------------------------
        */

        public function query($fields, $table, $joinTable = null, $joinField = null, $conditions = null, $group = null, $order = null) {
            $fields = self::formatAttributes($fields);
            $conditions = self::formatConditions($conditions);
            $order = self::formatOrder($order);
            $joins = self::formatJoins($joinTable, $joinField);
            $sql = "SELECT $fields FROM $table $joins $conditions $group $order";
            $stmt = $this->db->prepare($sql);
            $exec = $stmt->execute();

            if ($exec) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $this->rowCount = $stmt->rowCount();
            } else {
                return $stmt->errorInfo();
            }
            return $result;
        }

        private function formatAttributes($fields) {
            $data = implode(', ', $fields);
            return $data;
        }

        private function formatConditions($conditions) {
            if ($conditions == null) {
                return null;
            } elseif (sizeof($conditions) == 1) {
                $data = implode(', ', $conditions);
            } else {
                $data = implode(' ', $conditions);
            }
            return "WHERE " . $data;            
        }

        private function formatOrder($order) {
            if ($order == null) {
                return null;
            } else {
                return "ORDER BY " . $order; 
            } 
        }

        private function formatJoins($table, $fields) {
            if ($table == null OR $fields == null) {
                return null;
            } else {
                return " " . $table . " " . $fields; 
            } 
        }

        /*public function insert($table, $data) {
            $sql = "INSERT INTO $table";
            $stmt = $this->db->prepare($sql);
            $exec = $stmt->execute($data);

            if ($exec) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $this->rowCount = $stmt->rowCount();
            } else {
                return $stmt->errorInfo();
            }
            return $result;
        }*/

    }