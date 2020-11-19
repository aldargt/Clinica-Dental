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
        <select class="fecha"  name="fecha" >
          	<option disabled selected> Seleccione una fecha</option>
        </select></br>

        <label for="fecha">HORA:</label>
        <select class="cajas"  required=""  name="hora">
          	<option disabled selected>Seleccione un horario</option>
            <option value="8.00">08:00</option>
            <option value="8.25">08:15</option>
            <option value="8.50">08:30</option>
            <option value="8.75">08:45</option>
            <option value="9.00">09:00</option>
            <option value="9.25">09:15</option>
            <option value="9.50">09:30</option>
            <option value="9.75">09:45</option>
            <option value="10.00">10:00</option>
            <option value="10.25">10:15</option>
            <option value="10.50">10:30</option>
            <option value="10.75">10:45</option>
            <option value="11.00">11:00</option>
            <option value="11.25">11:15</option>
            <option value="11.50">11:30</option>
            <option value="11.75">11:45</option>
            <option value="14.00">14:00</option>
            <option value="14.25">14:15</option>
            <option value="14.50">14:30</option>
            <option value="14.75">14:45</option>
            <option value="15.00">15:00</option>
            <option value="15.25">15:15</option>
            <option value="15.50">15:30</option>
            <option value="15.75">15:45</option>
            <option value="16.00">16:00</option>
            <option value="16.25">16:15</option>
            <option value="16.50">16:30</option>
            <option value="16.75">16:45</option>
            <option value="17.00">17:00</option>
            <option value="17.25">17:15</option>
            <option value="17.50">17:30</option>
            <option value="17.75">17:45</option>
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