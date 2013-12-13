<!DOCTYPE html>
<html>
<body>

<?php
echo "I'm working, sexy!";
?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(document).ready(function(){
    $("#menu").accordion();
});
</script>

<div id="menu">
            <h3>Libros</h3>
            <div>
                <p><a href="agregar_libro.php">Agregar</a></p>
                <p><a href="listar_libro.php">Listar</a></p>
            </div>
            <h3>Autor</h3>
            <div>
                <p><a href="agregar_autor.php">Agregar</a></p>
                <p><a href="listar_autor.php">Listar</a></p>
            </div>
            <h3>Editorial</h3>
            <div>
                <p><a href="agregar_editorial.php">Agregar</a></p>
                <p><a href="listar_editorial.php">Listar</a></p>
            </div>
        </div>

</body>
</html>