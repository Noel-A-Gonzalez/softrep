<?php 

include("conexion.php"); 

$dni=$_GET['dni'];


		$sql=mysqli_query($con, "DELETE FROM usuarios WHERE dni='".$dni."'");

		if (! $sql){
			die ('ERROR'. mysqli_error($con));
		
		}else{
			echo "<script type='text/javascript'>alert('Se ha eliminado un cliente'); window.location='consulta_clientes.php';</script>";
		}	

mysqli_close($con); 

?>