<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>

<?php 

include("conexion.php"); 

$destino = $_POST['destino'];
$fecha = $_POST['fecha']; 
$hora = $_POST['hora']; 
$cant_pasajes=$_POST['pasajes'];

$result=mysqli_query($con,"SELECT * FROM destinos WHERE id_destino=$destino");
	if ($row = mysqli_fetch_row($result)){
		$destinodesc=$row[1]; 
	}

	$result2=mysqli_query($con,"SELECT * FROM dest_fecha_hora WHERE id_destino='$destino'AND id_fecha=$fecha AND id_hora=$hora");
	if ($row = mysqli_fetch_row($result2)){ 
		echo "<script type='text/javascript'>alert('Asignación ya existe'); window.location='admin_dest_horas.php';</script>";
	}else

		$sql=mysqli_query($con,"INSERT INTO dest_fecha_hora (id_destino,id_fecha, id_hora,cant_pasajes) VALUES ('$destino','$fecha','$hora','$cant_pasajes')");
			
					if (! $sql){die ('ERROR AL INSERTAR'. mysqli_error($con));}
						else{
							echo "<script type='text/javascript'>alert('Se asignó una nueva fecha y horario a  $destinodesc'); window.location='admin_dest_horas.php';</script>";
						}

mysqli_close($con); 

?>