<?php 

include("conexion.php"); 

$id_fecha=$_GET['id_fecha'];


		$sql=mysqli_query($con, "DELETE FROM fechas WHERE id_fecha='".$id_fecha."'");	
		
		if (! $sql){
			die ('ERROR'. mysqli_error($con));

		}else{
			echo "<script type='text/javascript'>alert('Se ha dado de baja una fecha'); window.location='admin_fechas.php';</script>";
		}	

	mysqli_close($con); 

?>