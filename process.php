<?php
    session_start();

    function db_fetch_user($pdo,$username,$password){
        $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
        $stmt = $pdo->prepare($sql);

        $bool = $stmt->execute([$username,$password]);
        return $bool;
    }

    function setSession($arg1,$arg2){
            $_SESSION["username"] = $arg1; 
            $_SESSION["password"] = $arg2; 
    }
    function submit_compra($pdo,$numboletos,$username,$password,$movie)

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
                return $result_bool;
            }
            if(!empty($numboletos) && !empty($movie))
            {

            }
        }   
    }

    function handle_GET(){
        if ($_SERVER["REQUEST_METHOD"] === "GET"){
            var_dump($_GET);
        }
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
        if(handle_POST()){
            header("Location: ./movies.php?success=1&code=400");
            exit;
        } else {
            header("Location: ./index.php?success=0&code=401");
            exit;
        }
        // handle_GET();
    ?>
</body>
</html>