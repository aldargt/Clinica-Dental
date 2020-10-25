<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

		$id = $_GET["id"];

		include("con_db.php");
		$query = "select * from clinicadental_tratamientos where id=" . $id;
		$resultset = pg_query($conex, $query);
		pg_close($conex);

		$tratamiento = pg_fetch_assoc($resultset);
	?>

		<label>titulo:</label> <?php echo $tratamiento["titulo"] ?>
		<img src='../multimedia/<?php echo $tratamiento["imagen"] ?>'><br>
		<label>descripcion:</label> <?php echo $tratamiento["descripcion"] ?><br>
		<br><br>


</body>
</html>