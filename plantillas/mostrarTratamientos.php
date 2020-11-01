<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/ico" href="../estaticos/img/dienteN.ico">
	<title>Tratamientos</title>
	<link rel="stylesheet" href="../estaticos/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../estaticos/css/mostrarTratamientos.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index.html">ClinicaDent</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <!-- <span class="navbar-toggler-icon"></span> -->
            </button>
        </nav>
	<h1>Tratamientos</h1>
	<div class= "tratamientos">

	<?php 
		include("con_db.php");
		$query = "select * from clinicadental_tratamientos";
		$resultset = pg_query($conex, $query);
		pg_close($conex);
		$contador= 1 ;

		while($tratamiento = pg_fetch_assoc($resultset)){
			if ($contador%2 == 1){
				echo "<div class='card-deck'>";
			}
	?>
  	    <div class="card">
		   	<img onerror="this.src='../estaticos/img/default.jpg';" src='../multimedia/<?php echo $tratamiento["imagen"] ?>' class="card-img-top" alt="...">
            <div class="card-body">
       			<h2 class="card-title">
					<?php echo $tratamiento["titulo"] ?>
				</h2>
        	    <p class="card-text">
					<?php echo nl2br($tratamiento["descripcion"]) ?>
				</p>
            </div>
    	</div>
  				
	<?php
			if($contador% 2 ==0){
			echo "</div>";
			}	
			$contador = $contador + 1;
		}
	?>
	</div>

<script src="../estaticos/js/bootstrap/jquery.js"></script>
<script src="../estaticos/js/mostrarTratamientos.js"></script>

</body>
</html>