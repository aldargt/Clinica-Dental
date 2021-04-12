<?php

$horas = array();
$anio  = $_POST["anio"];
$mes   = $_POST["mes"];
$dia   = $_POST["dia"];
if($_POST["duracion"] >= 0.25){
    $duracionTratamiento = $_POST["duracion"] - 0.25;
}else{
    $duracionTratamiento = 0;
}

$primeraHora = 8;

if($anio > 0){
    
    include("../con_db.php");

    $query = "select hora_cita, minuto_cita, duracion_tratamiento from clinicadental_citas
    where agno_cita=$anio and mes_cita=$mes and dia_cita=$dia order by hora_cita, minuto_cita";
    $resultset = pg_query($conex, $query);
    pg_close($conex);
    
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
        if($primeraHora != (12.00 - $duracionTratamiento)){
            $horas[] = $primeraHora;
            $primeraHora = $primeraHora + 0.25;
        }else{
            $primeraHora = 14.00;
        }    
    }

    $data = json_encode($horas);


}

echo $data;

function aDecimal($hora, $minuto){
    $decimal = $hora + $minuto/60;
    return $decimal;
}

?>