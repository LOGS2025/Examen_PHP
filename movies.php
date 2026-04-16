<?php
    session_start();

    $loggedIn_flag = false;
    
    if (isset($_SESSION["username"]) && isset($_SESSION["password"])){
        $loggedIn_flag = true;
    }

    $sitios = [
        "inicio" => "index.php",
        "sobreNosotros" => "sobreNosotros.php",
        "organigrama" => "organigrama.php",
        "contacto" => "contacto.php",
        "logout" => "./process.php?request=logout"
    ];

    function getMovies(){
                require("./db/conexion.php");
        $sql = "SELECT * FROM peliculas";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
            
        // Fetch all rows as an array
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $movies;
    }
        
    function ticketSale($movie)
    {
        // SE REALIZA POST DE FORMULARIO HACIA PROCESS
        // AHI SE REGISTRAN TICKERS
        echo '<form action="./process.php" method="POST">';
            echo '<label for="numboletos">';
                echo '<span>Cantidad de boletos</span>';
                echo '<input type="number" name="numboletos">';
            echo '</label>';
            echo '<button type="submit">Enviar</button>';
            echo '<label for "movie">Elige una pelicula</label>';
                echo '<select name="movie" id="movie">';
                echo '<option value='.$movie["titulo"].'>'.$movie["titulo"].'</option>';
                echo '</select>';
        echo '</form>';
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
                    $movies = getMovies();
                    
                    ticketSale($movies);
                    foreach ($movies as $movie) {
                        echo "<div class=movie </div>";
                        echo "<div> {$movie['titulo']}</div>";
                        echo "<div> {$movie['descripcion']}</div>";
                        echo "<div> {$movie['precio']}</div>";
                        ticketSale($movie);
                        echo "<br>";
                    }
                ?>
        </div>
    </main>
    <?php require("./componentes/header.php"); ?>    
</body>
</html>