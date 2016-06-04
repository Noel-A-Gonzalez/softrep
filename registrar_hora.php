<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>
<?php 

include("conexion.php"); 

$hora = $_POST['hora']; 

$result=mysqli_query($con,"SELECT * FROM horas WHERE hora='$hora'");
	if ($row = mysqli_fetch_row($result)){ 
		echo "<script type='text/javascript'>alert('Horario ya existe'); window.location='admin_horas.php';</script>";
	}else

	$sql=mysqli_query($con,"INSERT INTO horas (hora) VALUES ('$hora')");
		if (! $sql){
			die ('ERROR AL INSERTAR LA HORA'. mysqli_error($con));
		}
			else{
				echo "<script type='text/javascript'>alert('Se agregó un nuevo horario'); window.location='admin_horas.php';</script>";
			}

mysqli_close($con); 

?>