<?php 

include("con_db.php");

if (isset($_POST["boton1"])) {
    if (strlen($_POST["titulo"]) >= 1 && strlen($_POST["descripcion"]) >= 1) {
		$titulo = trim($_POST["titulo"]);
		$imagen = trim($_POST["imagen"]);
		$descripcion = trim($_POST["descripcion"]);
	    $fechareg = date("d/m/y");
		$consulta = "INSERT INTO tratamientos(tratamiento, imagen, descripcion, fecha_reg) VALUES ('$titulo','$imagen','$descripcion','$fechareg')";
		$resultado = mysqli_query($conex,$consulta);
	    if ($resultado) {
	    	?> 
	    	<h3 class="ok">¡Se ha Registrado correctamente el tratamiento!</h3>
           <?php
	    } else {
	    	?> 
	    	<h3 class="bad">¡Ups ha ocurrido un error!</h3>
           <?php
	    }
    }   else {
	    	?> 
	    	<h3 class="bad">¡Error, En el Campo no Llenado!</h3>
           <?php
    }
}

?>