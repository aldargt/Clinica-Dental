<?php

$arrayTitulo = array();
$arrayImagen = array();

include("../con_db.php");

$query = "select titulo, imagen from clinicadental_tratamientos";
$resultset = pg_query($conex, $query);
pg_close($conex);

while($tratamiento = pg_fetch_assoc($resultset)){
	$arrayTitulo[] = $tratamiento["titulo"];
	$arrayImagen[] = $tratamiento["imagen"];
}

$arrayTratamiento = array('titulo' => $arrayTitulo, 'imagen' => $arrayImagen);

$data = json_encode($arrayTratamiento);

echo $data;

?>