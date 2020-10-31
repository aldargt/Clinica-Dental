<?php 

include("con_db.php");

if (isset($_POST["boton1"])) {

	if(isset($_FILES["imagen"])){
		$name = $_FILES["imagen"]["name"];
		$tmp_name = $_FILES["imagen"]["tmp_name"];
	}

    if (strlen($_POST["titulo"]) >= 1 && strlen($_POST["descripcion"]) >= 1) {

		$titulo      = trim($_POST["titulo"]);
		$imagen      = $name;
		$descripcion = trim($_POST["descripcion"]);
		$consulta    = "INSERT INTO clinicadental_tratamientos(titulo, descripcion, imagen) VALUES ('$titulo', '$descripcion', '$imagen')";
		$resultado   = pg_query($conex,$consulta);

		$destino = "../multimedia/" . $imagen;
		if(move_uploaded_file( $tmp_name, $destino )){
			chmod('images/'.$archivo, 0777);
		}

	    if ($resultado) {
	    	echo "<h3 class='ok'>¡Se ha Registrado correctamente el tratamiento!</h3>";
	    } else {
	    	echo "<h3 class='bad'>¡Ups ha ocurrido un error!</h3>";
	    }
    }else {
	    echo "<h3 class='bad'>¡Error, En el Campo no Llenado!</h3>";      
    }
}

?>