<!DOCTYPE html>
<html>
<head>
	<title>Reservacion de Cita</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../estaticos/css/formreserva.css">
</head>
<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../">ClinicaDent</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    </button>
  </nav>
</header>

<div class="main">
    <div class="container">
      <form enctype="multipart/form-data" method="post" action="registrarCita.php" onsubmit="return validar();">
        <h2>Reserva tu Cita</h2>
        <h5>Todos los campos son obligatorios.</h5>
        <label for="nombre">NOMBRE:</label>
        <input type="text" placeholder="Ingrese Nombre"   maxlength="50"    name="nombre"  id="nombre" class="cajas"></br>
      
        <label for="apellidos">APELLIDOS:</label>
        <input type="text" placeholder="Ingrese Apellidos" name="apellido" maxlength="50"   id="apellidos" class="cajas"></br>
  
        <label for="email">CORREO ELECTRONICO:</label>
        <input type="text" placeholder="Ingrese Correo Electronico" name="email" id="email" class="cajas">       </br>
  
        <label for="telefono">TELEFONO:</label>
        <input type="text" placeholder="Ingrese Telefono" name="telefono" maxlength="12" id="telefono" class="cajas"></br>
        
        <label for="tipo">TIPO DE TRATAMIENTO:</label>
        <select id="estadia"  required="" class="cajas" name="tratamiento">
          <option disabled selected>Seleccione su tipo de Tratamiento</option>
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
        
        <label for="fecha">FECHA:</label>
        <select class="fecha"  name="fecha" id="fecha">
          	<option disabled selected> Seleccione una fecha</option>
        </select></br>

        <label for="hora">HORA:</label>
        <select class="cajas"  required=""  name="hora" id="hora">
          	<option disabled selected>Seleccione un horario</option>
        </select></br>

        <input type="button" name="boton2" onclick='if(confirm("¿Esta seguro que quiere abandonar la pagina de reservas de citas?")) location.href="homeAdministrador.html"'value="Cancelar" class="btn">
        <input type="submit" value="RESERVAR CITA" name="submit" class="btn">
  
  	</form>
  	<script src="../estaticos/js/jquery-3.5.1.min.js"></script>
	<script src="../estaticos/js/formreserva.js"></script>   
  
    </div>
  </div>
</body>
</html>

[12:12, 24/11/2020] Alvaro.informatica: <script>
   function validar(){
       var nombre, apellidos, email, telefono;
       nombre= document.getElementById("nombre").value;
       apellidos= document.getElementById("apellidos").value;
       email= document.getElementById("email").value;
       telefono= document.getElementById("telefono").value;
       console.log(nombre );
       if(nombre === "" || apellidos === "" || email === "" || telefono === ""){
           alert("Todos los campos son Obligatorio");
       }
       else if(nombre.length > 48){
           alert("El campo nombre es muy grande");
       }
       else if(apellidos.length > 48){
           alert("El campo apellido es muy grande");
       }
       else if(!isNaN(nombre)){
           alert("En  campo nombre solo acepta letras");
       }
       else if(!isNaN(apellidos)){
           alert("El campo apellidos solo acepta letras");
       }
       else if(isNaN(telefono)){
           alert("El  campo telfono solo acepta numero");
       }
       else if(!validarCorreo(email)){
           alert("El campo email no es valido");
       }
         else if(telefono.length <8 ){
           alert("El campo telefono es pequeño");
       }
   }

    function validarCorreo(correo){
        if(correo.includes('@')){
            return true;
        }else{
            return false;
        }
    }

</script>