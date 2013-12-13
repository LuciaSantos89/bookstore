<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="javascript/script.js"></script>
</head>
<body>
    
    <?php
        include 'conectar.php';
        echo "I'm working, sexy!<br>";
        $editoriales = array();
        $autores = array();

        $conexion = mysqli_connect($host,$user,$password,$db);
        if (mysqli_connect_errno($conexion)){
            echo "Failed to connect " . mysqli_connect_error();
        }else{
            echo "Connection Succesful<br>";
        }

        $query = "select nameauthor, idauthor from author";
        $resultado = mysqli_query($conexion, $query);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($GLOBALS['autores'], $row);
        }

        $query = "select nameeditorial, ideditorial from editorial";
        $resultado = mysqli_query($conexion, $query);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($GLOBALS['editoriales'],$row);
        }


        function validar()
        {
            if(empty($_POST['nombre']) || empty($_POST['isbn']) || strlen($_POST['isbn']) != 13 || strlen($_POST['anho']) !=4){
                return false;
            }
            return true;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(validar()){

                $query = "insert into book (idbook,isbn,namebook,year,ideditorial) values (NULL,'".$_POST['isbn']."','".$_POST['nombre']."','".$_POST['anho']."','".$_POST['editorial']."');";
                $resultado1 = mysqli_query($conexion, $query);

                $query = "select idbook from book where isbn='".$_POST['isbn']."';";
                $resultado2 = mysqli_query($conexion, $query);
                $row = mysqli_fetch_array($resultado2);

                $query = "insert into bookauthors (idbook,idauthor) values ($row[idbook],'".$_POST['otronombre']."');";
                $resultado3 = mysqli_query($conexion, $query);

                if($resultado1){
                    mysqli_close($conexion);
                    header('Location: listar_libro.php');
                }
                else
                    echo "No se pudo agregar el libro";
            }
            else
                echo "No lleno el formulario de forma correcta";
        }          

    ?>

    <form method="post">
        
        <label>Nombre</label>
        <input type="text" name="nombre" required><br/><br/>
        
        <label>ISBN</label>
        <input onkeypress="return es_numero(event)" required pattern="[0-9]{13}" type="text" name="isbn" id="isbn"><br/><br/>
        
        <label>Autor</label>
        <select name="otronombre">
            <?php
                foreach ($autores as $au) {
                    echo "<option value='$au[idauthor]'>$au[nameauthor]</option>";
                }
            ?>
        </select><br/><br/>
        
        <label>Año</label>
        <input onkeypress="return es_numero(event)" type="text" pattern="[0-9]{4}" placeholder="yyyy" name="anho"><br/><br/>
        
        <label>Editorial</label>
        <select name="editorial">
            <?php
                foreach ($editoriales as $ed) {
                    echo "<option value='$ed[ideditorial]'>$ed[nameeditorial]</option>";
                }
            ?>
        </select><br/><br/>

        <input type="submit" value="Agregar">  <br/><br/>      

    </form>

</body>
</html>