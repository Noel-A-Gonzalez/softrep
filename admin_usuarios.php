<?php
include("conexion.php"); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Administrar Usuarios</title> 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">   
  </head>

  <body>
    <?php include("cabecera.html"); ?>

    <div class="container" style="margin-top:20px;">
      <div class="row">
        <div class="panel panel-info">
          <div class="panel-heading"><center><strong>Panel Administrador</strong></center></div>
        <div class="panel-body">
         
    
          <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="admin_usuarios.php"><strong>Administrar Usuarios</strong></a></li>
            <li><a href="admin_dest_horas.php"><strong>Asignar Fecha - Horario</strong></a></li>
            <li><a href="admin_destinos.php"><strong>Administrar Destinos</strong></a></li>
            <li><a href="admin_fechas.php"><strong>Administrar Fechas</strong></a></li>
            <li><a href="admin_horas.php"><strong>Administrar Horarios</strong></a></li>            
          </ul>
          
          
          <div style="padding:30px;"></div>
          <center><big>Tipo de Usuario</big></center>           
          <div style="padding:10px;"></div>
            <center><a href="consulta_emp.php"><button type="button" class="btn btn-primary btn-lg">Empleados</button></a>
              <span style="margin-left:12px;"></span>
           <a href="consulta_clientes.php"><button type="button" class="btn btn-primary btn-lg">Clientes</button></a></center>           
      </div>

    </div>

  </div>
  </div>
  
  
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script> 
       
  </body>


</html>