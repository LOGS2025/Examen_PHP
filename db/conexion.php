<?php
    function pdo_usuarios(){
        try {
            $pdo = new PDO(
                "mysql:host=localhost;dbname=usuarios",
                "root",
                "");
            echo "Conexion exitosa";
            return $pdo;
        } catch (PDOException $e) {
            echo "$error->getMessage()";
            return null;
        }
    }
?>