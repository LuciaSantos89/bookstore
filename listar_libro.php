<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <?php
    include 'conectar.php';
    echo "I'm working, sexy!<br>";

    $conexion = mysqli_connect($host,$user,$password,$db);
    if (mysqli_connect_errno($conexion)){
        echo "Failed to connect " . mysqli_connect_error();
    }
    else{
        echo "Connection Succesful<br>";
    }

    $from_book=array();

    $query = "select * from book";
    $resultado = mysqli_query($conexion, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($from_book, $row);
    }

    ?>

    
    <table>
        <tr>
            <th>Nombre</th>
            <th>Isbn</th>
            <th>Año</th>
            <th>Editorial</th>
            <th colspan="2">Acciones</th>
        </tr>
        <?php
            foreach ($from_book as $bo) {
                echo "<tr>
                        <td>$bo[namebook]</td>
                        <td>$bo[isbn]</td>
                        <td>$bo[year]</td>
                        <td>$bo[ideditorial]</td>";
                echo "  <td><a href='editar_libro.php?id=".$bo[idbook]."'>Editar</a></td>
                        <td><a href='listar_libro.php?id=".$bo[idbook]."'>Eliminar</a></td>
                      </tr>";
            }
            
        ?>
    </table>
    <div>
        <p><a href="agregar_libro.php">Agregar libro</a></p>
        <input type='button' name='editar' value='Editar' method='get' action='editar_libro.php'/>
    </div>

</body>
</html>