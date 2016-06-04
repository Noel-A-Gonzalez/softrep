<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>
<?php 

include("conexion.php"); 

// Recibimos por POST los datos procedentes del formulario 
$destino = $_POST['destino']; 
$salida= $_POST['salida'];

$result=mysqli_query($con,"SELECT * FROM destinos WHERE descripcion='$destino'");
	if ($row = mysqli_fetch_row($result)){ 
		echo "<script type='text/javascript'>alert('Destino ya existe'); window.location='admin_destinos.php';</script>";
	}else

		$sql=mysqli_query($con,"INSERT INTO destinos (descripcion, salida) VALUES ('$destino', '$salida')");
			if (! $sql){
				die ('ERROR AL INSERTAR DESTINO'. mysqli_error($con));
			}
			else{
				echo "<script type='text/javascript'>alert('Se agregó un nuevo destino'); window.location='admin_destinos.php';</script>";
			}


// Cerramos la conexion a la base de datos 
mysqli_close($con); 

// Confirmamos que el registro ha sido insertado con exito


?>