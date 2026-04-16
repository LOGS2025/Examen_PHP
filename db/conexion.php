<?php
        try {
            $pdo = new PDO(
                "mysql:host=localhost;dbname=examen_php",
                "root",
                "");
            return $pdo;
        } catch (PDOException $e) {
            echo "$error->getMessage()";
            return null;
        }
?>