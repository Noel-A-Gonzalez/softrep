<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>
<?php 

include("conexion.php"); 

$fecha = $_POST['fecha']; 

$result=mysqli_query($con,"SELECT * FROM fechas WHERE fecha='$fecha'");
	if ($row = mysqli_fetch_row($result)){ 
		echo "<script type='text/javascript'>alert('Fecha ya existe'); window.location='admin_fechas.php';</script>";
	}else
	$sql=mysqli_query($con,"INSERT INTO fechas (fecha) VALUES ('$fecha')");
		if (! $sql){
			die ('ERROR AL INSERTAR LA FECHA'. mysqli_error($con));
		}
			else{
				echo "<script type='text/javascript'>alert('Se agregó una nueva fecha'); window.location='admin_fechas.php';</script>";
			}

mysqli_close($con); 

?>