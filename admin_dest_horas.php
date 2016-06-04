<?php
  require_once('conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery.min.js"></script>
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Asignar Fecha - Horario</title> 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"> 
    <link href="css/style.css" rel="stylesheet" media="screen">

        <script type="text/javascript">
        function numeros(e){
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " 0123456789";
            especiales = [8,37,39,46];
            tecla_especial = false
                for(var i in especiales){
                    if(key == especiales[i]){
                        tecla_especial = true;
                        break;
                    } 
                }
 
            if(letras.indexOf(tecla)==-1 && !tecla_especial){
                return false;
            }
        }
    </script>

    <script type="text/javascript">
    function eliminar(valor){
      if (!confirm("¿Realmente desea eliminar?")) {
        return false;
        
        }else {
          location.href = "baja_dest_hora.php?id_dfh="+valor+"";
          return true;
        }
      }
    </script> 

<script type="text/javascript">
function validacion(){
    indice = document.getElementById("hora").selectedIndex;
    if( indice == null || indice == 0 ) {
      alert("Debe seleccionar todos los campos")
    return false;
    }
}
 </script>
 

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
                <li class="active"><a href="admin_dest_horas.php"><strong>Asignar Fecha - Horario</strong></a></li>
                <li><a href="admin_destinos.php"><strong>Administrar Destinos</strong></a></li>
                <li><a href="admin_fechas.php"><strong>Administrar Fechas</strong></a></li>
                <li><a href="admin_horas.php"><strong>Administrar Horarios</strong></a></li>
              </ul>
          
              <div class="col-md-10 col-md-offset-1">
                <div style="padding:15px;"></div> 
                <div class='col-md-4 col-md-offset-9'>
                    <div class="input-group pull-right">
                      <input type="text" id="searchInput" class="form-control" onkeyup="doSearch()" placeholder="Buscar..." name="  buscar">
                        <div class="input-group-btn" >
                          <button class="btn btn-default" type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                  </div>          
                  
                  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#nuevo_desthora">Nuevo</button>
                                
                  

      <div class="modal fade" id="nuevo_desthora">
          <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Asignar Fecha - Horario</h4>
        </div>
        <div class="modal-body">

            <form id="form" class="form-horizontal" role="form" method="POST" action="registrar_desthoras.php" onsubmit="return validacion()">                                 
                <div class="form-group col-md-9">
                  <label for="destino">Destino *</label>
                    <select class="form-control" name="destino" id="destino">
                      <option value="0">- Seleccione destino -</option>
                        <?php
                          $query = 'SELECT * FROM destinos ORDER BY descripcion ASC';
                          $result = mysqli_query($con, $query);
                              while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
                                echo '<option value="' .$row["id_destino"]. '">' .$row["descripcion"]. '</option>';
                              }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-9">
                  <label for="fecha">Fecha *</label>
                    <select class="form-control" name="fecha" id="fecha">
                      <option value="0">- Seleccione fecha -</option>
                        <?php
                        $fechactual= date("Y/m/d H:i:s");

                          $query = 'SELECT * FROM fechas WHERE fecha > "'.$fechactual.'" ORDER BY fecha ASC';
                          $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
                              $fechaBase = date_create($row["fecha"]);
                              $fecha = date_format($fechaBase, 'd-m-Y');
                              echo '<option value="' .$row["id_fecha"]. '">' .$fecha. '</option>';
                            }
                        ?>
                    </select>
                </div> 

                <div class="form-group col-md-9">
                  <label for="hora">Horario *</label>
                    <select class="form-control" name="hora" id="hora">
                      <option value="0">- Seleccione hora -</option>
                        <?php
                          $query = 'SELECT * FROM horas ORDER BY hora ASC';
                          $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
                              echo '<option value="' .$row["id_hora"]. '">' .$row["hora"]. ' hs</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-9">
                <label for="pasajes">Cantidad de Pasajes *</label>
                <input name="pasajes" type="text" class="form-control" placeholder="Cantidad pasajes" onkeypress="return numeros(event)" required> 
              </div>             
                            
              <div class="form-group">                                   
               
              </div>
           
        

              <div class="form-group">
                <div class="col-md-offset-7 col-md-9" style="margin-top:15px;"> 
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>  Aceptar</button>
                <span style="margin-left:8px;"></span>
                <input id="btn-cerrar" type="button" class="btn" value="Cerrar" onclick="location.href='admin_dest_horas.php'">
              </div>
              </div>
          
        </form> 

        </div>
       <div class="panel-footer ">(*) Campos obligatorios</div>

     
      </div>
    </div>
  </div>

                    
             <div style="padding:5px;"></div>       
              <div class="col-md-13">               
                  <table id ="datos" class="table table-striped table-bordered" cellspacing="0" width="100%">            
                    <thead>
                      <tr >
                        <th>Destino</th>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Pasajes</th>
                     </tr>
                    </thead>
            
                    <tbody>              
                    <?php
                    $con = mysql_connect("localhost","root","") or die (mysql_error());
                    mysql_select_db("softrep",$con);
                    $_pagi_sql ="SELECT DISTINCT  a.id_dfh,f.fecha, d.descripcion,h.hora,a.cant_pasajes FROM destinos d INNER JOIN dest_fecha_hora a ON d.id_destino=a.id_destino INNER JOIN fechas f ON a.id_fecha=f.id_fecha INNER JOIN horas h ON h.id_hora = a.id_hora ORDER BY d.descripcion,f.fecha ASC";
                    $_pagi_cuantos = 20;
                    $_pagi_htaccess = 0;
              
                    include("paginator.php");
                                                       
                    
                      while($fila = mysql_fetch_array($_pagi_result)){
                        $fechaBase = date_create($fila["fecha"]);
                        $fecha = date_format($fechaBase, 'd-m-Y');
                                                                           
                        echo "<tr>";
                          echo "<td>";echo $fila['descripcion'];echo "</td>";
                          echo "<td>";echo $fecha; echo "</td>";                     
                          echo "<td>";echo $fila['hora'];echo " hs";echo "</td>";
                          echo "<td>";echo $fila['cant_pasajes'];echo "</td>";                           
                          echo "<td>";$id = $fila['id_dfh'];
                          echo "<a onclick='eliminar($id);'> <button class='btn btn-danger btn-xs glyphicon glyphicon-trash'> ELIMINAR</button></a>"; echo "</td>";
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
 

 


  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>       
  </body>

</html>