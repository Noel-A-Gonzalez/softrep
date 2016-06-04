<?php 

include("conexion.php"); 

$id_hora=$_GET['id_hora'];


		$sql=mysqli_query($con, "DELETE FROM horas WHERE id_hora='".$id_hora."'");	
		
		if (! $sql){
			die ('ERROR'. mysqli_error($con));
		
		}else{
			echo "<script type='text/javascript'>alert('Se ha eliminado un horario'); window.location='admin_horas.php';</script>";
		}	

	mysqli_close($con); 

?>