<!DOCTYPE html>
<html>
<head>
	<title>Registro de Tratamiento</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../estaticos/css/estilo.css">
</head>
<body>
    <form method="post">
		<h1>Registro de Tratamiento</h1>
		<h5>Los campos marcados con * son obligatorios.</h5>
		<h3>TITULO DEL TRATAMIENTO *</h3>
		<input type="text" name="titulo" placeholder="Ingrese el Tratamiento">
		<h3>SUBIR IMAGEN *</h3>
		<input type="file" name="imagen" accept="image/png,.jpg,.bmp,.jpeg">
		<h3>DESCRIPCION *</h3>
		<textarea name="descripcion" rows="10" cols="60" placeholder="Ingrese el Tratamiento"></textarea>
		<input type="submit" value="Registrar Tratamiento" name="boton1">
		<input type="reset" value="Cancelar" name="boton2">
	</form>
        <?php 
        include("registrar.php");
        ?>
</body>
</html>