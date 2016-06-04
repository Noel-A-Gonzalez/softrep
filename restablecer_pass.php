<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
	
include("conexion.php");

$email=$_POST['email'];  
$passnueva= $_POST['passnueva'];
$passrep= $_POST['passrep'];

$result=mysqli_query($con,"SELECT * FROM usuarios WHERE email='$email'");
  if ($row = mysqli_fetch_row($result)){

    if($passnueva==$passrep){
 
      $sql=mysqli_query($con, "UPDATE usuarios SET pass = '$passnueva' WHERE email='$email'");
            
            echo "<script type='text/javascript'>alert('Contraseña modificada exitosamente'); window.location='index.php';</script>"; 

    }
      else{
            echo "<script type='text/javascript'>alert('La nueva contraseña y la repeticion no coinciden');window.location='cambiar_pass.php'</script>";
        
      }			   
  }
    else{
        echo "<script type='text/javascript'>alert('Usuario no existe'); window.location='index.php';</script>";

    }
	
mysqli_close($con);

?>