<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Reservacion de Cita</title>
	<link rel="stylesheet" type="text/css" href="../estaticos/css/formreserva.css">
  <link rel="stylesheet" href="../estaticos/css/semantic-ui/semantic.min.css">
  <link rel="stylesheet" href="../estaticos/css/bootstrap/bootstrap.min.css">
  <script src="../estaticos/js/semantic-ui/semantic.min.js"></script>
  <script src="../estaticos/js/semantic-ui/jquery-ui.min.js"></script>
  
</head>
<body>

<header>
<div class="ui secondary  menu " fixed-top>
  <a class="active item" href="../">
    ClinicaDent
  </a>
</div>
  <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../">ClinicaDent</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    </button>
  </nav> -->
</header>

<section>
<div class="cont">
<!-- <div class="ui centered pheader full" style="background-color:white"> -->
    <div class="sombra">
      <form enctype="multipart/form-data" method="post" action="registrarCita.php" onsubmit="return validar();">
        <h1>RESERVA TU CITA</h1>
        <h3>Todo los campos son obligatorios.</h3>
        <div class="cont_form">
        <label for="nombre">NOMBRES:</label></br>
        <input type="text" placeholder="Ingrese Nombre" name="nombre" maxlength="50" id="nombre" class="cajas " style='width:100%' pattern="[a-zA-ZñÑ ]{2,49}" title="Solo letras y longitud 3-50" required>
        <label for="apellidos">APELLIDOS:</label></br>
        <input type="text" placeholder="Ingrese Apellidos" name="apellido"  id="apellidos" class="cajas" style='width:100%' maxlength="50" 
        pattern="[a-zA-ZñÑ ]{2,49}" title="Solo letras y longitud 3-50" required>
        <label for="email">CORREO ELECTRONICO:</label></br>
        <input type="text" placeholder="ejemplo@dominio.com" name="email" id="email" class="cajas" style='width:100%' 
         title=" Ejemplo@dominio.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
  
        <label for="telefono">TELEFONO:</label></br>
        <input type="text" placeholder="Ingrese Telefono" name="telefono" id="telefono" class="cajas" style='width:100%' maxlength="8" 
           title=" solo numeros y longitud 7-8 " pattern="[0-9]{7,8}" required>
        
        <label for="tipo">TIPO DE TRATAMIENTO:</label></br>
        <select id="estadia"  class="cajas" name="tratamiento" style='width:100%' required>
          <option value="" disabled selected>Seleccione tratamiento</option>
          <?php 
              include("con_db.php");

              $query = "select titulo, duracion_tratamiento from clinicadental_tratamientos";
              $resultset = pg_query($conex, $query);
              pg_close($conex);
              while($tratamiento = pg_fetch_assoc($resultset)){
            ?>

              <option value="<?php echo $tratamiento['duracion_tratamiento'] .'-'. $tratamiento['titulo'] ?>">
               <?php echo $tratamiento["titulo"] ?>
              </option>

            <?php    
              }
            ?>
       </select></br>
        
        <label for="fecha">FECHA:</label></br>
        <select class="fecha"  name="fecha" id="fecha" style='width:100%' required>
          	<option value="" disabled selected>Seleccione una fecha</option>
        </select></br>

        <label for="hora">HORA:</label></br>
        <select class="cajas"  name="hora" id="hora"  style='width:100%' required>
          	<option value="" disabled selected>Seleccione un horario</option>
        </select></br>

        </div>
        <div class= "btn">
        <input type="button" name="boton2" onclick='if(confirm("¿Esta seguro que quiere abandonar la pagina de reservas de citas?")) location.href="../"'value="CANCELAR" class="ui yellow button">
        <input type="submit" value="RESERVAR CITA" name="submit" class="ui yellow button">
        </div>
  
  	</form>
    </section>
  	<script src="../estaticos/js/jquery-3.5.1.min.js"></script>
	<script src="../estaticos/js/formreserva.js"></script>   
  
    </div>
  </div>
</body>
</html>

<!-- [12:12, 24/11/2020] Alvaro.informatica:  -->
<script src="../estaticos/js/jquery-3.5.1.min.js"></script>
<script src="../estaticos/js/popper.min.js"></script>
<script src="../estaticos/js/bootstrap/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){

    $("#info").click(function(){
      $("#info").popover("show");
    });

    /*$("#nombre").change(function(){
      $('#nombre').popover('hide');
      valor=$("#nombre").val();
      if(valor.length < 4){
        $("#nombre").addClass("is-invalid");
        $("#nombre").removeClass("is-valid");
        $("#nombre").popover("show");
        $(".popover-body").text("nombre muy corto");
      }else if(valor.length > 50){

      }else{
          $("#nombre").removeClass("is-invalid");
          $("#nombre").addClass("is-valid");
        for (var i=valor.length; i >=0; i--) {
          if( Number.isInteger(parseInt(valor.charAt(i))) ){
            $("#nombre").addClass("is-invalid");
            $("#nombre").removeClass("is-valid");
            $("#nombre").popover("show");
            $(".popover-body").text("solo letras");
            break;
          }else{
            $("#nombre").removeClass("is-invalid");
            $("#nombre").addClass("is-valid");
            break;
          }
        }
      }
      
    });*/

  });

   // function validar(){
   //     var nombre, apellidos, email, telefono;
   //     nombre= document.getElementById("nombre").value;
   //     apellidos= document.getElementById("apellidos").value;
   //     email= document.getElementById("email").value;
   //     telefono= document.getElementById("telefono").value;
   //     console.log(nombre );
   //     if(nombre === "" || apellidos === "" || email === "" || telefono === ""){
   //         alert("Todos los campos son Obligatorio");
   //     }
   //     else if(nombre.length > 48){
   //         alert("El campo nombre es muy grande");
   //     }
   //     else if(apellidos.length > 48){
   //         alert("El campo apellido es muy grande");
   //     }
   //     else if(!isNaN(nombre)){
   //         alert("En  campo nombre solo acepta letras");
   //     }
   //     else if(!isNaN(apellidos)){
   //         alert("El campo apellidos solo acepta letras");
   //     }
   //     else if(isNaN(telefono)){
   //         alert("El  campo telfono solo acepta numero");
   //     }
   //     else if(!validarCorreo(email)){
   //         alert("El campo email no es valido");
   //     }
   //       else if(telefono.length <8 ){
   //         alert("El campo telefono es pequeño");
   //     }
   // }

   //  function validarCorreo(correo){
   //      if(correo.includes('@')){
   //          return true;
   //      }else{
   //          return false;
   //      }
   //  }

</script>