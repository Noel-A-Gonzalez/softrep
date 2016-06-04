<?php
require_once('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Reservas</title>
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
                  <li><a href="consultar_destinos_emp.php"> <i style="margin-right: 6px" class="fa fa-bus fa-lg"></i><big><strong>  Consultar Destino</strong></big></a></li>                  
                  <li class="active"><a href="consultar_reservas.php"> <i style="margin-right: 6px" class="fa fa-list-alt fa-lg"></i><big><strong>  Reservas</strong> </big></a></li>         
                  <li><a href="opcion_reporte.php"> <i style="margin-right: 6px" class="fa fa-area-chart" aria-hidden="true"></i><big><strong>  Reportes</strong></big></a></li>

                </ul>

                <div style="padding:15px"></div>
                <div class='col-md-3 col-md-offset-9'>
                  
                    <div class="input-group pull-right">
                      <input type="text" id="searchInput" class="form-control" onkeyup="doSearch()" placeholder="Buscar..." name="buscar">
                      <div class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
                      </div>
                    </div>
                 </div> 

              <div class="col-md-12" >   
              <div style="padding:5px"></div>                           
              <table id ="datos" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>DNI</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Destino</th>
                    <th>Fecha de Viaje</th>
                    <th>Horario</th>
                    
                  </tr>
                </thead>
                <tbody>              
                
                <?php 
                  $con = mysql_connect("localhost","root","") or die (mysql_error());
                  mysql_select_db("softrep",$con);                                  
                  $_pagi_sql = 'SELECT r.id_reserva, r.dni, d.descripcion, f.fecha, h.hora, r.fecha_reserva, u.apellido, u.nombre FROM destinos d INNER JOIN reservas r ON r.id_destino = d.id_destino INNER JOIN horas h ON r.id_hora = h.id_hora INNER JOIN fechas f ON f.id_fecha = r.id_fecha INNER JOIN usuarios u ON u.dni = r.dni  ORDER BY r.id_reserva ASC';            
                  $_pagi_cuantos = 30;
                  $_pagi_htaccess = 0;

                  include("paginator.php");                   
                  
                  while($fila = mysql_fetch_array($_pagi_result)){

                    $fechaBase = date_create($fila["fecha"]);
                    $fecha = date_format($fechaBase, 'd-m-Y');
                   
                  
                    echo "<tr>";
                      echo "<td>"; echo $fila["id_reserva"]; echo "</td>";
                      echo "<td>"; echo $fila["dni"]; echo "</td>";
                      echo "<td>"; echo $fila["apellido"]; echo "</td>";
                      echo "<td>"; echo $fila["nombre"]; echo "</td>";
                      echo "<td>"; echo $fila["descripcion"]; echo "</td>";
                      echo "<td>"; echo $fecha; echo "</td>";
                      echo "<td>"; echo $fila["hora"]; echo "hs</td>";
                    echo "</tr>";                        
                }
                echo "</tbody>"; 
              echo "</table> "; 
              echo"<center>".$_pagi_navegacion."</center>"; 

              ?>             
        </div>
      </div>
    </div>
  </div>
</div>

  <script language="javascript">
    function doSearch()
    {
      var tableReg = document.getElementById('datos');
      var searchText = document.getElementById('searchInput').value.toLowerCase();
      var cellsOfRow="";
      var found=false;
      var compareWith="";
 
      // Recorremos todas las filas con contenido de la tabla
      for (var i = 1; i < tableReg.rows.length; i++)
      {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        found = false;
        // Recorremos todas las celdas
        for (var j = 0; j < cellsOfRow.length && !found; j++)
        {
          compareWith = cellsOfRow[j].innerHTML.toLowerCase();
          // Buscamos el texto en el contenido de la celda
          if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
          {
            found = true;
          }
        }
        if(found)
        {
          tableReg.rows[i].style.display = '';
        } else {
          // si no ha encontrado ninguna coincidencia, esconde la
          // fila de la tabla
          tableReg.rows[i].style.display = 'none';
        }
      }
    }
  </script> 


    <script type="text/javascript">
      function confirmation() {
        if(confirm("Realmente desea eliminar?"))
        {
        return true;
      }
        return false;
      }
    </script> 


</body>
   
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>        

</html>