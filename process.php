<?php
    session_start();

    function db_fetch_user($pdo,$username,$password){
        $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
        $stmt = $pdo->prepare($sql);

        $bool = $stmt->execute([$username,$password]);
        return $stmt->rowCount() > 0;  // Returns true if at least 1 row found
    }

    function setSession($arg1,$arg2){
            $_SESSION["username"] = $arg1; 
            $_SESSION["password"] = $arg2; 
    }

    function submit_compra($pdo, $numboletos, $username, $password, $movie)
    {
        $sql_id = "SELECT peliculas.id FROM peliculas WHERE peliculas.titulo = ?";
        $stmt_id = $pdo->prepare($sql_id);
        $stmt_id->execute([$movie]);
        $id_pelicula = $stmt_id->fetchColumn();
        
        $sql_precio = "SELECT peliculas.precio FROM peliculas WHERE peliculas.titulo = ?";
        $stmt_precio = $pdo->prepare($sql_precio);
        $stmt_precio->execute([$movie]);
        $precio = $stmt_precio->fetchColumn();
        
        $sql_insert = "
            INSERT INTO compras (usuario, id_pelicula, nombre_pelicula, cantidad_boletos, precio_boleto, monto_total)
            VALUES (?, ?, ?, ?, ?, ?)
        ";
        
        $stmt_insert = $pdo->prepare($sql_insert);
        return $stmt_insert->execute([
            $username,
            $id_pelicula,
            $movie,
            $numboletos,
            $precio,
            $precio * $numboletos
        ]);
    }

    function handle_POST(){
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $numboletos = $_POST["numboletos"];
            $movie = $_POST["movie"];
            // OBTENEMOS USERNAME Y PASSWORD
            require("./db/conexion.php");
            if(!empty($username) && !empty($password))
            {
                $result_bool = db_fetch_user($pdo,$username,$password);
                if($result_bool){
                    setSession($username,$password);
                }
                return $result_bool;
            }
            if(!empty($numboletos) && !empty($movie))
            {
                $username = $_SESSION["username"];
                $password = $_SESSION["password"];
                $result_transaction = submit_compra($pdo,$numboletos,$username,$password,$movie);
                return $result_transaction;
            }
        }   
    }

    function handle_GET(){
        if ($_SERVER["REQUEST_METHOD"] === "GET"){
            if ($_GET['request'] == "logout") {
                session_unset();
                session_destroy();
                header("Location: ./index.php");
                exit;
            }
        }
    }

    handle_GET();
    if(handle_POST()){
        header("Location: ./movies.php?success=1&code=400");
        exit;
    } else {
        header("Location: ./index.php?success=0&code=401");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    ?>
</body>
</html>