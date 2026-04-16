<?php
    function crear_img($url){
        echo "<div class='logo'>";
            echo "<img src=".$url."></img>";
        echo "</div>";
    }

    function crear_footer($sitios){
        crear_menu($sitios, "footer");
        crear_img("./logo_curso.png");
    }
?>

<footer>
    <?php
        crear_footer($sitios)
    ?>
</footer>