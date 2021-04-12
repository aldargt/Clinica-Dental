<?php

include("../con_db.php");

$citas = array();
$anio  = $_POST["anio"];
$mes   = $_POST["mes"];
$dia   = $_POST["dia"];

$query = "select id, hora_cita, minuto_cita, tipo_tratamiento from clinicadental_citas where agno_cita=$anio and mes_cita=$mes and dia_cita=$dia order by hora_cita, minuto_cita";
$resultset = pg_query($conex, $query);
pg_close($conex);

while($cita = pg_fetch_assoc($resultset)){
	$citas[] = array('id' => $cita["id"], 
					'hora' => $cita["hora_cita"],
					'minuto' => $cita["minuto_cita"],
					'tratamiento' => $cita["tipo_tratamiento"]
				);
}

if(sizeof($citas) > 0){
	$data = json_encode($citas);
}else{
	$data = json_encode(array("error"));
}


echo $data;

?>