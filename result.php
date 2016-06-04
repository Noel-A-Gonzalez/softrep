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

			$destino= $_POST['destino'];
      $año= $_POST['año'];

      $result1=mysqli_query($con,"SELECT * from destinos WHERE id_destino=$destino");
            if ($row = mysqli_fetch_row($result1)){
              $destinodesc=$row[1];
            }

            
			
				$result = mysqli_query($con,"SELECT d.descripcion, MONTHNAME(f.fecha) AS Mes, COUNT(r.id_reserva) AS 'Cantidad reservas' FROM reservas r INNER JOIN destinos d ON r.id_destino=d.id_destino INNER JOIN fechas f ON r.id_fecha=f.id_fecha WHERE d.id_destino = $destino AND f.fecha LIKE '$año%' GROUP BY MONTH(f.fecha)" );

        if ($row = mysqli_fetch_row($result)){ 
        echo "
          
          <div class='col-md-4 col-md-offset-4'>                                   
          
          <center><b>Destino: $destinodesc <span style='margin-left:8px;''></span> Año: $año </b></center>
          <div style='padding:5px'></div>
          <table id='datos' class='table table-striped table-bordered' cellspacing='0' width='100%'>  <thead>
                <tr>                                                                                    
                  <th>Mes</th>
                  <th class='text-center'>Cantidad reservas</th>                                                    
                </tr>
              </thead>

              <tbody>

              <tr>";

            include "libchart/classes/libchart.php";

            $chart = new VerticalBarChart(500, 250);

            $dataSet = new XYDataSet();

            $con->query("SET lc_time_names = 'es_AR'");

            $result2 = "SELECT d.descripcion, MONTHNAME(f.fecha) AS Mes, COUNT(r.id_reserva) AS 'Cantidad reservas' FROM reservas r INNER JOIN destinos d ON r.id_destino=d.id_destino INNER JOIN fechas f ON r.id_fecha=f.id_fecha WHERE d.id_destino = $destino AND f.fecha LIKE '$año%' GROUP BY MONTH(f.fecha)";


            if ($resultado = $con->query($result2)) {    
                  while ($row = $resultado->fetch_assoc()) {

                      $mes=$row["Mes"];
                      $cantidad=$row["Cantidad reservas"];

                           
                          echo "<td>"; echo $row["Mes"]; echo "</td>";                        
                          echo "<td class='text-center'>"; echo $row["Cantidad reservas"]; echo "</td>";
                                  
                      echo "</tr>";

                      $dataSet->addPoint(new Point("$mes", $cantidad));
                      }
                    }
                      
              echo" 
                  </tbody>
              </table>
            </div>";

          $chart->setDataSet($dataSet);
          $chart->setTitle('Cantidad de reservas por mes');
          $chart->render('libchart/generated/grafico.png'); 

          echo"   
                <center><img src='libchart/generated/grafico.png'/></center>
                <center><a href='reporte_meses.php?destino=$destino&año=$año' target='_blank'>Descargar</a></center>";
      
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