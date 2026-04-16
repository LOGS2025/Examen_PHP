<?php
    session_start();

    $sitios = [
        "inicio" => "index.php",
        "sobreNosotros" => "sobreNosotros.php",
        "organigrama" => "organigrama.php",
        "contacto" => "contacto.php",
        !isset($_SESSION["user"]) ? "sign in" : "home" => !isset($_SESSION["user"]) ? "login.php" : "./home/dashboard.php"
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
        
    function ticketSale($movies)
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
                foreach($movies as $movie){
                    echo '<option value='.$movie["titulo"].'>'.$movie["titulo"].'</option>';
                }
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
                        echo "<br>";
                    }
                ?>
        </div>
    </main>
    <?php require("./componentes/header.php"); ?>    
</body>
</html>