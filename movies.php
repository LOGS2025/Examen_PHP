<?php
    session_start();

    $sitios = [
        "inicio" => "index.php",
        "sobreNosotros" => "sobreNosotros.php",
        "organigrama" => "organigrama.php",
        "contacto" => "contacto.php",
        !isset($_SESSION["user"]) ? "sign in" : "home" => !isset($_SESSION["user"]) ? "login.php" : "./home/dashboard.php"
    ];

    function ticketSale()
    {
        // SE REALIZA POST DE FORMULARIO HACIA PROCESS
        // AHI SE REGISTRAN TICKERS
        echo '<form action="./process.php" method="POST">';
            echo '<label for="user">';
                echo '<span>Cantidad de boletos</span>';
                echo '<input type="text" name="username">';
            echo '</label>';
            echo '<label for="contraseña">';
                echo '<span>Pelicula</span>';
                echo '<input type="text" name="password">';
            echo '</label>';
            echo '<button type="submit">Enviar</button>';
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
                login(); 
            ?>
        </div>
    </main>
    <?php require("./componentes/header.php"); ?>    
</body>
</html>