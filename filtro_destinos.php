<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Consultar Destinos</title>
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
                <li class="active"><a href="consultar_destinos.php"> <i style="margin-right: 6px" class="fa fa-bus fa-lg"></i><big><strong>  Consultar Destino</strong> </big></a></li>
                <li><a href="mis_reservas.php"> <i style="margin-right: 6px" class="fa fa-list-alt fa-lg"></i><big><strong>  Mis Reservas</strong> </big></a></li>           
              </ul>         
                
                <div style="padding:25px;"></div>

<?php 
include("conexion.php"); 

// Recibimos por POST los datos procedentes del formulario 
$destino= $_POST['destino'];
$fecha= $_POST["fecha"];
      
      $consulta="SELECT f.fecha, d.descripcion,h.hora,d.salida FROM destinos d INNER JOIN dest_fecha_hora a ON d.id_destino=a.id_destino INNER JOIN fechas f ON a.id_fecha=f.id_fecha INNER JOIN horas h ON h.id_hora = a.id_hora WHERE d.id_destino=$destino AND f.id_fecha=$fecha ORDER BY hora ASC";
				 
			echo "<table class='table table-striped table-bordered' cellspacing='0' width='100%'>            
                      <thead>
                        <tr>
                          <th>Destino</th>                          
                          <th>Fecha</th>
                          <th>Horario</th>
                          <th>Lugar de Salida</th>                                                    
                        </tr>
                      </thead>
            
            <tbody>

			<tr>";
			if ($resultado = $con->query($consulta)) {    
                while ($row = $resultado->fetch_assoc()) {
                  $fechaBase = date_create($row["fecha"]);
                  $fecha = date_format($fechaBase, 'd-m-Y');
                              echo "<td>";echo $row["descripcion"];echo "</td>";                    
                              echo "<td>";echo $fecha;echo "</td>";
                              echo "<td>";echo $row["hora"];echo " hs";;echo "</td>";
                              echo "<td>";echo $row["salida"];echo "</td>";
                            echo "</tr>";
                          }                                               		
		  }
		  echo "</tbody>";
		echo "</table> ";

mysqli_close($con); 

// Confirmamos que el registro ha sido insertado con exito 

?>

                            
    <center><input id="btn-volver" class="btn" type="button" onclick="location.href='consultar_destinos.php'" value='Volver'></center>
                         
      </div>
    </div>
  </div>
</div>
	   
     <script src="js/jquery.js"></script>
  	 <script src="js/bootstrap.min.js"></script>
    
  </body>
  
</html>