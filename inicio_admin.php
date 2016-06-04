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
    <title>Panel Administrador</title> 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
  </head>

  <body>

    <?php include("cabecera.html"); ?>

    <div class="container" style="margin-top:20px;">
      <div class="row">

        <div class="panel panel-info">
          <div class="panel-heading"><center><strong>Panel Administrador</strong></center></div>
        <div class="panel-body">
         
       
          <ul class="nav nav-tabs nav-justified">
            <li><a href="admin_usuarios.php"><strong>Administrar Usuarios</strong></a></li>
            <li><a href="admin_dest_horas.php"><strong>Asignar Fecha - Horario</strong></a></li>
            <li><a href="admin_destinos.php"><strong>Administrar Destinos</strong></a></li>
            <li><a href="admin_fechas.php"><strong>Administrar Fechas</strong></a></li>
            <li><a href="admin_horas.php"><strong>Administrar Horarios</strong></a></li>           
          </ul>

          <div style="padding:15px;"></div>
                  <h4><p class="well">Bienvenido/a <?php echo $_SESSION['user'];?> al Sistema de Reservas de Pasajes</p></h4>
               
                </div>
            </div>
          </div>
        </div>

        <?php include("pie.html"); ?>  

  </body>
  <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</html>