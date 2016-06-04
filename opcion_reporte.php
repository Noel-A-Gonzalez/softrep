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
    <title>Reportes</title> 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">   
  </head>

  <body>
    <?php include("cabecera.html"); ?>

   <div class="container" style="margin-top:20px;">
          <div class="row">
            <div class="panel panel-info">
              <div class="panel-heading"><center><strong></strong></center></div>       
                <div class="panel-body"> 
                  <ul class="nav nav-tabs nav-justified">
                    <li><a href="consultar_destinos_emp.php"> <i style="margin-right: 6px" class="fa fa-bus fa-lg"></i> <big><strong>  Consultar Destino</strong></big></a></li>
                    <li><a href="consultar_reservas.php"> <i style="margin-right: 6px" class="fa fa-list-alt fa-lg"></i><big><strong>  Reservas</strong></big></a></li>
                    <li><a href="opcion_reporte.php"> <i style="margin-right: 6px" class="fa fa-area-chart" aria-hidden="true"></i>
<big><strong>  Reportes</strong></big></a></li>           
           
                  </ul>
          
          
          <div style="padding:30px;"></div>

            <center><a href="filtro_consulta.php"><button type="button" class="btn btn-primary btn-lg">Reservas por destinos</button></a>
              <span style="margin-left:12px;"></span>
            <a href="filtro_reporte2.php"><button type="button" class="btn btn-primary btn-lg">Reservas por mes</button></a></center> 

             <div style="padding:30px;"></div>          
      </div>

    </div>

  </div>
  </div>
  
  
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script> 
       
  </body>


</html>