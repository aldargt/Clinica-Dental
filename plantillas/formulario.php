<!DOCTYPE html>
<html>
<head>
	<title>Registro de Tratamiento</title>
	<meta charset="utf-8">
	<link rel="icon" type="image/ico" href="../estaticos/img/dienteN.ico">
	<link rel="stylesheet" type="text/css" href="../estaticos/css/formulario.css">
	<link rel="stylesheet" href="../estaticos/css/bootstrap/bootstrap.min.css">
</head>
<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../">ClinicaDent</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    </button>
  </nav>
</header>

    <form method="post" enctype="multipart/form-data" onsubmit="rellenar()">
		<h1>Registro de Tratamiento</h1>
		<h6>Los campos marcados con * son obligatorios.</h6>
		<h4>TITULO DEL TRATAMIENTO *</h4>
		<input type="text" name="titulo" placeholder="Ingrese el Tratamiento" required="" pattern="\S+[a-zA-ZñÑ ]{4,255}" title="revise en [?]">
		<h4>SUBIR IMAGEN *</h4>
		<input type="file" name="imagen" accept="image/png,.jpg,.bmp,.jpeg" required>
		<h4>DURACION DE TRATAMIENTO *</h4>
		<div class="duracionTratamiento">
			<label>Horas: </label>
			<select name="hora">
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select> 
			<label>Minutos: </label>
			<select name="minuto">
				<option value="0">0</option>
				<option value="15">15</option>
				<option value="30">30</option>
				<option value="45">45</option>
			</select>
		</div>
		<h4>DESCRIPCION *</h4>
		<textarea name="descripcion" rows="10" cols="60" placeholder="Ingrese el Tratamiento" required></textarea>
		<input type="submit" value="Registrar Tratamiento" name="boton1">
		<input type="button" name="boton2" 
		onclick='if(confirm("Todos los datos se perderán ¿Desea continuar?")) 
		location.href="homeAdministrador.html"' 
		value="Cancelar"/>
	</form>
    <?php 
        include("registrar.php");
	?>

	<script src="../estaticos/js/bootstrap/jquery.js"></script>
	<script src="../estaticos/js/formulario.js"></script>
    <script src="../estaticos/js/bootstrap/bootstrap.min.js"></script>
    <script src="../estaticos/js/bootstrap/index.js"></script>

</body>
</html>