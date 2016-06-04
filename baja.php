<?php 
    session_start();

include("conexion.php"); 

$id_reserva=$_GET['id_reserva'];
$id_destino1=$_GET['id_destino'];
$id_fecha1=$_GET['id_fecha'];
$id_hora1=$_GET['id_hora'];
$cant_pasajes = 0;

$result=mysqli_query($con,"SELECT cant_pasajes FROM dest_fecha_hora WHERE id_destino=$id_destino1 AND id_fecha=$id_fecha1 AND id_hora=$id_hora1");
		if ($row = mysqli_fetch_row($result)){ 
			$cant_pasajes = $row[0];
		}

	$sql=mysqli_query($con, "UPDATE dest_fecha_hora SET cant_pasajes ='$cant_pasajes' + 1 WHERE id_destino='$id_destino1' AND id_fecha='$id_fecha1' AND id_hora='$id_hora1'");
		if (! $sql){
			die ('ERROR'. mysqli_error($con));
		}			

	$sql=mysqli_query($con, "DELETE FROM reservas WHERE id_reserva='".$id_reserva."'");
		if (! $sql){
			die ('ERROR'. mysqli_error($con));
		}			
		else{	
			echo "<script type='text/javascript'>alert('Se ha eliminado una reserva'); window.location='mis_reservas.php';</script>";
		}

mysqli_close($con); 

?>