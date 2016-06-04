<?php
	session_start();

include("conexion.php"); 
 
$apellido = $_POST['apellido']; 
$nombre= $_POST['nombre'];
$tel= $_POST['tel'];
$email = $_POST['email'];
 
$sql=mysqli_query($con, "UPDATE usuarios SET apellido = '$apellido', nombre = '$nombre', tel = '$tel', email = '$email' WHERE dni = ".$_SESSION['username']."");
	
	if (! $sql){
			die ('ERROR'. mysqli_error($con));

	}else{
	
		echo "<script type='text/javascript'>alert('Datos actualizados exitosamente'); window.location='perfil.php';</script>";
	}

mysqli_close($con);

?>