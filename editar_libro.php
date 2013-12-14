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

			$editoriales = array();
			$autores = array();

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

			if ($_SERVER['REQUEST_METHOD'] == 'GET'){
				$query = "select * from book where idbook='" . $_GET['id'] . "';";
				$resultado = mysqli_query($conexion, $query);
				$row = mysqli_fetch_array($resultado);
				$nombre=$row['namebook'];
				$isbn = $row['isbn'];
				$year = $row['year'];
				$ideditorial2 = $row['ideditorial'];

				$query = "select idauthor from bookauthors where idbook='" . $_GET['id'] . "';";
				$resultado = mysqli_query($conexion, $query);
				$row = mysqli_fetch_array($resultado);
				$idauthor2=$row['idauthor'];

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
                $query = "update book set isbn='".$_POST['isbn']."', namebook='".$_POST['nombre']."', year='".$_POST['anho']."', ideditorial='".$_POST['editorial']."' where idbook=".$_GET['id'].";";
                echo $query;
                $resultado1 = mysqli_query($conexion, $query);

                $query = "update bookauthors set idauthor='".$_POST['otronombre']."'where idbook=".$_GET['id']." ;";
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
        <input type="text" name="nombre" required value="<?php echo $nombre ?>" ><br/><br/>
        
        <label>ISBN</label>
        <input onkeypress="return es_numero(event)" required pattern="[0-9]{13}" type="text" name="isbn" id="isbn" value="<?php echo $isbn ?>"><br/><br/>
        
        <label>Autor</label>
        <select name="otronombre">
            <?php
                foreach ($autores as $au) {
                	if($au[idauthor]===$idauthor2)
                		echo "<option value='$au[idauthor]' selected>$au[nameauthor]</option>";
                	else
                	    echo "<option value='$au[idauthor]'>$au[nameauthor]</option>";
                }
            ?>
        </select><br/><br/>
        
        <label>Año</label>
        <input onkeypress="return es_numero(event)" type="text" pattern="[0-9]{4}" placeholder="yyyy" name="anho" value="<?php echo $year ?>"><br/><br/>
        
        <label>Editorial</label>
        <select name="editorial">
            <?php
                foreach ($editoriales as $ed) {
                	if($ed[ideditorial]===$ideditorial2)
                		echo "<option value='$ed[ideditorial]' selected>$ed[nameeditorial]</option>";
                	else
                    	echo "<option value='$ed[ideditorial]'>$ed[nameeditorial]</option>";
                }
            ?>
        </select><br/><br/>

        <input type="submit" value="Actualizar">  <br/><br/>      

    </form>

	</body>
</html>