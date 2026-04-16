<?php
    session_start();

    
    if ($_SESSION["username"]!='admin' && $_SESSION["password"]!='1234'){
        header("Location: ./index.php");
        exit;
    }

    $sitios = [
        "inicio" => "./index.php",
        "logout" => "./process.php?request=logout"
    ];

    function getCompras(){
        require("./db/conexion.php");
        $sql = "SELECT * FROM compras";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
            
        // Fetch all rows as an array
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $movies;
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
        <?php require("./componentes/header.php"); ?>
        <main>
            <div>
                <?php 
                    $compras = getCompras();
                    
                    foreach ($compras as $compra) {
                        echo "<div class=compras </div>";
                        echo "<div> {$compra['usuario']}</div>";
                        echo "<div> {$compra['nombre_pelicula']}</div>";
                        echo "<div> {$compra['cantidad_boletos']}</div>";
                        echo "<br>";
                    }
                ?>
        </div>
    </main>
    <?php require("./componentes/header.php"); ?>    
</body>
</html>