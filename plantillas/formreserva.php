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
      <form enctype="multipart/form-data" method="post" action="registrarCita.php">
        <h2>Reserva tu Cita</h2>
        <h5>Todos los campos son obligatorios.</h5>
        <label for="nombre">NOMBRE:</label>
        <input type="text" placeholder="Ingrese Nombre" name="nombre" required="" pattern="\S+[a-zA-ZñÑ ]{4,255}" id="nombre" class="cajas"></br>
      
        <label for="apellidos">APELLIDOS:</label>
        <input type="text" placeholder="Ingrese Apellidos" name="apellido" required="" pattern="\S+[a-zA-ZñÑ ]{4,255}" id="apellidos" class="cajas"></br>
  
        <label for="email">CORREO ELECTRONICO:</label>
        <input type="email" placeholder="Ingrese Correo Electronico" required="" name="email" id="email" class="cajas">       </br>
  
        <label for="telefono">TELEFONO:</label>
        <input type="text" placeholder="Ingrese Telefono" name="telefono" required="" pattern="[0-9]+" maxlength="8" id="telefono" class="cajas"></br>
        
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