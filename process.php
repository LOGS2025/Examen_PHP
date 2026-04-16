<?php
    session_start();

    function db_fetch_user($pdo,$username,$password){
        $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
        $stmt = $pdo->prepare($sql);

        $bool = $stmt->execute([$nombre,$password]);
        var_dump($bool);
        var_dump($stmt);
        return $bool;
    }

    function handle_POST(){
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            // OBTENEMOS USERNAME Y PASSWORD
            if($_SERVER["username"] && $_SERVER["password"]){
                result_bool = db_fetch_user($pdo,$_SERVER["username"],$_SERVER["password"]);
                result_bool ? echo "gg" : echo "failed";
                return;
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
        // handle_POST();
        // handle_GET();
        require("./db/conexion.php");
    ?>
</body>
</html>