<?php

include("../con_db.php");

$id = $_POST["id"];

$query = "select * from clinicadental_citas where id=$id";
$resultset = pg_query($conex, $query);
pg_close($conex);

$cita = pg_fetch_assoc($resultset);
$informacion = array(
				'nombres' => $cita["nombres"],
				'apellidos' => $cita["apellidos"], 
				'correo' => $cita["correo"],
				'numero' => $cita["numero_telefono"]
			);

$data = json_encode($informacion);

echo $data;

?>