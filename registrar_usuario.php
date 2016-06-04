<?php 
include("conexion.php"); 

// Recibimos por POST los datos procedentes del formulario
$dni=$_POST['dni'];
$email=$_POST['email'];
$apellido = $_POST['apellido']; 
$nombre= $_POST["nombre"];
$tel= $_POST['tel'];
$password=$_POST['pass'];

$result=mysqli_query($con,"SELECT * FROM usuarios WHERE dni=$dni");
	if ($row = mysqli_fetch_row($result)){ 
		echo "<script type='text/javascript'>alert('Usuario ya existe'); window.location='admin_usuarios.php';</script>";
	}else
	
	$sql=mysqli_query($con,"INSERT INTO usuarios (dni,apellido,nombre,tel,email,pass) VALUES ('$dni', '$apellido', '$nombre', '$tel', '$email', '$password',3)");

		if (! $sql){
			die ('ERROR AL INSERTAR USUARIO'. mysqli_error($con));
		}
		else{
			echo "<script type='text/javascript'>alert('Se agregó un nuevo usuario'); window.location='inicio.php';</script>";
		}  

// Cerramos la conexion a la base de datos 
mysqli_close($con); 

// Confirmamos que el registro ha sido insertado con exito 

?>  