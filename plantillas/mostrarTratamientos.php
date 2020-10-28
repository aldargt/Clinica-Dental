<!DOCTYPE html>
<html>
<head>
	<title>Tratamientos</title>
	<link rel="stylesheet" href="../estaticos/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../estaticos/css/mostrarTratamientos.css">
</head>
<body>

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
		   <img src='../multimedia/<?php echo $tratamiento["imagen"] ?>' class="card-img-top" alt="...">
            <div class="card-body">
       			 <h5 class="card-title">
						<?php echo $tratamiento["titulo"] ?>
					</h5>
        	      <p class="card-text">
					  <?php echo $tratamiento["descripcion"]?>
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

</body>
</html>