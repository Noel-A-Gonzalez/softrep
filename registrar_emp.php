<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>
<?php 
include("conexion.php"); 

// Recibimos por POST los datos procedentes del formulario
$dni=$_POST['dni'];
$email=$_POST['email'];
$apellido = $_POST['apellido']; 
$nombre= $_POST["nombre"];
$tel= $_POST['tel'];
$password=$_POST['pass'];
$tipo_usuario=2;

$result=mysqli_query($con,"SELECT * FROM usuarios WHERE dni=$dni");
	if ($row = mysqli_fetch_row($result)){ 
		echo "<script type='text/javascript'>alert('Usuario ya existe'); window.location='admin_usuarios.php';</script>";
	}else

	$sql=mysqli_query($con,"INSERT INTO usuarios (dni,apellido,nombre,tel,email,pass,tipo_usuario) 
				VALUES ('$dni', '$apellido', '$nombre', '$tel', '$email', '$password','$tipo_usuario')");  

		if (! $sql){
			die ('ERROR AL INSERTAR USUARIO'. mysqli_error($con));
		}
			
			else{
				echo "<script type='text/javascript'>alert('Se agregó un nuevo empleado'); window.location='consulta_emp.php';</script>";
			}

// Cerramos la conexion a la base de datos 
mysqli_close($con); 

// Confirmamos que el registro ha sido insertado con exito 

?>  