<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
	session_start();

include("conexion.php"); 
 
$passactual = $_POST['passactual']; 
$passnueva= $_POST['passnueva'];
$confirmpass= $_POST['confirmpass'];

$result = mysqli_query($con,"SELECT pass FROM usuarios WHERE dni=".$_SESSION['username']."");
  $row=mysqli_fetch_row($result);
  $claveBD=$row[0];
               
       if($passactual!= $claveBD)
        {
        echo "<script type='text/javascript'>alert('Contraseña actual incorrecta'); window.location='cambiar_pass.php';</script>";
        }

        if($passnueva==$confirmpass){
 
			$sql=mysqli_query($con, "UPDATE usuarios SET pass = '$passnueva' WHERE dni = ".$_SESSION['username']."");
        
        	echo "<script type='text/javascript'>alert('Contraseña modificada exitosamente'); window.location='index.php';</script>";

        	}
       		else{
       			echo "<script type='text/javascript'>alert('La nueva contraseña y su repetición no coinciden');window.location='cambiar_pass.php'</script>";
      	
      		}
		
mysqli_close($con);


?>