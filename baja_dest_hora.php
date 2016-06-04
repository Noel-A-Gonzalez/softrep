<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>
<?php 

include("conexion.php"); 

$id=$_GET['id_dfh'];

	$sql=mysqli_query($con, "DELETE FROM dest_fecha_hora WHERE id_dfh='".$id."'");

		if (! $sql){
			die ('ERROR'. mysqli_error($con));
		}
			
		else{	
			echo "<script type='text/javascript'>alert('Se ha eliminado una asignación'); window.location='admin_dest_horas.php';</script>";
		}

mysqli_close($con); 

?>