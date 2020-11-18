<?php 

include("con_db.php");

if (isset($_POST["boton1"])) {

	if(isset($_FILES["imagen"])){
		$name = $_FILES["imagen"]["name"];
		$tmp_name = $_FILES["imagen"]["tmp_name"];
		$tipo = $_FILES['imagen']['type'];
	}

	$titulo      = trim($_POST["titulo"]);
	$imagen      = $name;
	$descripcion = trim($_POST["descripcion"]);
	$hora        = $_POST["hora"];
	$minuto      = $_POST["minuto"];
	$hora        = $hora + ($minuto/60.0);

	$consulta    = "INSERT INTO clinicadental_tratamientos(titulo, descripcion, imagen, duracion_tratamiento) VALUES ('$titulo', '$descripcion', '$imagen', '$hora')";


	$destino = "../multimedia/" . $imagen;
	if(strpos($tipo, "png") || strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "bmp")){
		if(move_uploaded_file( $tmp_name, $destino)){
			chmod($destino, 0777);
		}

		if (pg_query($conex,$consulta)) {
    		echo "<script type='text/javascript'>alert('¡Se ha registrado correctamente el Tratamiento!');</script>";
    	} else {
    		echo "<script type='text/javascript'>alert('¡Ups ha ocurrido un error!');</script>";
    	}
	}else{
		echo "<h3 class='bad'>¡La extension de la imagen es incorrecta!</h3>";
	}
}

?>