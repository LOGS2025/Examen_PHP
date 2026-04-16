<?php
function crear_menu($sitios,$id) {
        echo "<nav id=".$id.">"; 
            echo "<ul>";
                foreach($sitios as $key => $value) {
                    echo  "<li><a href=".$value.">".$key."</a></li>";
                }
            echo "</ul>";
        echo "</nav>";
    }

?>
<header>
    <?php
        crear_menu($sitios,"menu");
    ?>
</header>
