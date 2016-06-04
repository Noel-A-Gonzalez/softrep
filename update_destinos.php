<?php
	

include("conexion.php"); 

$id_destino=$_GET['id_destino'];
$destino = $_GET['destino']; 
$salida= $_GET['salida'];
 
$sql=mysqli_query($con, "UPDATE destinos SET descripcion = '$destino', salida = '$salida' WHERE id_destino = '".$id_destino."'");

	if(!$sql ) { 
		echo "Has tenido el siguiente error:<br />".mysqli_error($con);

	} else { 
   		echo "<script type='text/javascript'>alert('Datos actualizados exitosamente'); window.location='admin_destinos.php';</script>";

	}

mysqli_close($con);

?>