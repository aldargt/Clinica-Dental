<!DOCTYPE html>
<html>
<head>
	<title>Tratamientos</title>
</head>
<body>

	<h1>Tratamientos</h1>

	<?php 
		include("con_db.php");
		$query = "select id, titulo from clinicadental_tratamientos";
		$resultset = pg_query($conex, $query);
		pg_close($conex);

		while($tupla = pg_fetch_assoc($resultset)){
			echo "<div><a href='mostrar.php?id=" . $tupla["id"] . "'>" . $tupla["titulo"] . "</a></div>";
		}
	?>

</body>
</html>