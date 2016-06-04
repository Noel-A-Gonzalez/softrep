<?php 

include("conexion.php"); 

$id_destino=$_GET['id_destino'];

		$sql=mysqli_query($con, "DELETE FROM destinos WHERE id_destino='".$id_destino."'");	
		if( $sql ) { 
   			echo "<script type='text/javascript'>alert('Se ha eliminado un destino'); window.location='admin_destinos.php';</script>";

		} else { 
   			echo "Has tenido el siguiente error:<br />".mysqli_error($con); 
		}
		
	mysqli_close($con); 

?>