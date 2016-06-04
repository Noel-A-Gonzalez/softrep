<?php 

include("conexion.php"); 


$_SESSION['username']=$_REQUEST['user'];
$_SESSION['pass']=$_REQUEST['pass'];

$abc = $_SESSION['pass'];
    
      $result=mysqli_query($con,"SELECT * FROM usuarios WHERE dni='$_SESSION[username]' AND pass='$_SESSION[pass]'");
          if ($row = mysqli_fetch_row($result)){ 
            session_start();
            $tipo_usuario=$row[6];
                
                  if ($tipo_usuario == 1) {
                    $_SESSION['user'] = $row[2]." ".$row[1];
                    $_SESSION['username'] = $_REQUEST['user'];
                    header("Location:inicio_admin.php");
                  }          
                  elseif ($tipo_usuario == 2) {
                    $_SESSION['user'] = $row[2]." ".$row[1];
                    $_SESSION['username'] = $_REQUEST['user'];
                    header("Location:inicio_emp.php");
                  } 
                  else {
                    $_SESSION['user'] = $row[2]." ".$row[1];
                    $_SESSION['username'] = $_REQUEST['user'];
                    header("Location:inicio.php");                        
                  }
            
          }else {    
            echo "<script type='text/javascript'>alert('Los datos de acceso no son correctos'); window.location='index.php';</script>"; 
          }
          
          
 ?>