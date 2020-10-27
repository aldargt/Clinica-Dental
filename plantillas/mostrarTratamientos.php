<!DOCTYPE html>
<html>
<head>
	<title>Tratamientos</title>
</head>
<body>

	<h1>Tratamientos</h1>

	<?php 
		include("con_db.php");
		$query = "select * from clinicadental_tratamientos";
		$resultset = pg_query($conex, $query);
		pg_close($conex);

		while($tupla = pg_fetch_assoc($resultset)){
			
			echo "<img src='../multimedia/". $tupla["imagen"] . "'><br>";
			echo "<h2>".$tupla["titulo"]."</h2>";

			echo $tupla["descripcion"];
		}
	?>

</body>
</html>