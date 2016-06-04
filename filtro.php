<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Reporte</title> 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">   
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
                    <li><a href="consultar_reservas.php"> <i style="margin-right: 6px" class="fa fa-list-alt fa-lg"></i> <big><strong> Reservas</strong></big></a></li>
                    <li class="active"> <a href="opcion_reporte.php"> <i style="margin-right: 6px" class="fa fa-area-chart" aria-hidden="true"></i>
<big><strong>  Reportes</strong></big></a></li>

                    <div style="padding:25px;"></div>     

		<?php
			include("conexion.php");

			$mes= $_POST['mes'];
      $año= $_POST['año'];

			
				$result = mysqli_query($con,"SELECT d.descripcion, COUNT(r.id_reserva) AS 'Cantidad reservas' FROM reservas r INNER JOIN destinos d ON r.id_destino=d.id_destino INNER JOIN fechas f ON r.id_fecha=f.id_fecha WHERE f.fecha LIKE '$año-$mes%' GROUP BY d.descripcion");

        if ($row = mysqli_fetch_row($result)){
          if ($mes=='01') {
            $descripmes='ENERO';
            }elseif ($mes=='02') {
              $descripmes='FEBRERO';
            }elseif ($mes=='03') {
              $descripmes='MARZO';
            }elseif ($mes=='04') {
              $descripmes='ABRIL';
            }elseif ($mes=='05') {
              $descripmes='MAYO';
            }elseif ($mes=='06') {
              $descripmes='JUNIO';
            }elseif ($mes=='07') {
              $descripmes='JULIO';
            }elseif ($mes=='08') {
              $descripmes='AGOSTO';
            }elseif ($mes=='09') {
              $descripmes='SEPTIEMBRE';
            }elseif ($mes=='10') {
              $descripmes='OCTUBRE';
            }elseif ($mes=='11') {
              $descripmes='NOVIEMBRE';
            }elseif ($mes=='12') {
              $descripmes='DICIEMBRE';
            }

            echo "
          
          <div class='col-md-4 col-md-offset-4'>                                   
          
          <center><b>Mes: $descripmes <span style='margin-left:8px;''></span>  Año: $año </b></center>
          <div style='padding:5px'></div>
          <table id='datos' class='table table-striped table-bordered' cellspacing='0'>  <thead>
                <tr> 
                  <th>Destino</th>
                                                                                 
                  <th class='text-center'>Cantidad reservas</th>                                                    
                </tr>
              </thead>

              <tbody>

              <tr>";

            include "libchart/classes/libchart.php";

            $chart = new VerticalBarChart(500, 250);

            $dataSet = new XYDataSet();

            $result2 = "SELECT d.descripcion, f.fecha, COUNT(r.id_reserva) AS 'Cantidad reservas' FROM reservas r INNER JOIN destinos d ON r.id_destino=d.id_destino INNER JOIN fechas f ON r.id_fecha=f.id_fecha WHERE f.fecha LIKE '$año-$mes%' GROUP BY d.descripcion";

            if ($resultado = $con->query($result2)) {    
                  while ($row = $resultado->fetch_assoc()) {
                      
                      $destino=$row["descripcion"];
                      $cantidad=$row["Cantidad reservas"];
                          
                          echo "<td>";echo $row["descripcion"];echo "</td>";                        
                          echo "<td class='text-center'>";echo $row["Cantidad reservas"];echo "</td>";
                                  
                      echo "</tr>";

                      $dataSet->addPoint(new Point("$destino", $cantidad));
                      }
                    }
                      
              echo" 
                  </tbody>
              </table>
            </div>";

          $chart->setDataSet($dataSet);
          $chart->setTitle('Cantidad de reservas por destino');
          $chart->render('libchart/generated/grafico.png'); 

          echo"   
                <center><img src='libchart/generated/grafico.png'/></center>  

                <center><a href='reporte.php?mes=$mes&año=$año' target='_blank'>Descargar</a></center>";
          } 
            else{
                echo "<center>"; echo" No hay resultados"; echo"</center>";
        }
            
      mysqli_close($con); 
      ?>

          </div>
        </div>
      </div>
    </div>           				
		
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>