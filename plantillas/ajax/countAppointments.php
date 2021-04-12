<?php

include("../con_db.php");

$anio = $_POST["anio"];
$mes  = $_POST["mes"];
$dia  = $_POST["dia"];

$query = "select count(*) from clinicadental_citas where agno_cita=$anio and mes_cita=$mes and dia_cita=$dia";
$resultset = pg_query($conex, $query);
pg_close($conex);

$data = json_encode(array(pg_fetch_assoc($resultset)["count"]));
echo $data;

?>