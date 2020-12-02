<?php 

include("con_db.php");
if (isset($_POST["submit"])) {
    $aniolisto = true;
    $duracionTratamiento = "";
    $tipoTratamiento = "";
    $anio          = "";
    $mes           = "";
    $dia           = "";
	$nombre        = trim($_POST["nombre"]);
	$apellido      = trim($_POST["apellido"]);
	$correo        = trim($_POST["email"]);
    $telefono      = intval($_POST["telefono"]);
    if($_POST["tratamiento"] != null){
        $tratamiento   =  $_POST["tratamiento"];
        for($i=0;$i<strlen($tratamiento);$i++){
           if($tratamiento[$i]=="-"){
            $duracionTratamiento = floatval(substr($tratamiento,0,$i));
            $tipoTratamiento = substr($tratamiento,$i+1,strlen($tratamiento)-1);
           break;
           }
        }
    }else{
        $tratamiento = "";
    }
    if($_POST["fecha"] != null){
        $fecha       = $_POST["fecha"];
        for($j=0;$j<strlen($fecha);$j++){
            if($fecha[$j]=="-" && $aniolisto){
             $anio = intval(substr($fecha,0,$j));
             $aniolisto = false;
             $indice  = $j+1;
             continue;
            }
            if($fecha[$j]=="-" && !$aniolisto){
                $mes = intval(substr($fecha,$indice,$j));
                $dia = intval(substr($fecha,$j+1,strlen($fecha)-1));
            break;
            }
        }
    }else{
        $fecha = "";
    }
    
    $hora        = intval($_POST["hora"]);
    $minuto      = intval(($_POST["hora"]-$hora) * 60);
	$consulta    = "INSERT INTO clinicadental_citas(nombres, apellidos , correo, numero_telefono, tipo_tratamiento, duracion_tratamiento, agno_cita, mes_cita, dia_cita, hora_cita, minuto_cita) VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$tipoTratamiento', '$duracionTratamiento', '$anio', '$mes', '$dia', '$hora', '$minuto')";

    /*controlar las variables*/
    if ($nombre != "" && $apellido != "" && $correo != "" && $hora > 0 && $fecha != "" && $minuto > 0 && $tratamiento != "") {
        if (pg_query($conex,$consulta)) {
            //cambiar el mensaje de el alert con boton de aceptar
            echo "<script type='text/javascript'>if(confirm('¡Se ha registrado correctamente el Tratamiento!')) 
        location.href='../index.html'</script>";
        } 
    } else {
        echo "<script type='text/javascript'>if(confirm('¡Ups ha ocurrido un error!')) 
        location.href='formreserva.php'</script>";  
    }
}

?>