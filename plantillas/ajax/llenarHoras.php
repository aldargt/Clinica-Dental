<?php

include("../con_db.php");

$horas = array();
$anio  = $_POST["anio"];
$mes   = $_POST["mes"];
$dia   = $_POST["dia"];
$duracionTratamiento = $_POST["duracion"] - 0.25;
/*$anio = 2020;
$mes  = 10;
$dia  = 27;
$duracionTratamiento = 1 - 0.25;*/

$primeraHora = 8;

if($duracionTratamiento > 0.0 && $anio > 0){

    $query = "select hora_cita, minuto_cita, duracion_tratamiento from clinicadental_citas
                where agno_cita=$anio and mes_cita=$mes and dia_cita=$dia order by hora_cita, minuto_cita";
    $resultset = pg_query($conex, $query);
    
    while($cita = pg_fetch_assoc($resultset)){

        $horaCita = aDecimal($cita["hora_cita"], $cita["minuto_cita"]);

        while($primeraHora < $horaCita){

            if(($horaCita-$primeraHora) > $duracionTratamiento){

                if($primeraHora != (12.00 - $duracionTratamiento)){
                    $horas[] = $primeraHora;
                    $primeraHora = $primeraHora + 0.25;
                }else{
                    $primeraHora = 14.00;
                } 

            }else{
                $primeraHora = $primeraHora + $duracionTratamiento;
            }    
        }
        $primeraHora = $primeraHora + $cita["duracion_tratamiento"];
        
    }
    while($primeraHora < (18.00 - $duracionTratamiento)){
        if($primeraHora != 12.00){
            $horas[] = $primeraHora;
            $primeraHora = $primeraHora + 0.25;
        }else{
            $primeraHora = 14.00;
        }    
    }

    $data = json_encode($horas);


}else{
    pg_close($conex);
    $data = json_encode(array("error"));
}

echo $data;

/*
for ($i=0; $i < count($horas); $i++){
    echo $horas [$i] . "<br>";
}

*/



function aDecimal($hora, $minuto){
    $decimal = $hora + $minuto/60;
    return $decimal;
}
/*
function getHora($decimal){
    return intval($decimal); 
}

function getMinuto($decimal){
    return ($decimal - intval($decimal))*60;
}*/

?>