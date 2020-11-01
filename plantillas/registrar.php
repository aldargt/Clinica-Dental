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

	$consulta    = "INSERT INTO clinicadental_tratamientos(titulo, descripcion, imagen) VALUES ('$titulo', '$descripcion', '$imagen')";


	$destino = "../multimedia/" . $imagen;
	if(strpos($tipo, "png") || strpos($tipo, "jpg") || strpos($tipo, "jpeg") || strpos($tipo, "bmp")){
		if(move_uploaded_file( $tmp_name, $destino)){
			chmod($destino, 0777);
		}

		if (pg_query($conex,$consulta)) {
    		echo "<h3 class='ok'>¡Se ha Registrado correctamente el tratamiento!</h3>";
    	} else {
    		echo "<h3 class='bad'>¡Ups ha ocurrido un error!</h3>";
    	}
	}else{
		echo "<h3 class='bad'>¡La extension de la imagen es incorrecta!</h3>";
	}
}

?>