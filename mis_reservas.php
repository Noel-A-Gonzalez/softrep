<?php
require_once('conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery.min.js"></script>
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Mis Reservas</title>
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">

    <script type="text/javascript">
    function validacion(){
    indice = document.getElementById("destino").selectedIndex;
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
          <div class="panel-heading"><center><strong></strong></center></div>
       
            <div class="panel-body">    
              <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="consultar_destinos.php"> <i style="margin-right: 6px" class="fa fa-bus fa-lg"></i> <big><strong>  Consultar Destino</strong></big> 
</a></li>
                <li><a href="mis_reservas.php"> <i style="margin-right: 6px" class="fa fa-list-alt fa-lg"></i><big><strong>  Mis Reservas </strong></big>  
 </a></li>
              </ul>

              <div style="padding:20px;"></div>           

                <center><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#nueva_reserva">Nueva Reserva</button></center>
                
    <div class="modal fade" id="nueva_reserva">
      <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Reserva</h4>
        </div>
        <div class="modal-body">

            <form name="formulario" class="form-horizontal" role="form" method="POST" action="registrar_reserva.php" onsubmit="return validacion()">
              
                <div class="form-group col-md-8">
                    <label for="destino">Destino *</label>
                        <select class="form-control" name="destino" id="destino" onchange="CargarFechas(this.value);" >
                          <option value="0">- Seleccione destino -</option>
                            <?php
                            $fechactual= date("Y/m/d H:i:s");
                            
                              $query = 'SELECT DISTINCT d.descripcion,dfh.id_destino FROM destinos d INNER JOIN dest_fecha_hora dfh ON d.id_destino=dfh.id_destino INNER JOIN fechas f ON f.id_fecha = dfh.id_fecha WHERE f.fecha > "'.$fechactual.'"  ORDER BY descripcion ASC';
                              $result = mysqli_query($con, $query);
                                  while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
                                        echo '<option value="' .$row["id_destino"]. '">' .$row["descripcion"]. '</option>';
                                  }
                            ?>
                        </select>
                  </div>
                
                        <div class="form-group col-md-8">
                          <label for="fecha">Fecha *</label>
                          <select class="form-control" name="fecha" id="fechas" onclick="CargarHoras(this.value, $('#destino').val());";required >
                                <option value="0">- Seleccione fecha -</option>

                          </select> 
                        </div>        
                
                        <div class="form-group col-md-8">
                          <label for="hora">Horario *</label>
                          <select name="hora" class="form-control" id="horas" required>
                            <option value="0">- Seleccione horario -</option>
                          </select>
                        </div>

                        <div class="form-group">                                   
               
                       </div>          
                                       
              <div class="form-group">
                 <div class="col-md-offset-7 col-md-9" style="margin-top:15px;">
                  <button id="btn-aceptar" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>  Aceptar</button>
                  <span style="margin-left:8px;"></span>
                  <input id="btn-cerrar" type="button" class="btn" value="Cerrar" onclick="location.href='mis_reservas.php'">                
                </div>              
              </div>
          
        </form> 
     
      </div>
       <div class="panel-footer ">(*) Campos obligatorios</div>
    </div>
  </div>
  </div>
  <?php

      $result = mysqli_query($con,"SELECT h.id_hora, f.id_fecha, d.id_destino, r.id_reserva, d.descripcion, f.fecha, h.hora as hora, r.fecha_reserva FROM destinos d INNER JOIN reservas r ON r.id_destino = d.id_destino INNER JOIN horas h ON r.id_hora = h.id_hora INNER JOIN fechas f ON f.id_fecha = r.id_fecha WHERE r.dni = '$_SESSION[username]'");
                    if ($row = mysqli_fetch_row($result)){

           echo" <div class='col-md-12' style='padding:20px;'>                      
                  <table id ='horas' class='table table-striped table-bordered' cellspacing='0' width='100%'>            
                    <thead>
                      <tr>
                        <th>Destino</th>
                        <th>Fecha de Viaje</th>
                        <th>Horario</th>
                        <th>Fecha de Reserva</th>                        
                      </tr>
                    </thead>
                    <tbody>";
                        
                                                            
                        $con = mysql_connect("localhost","root","") or die (mysql_error());
                        mysql_select_db("softrep",$con);
                
                        $_pagi_sql = "SELECT h.id_hora, f.id_fecha, d.id_destino, r.id_reserva, d.descripcion, f.fecha, h.hora as hora, r.fecha_reserva FROM destinos d INNER JOIN reservas r ON r.id_destino = d.id_destino INNER JOIN horas h ON r.id_hora = h.id_hora INNER JOIN fechas f ON f.id_fecha = r.id_fecha WHERE r.dni = '$_SESSION[username]'";            
                        $_pagi_cuantos = 15;
                        $_pagi_htaccess = 0;
                        $a = 0; 

                        include("paginator.php");    
   
                        while($fila = mysql_fetch_array($_pagi_result)){
                          $fechaBase = date_create($fila["fecha"]);
                          $fecha = date_format($fechaBase, 'd-m-Y');

                          $fechaBase2 = date_create($fila["fecha_reserva"]);
                          $fecha2 = date_format($fechaBase2, 'd-m-Y');
                   
                          echo "<tr>";
                            echo "<td>"; echo $fila["descripcion"]; echo "</td>";
                            echo "<td>"; echo $fecha; echo "</td>";
                            echo "<td>"; echo $fila["hora"]; echo " hs</td>";
                            echo "<td>"; echo $fecha2; echo "</td>";
                            echo "<td>";
                              $id = $fila['id_reserva'];
                              $id_destino = $fila['id_destino'];
                              $fecha = $fila['id_fecha'];
                              $hora = $fila['id_hora'];
                              

                              echo "<a onclick='eliminar($id, $id_destino, $fecha, $hora) ;'> <button class='btn btn-danger btn-xs glyphicon glyphicon-trash'> ELIMINAR</button></a>";
                            echo "</td>";
                          echo "</tr>";        
                        }
                    echo "</tbody>"; 
                  echo "</table> "; 
                echo"<center>".$_pagi_navegacion."</center>";

                }
                else{

                  echo "<div align= 'center' style='padding:20px'>"; echo"No posee reservas"; echo"</div>";
                } 
                ?>
              
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    function CargarFechas(val){
        $.ajax({
              type: "POST",
              url: 'consulta2.php',
              data: 'iddestino='+val,
              success: function(resp){
                $('#fechas').html(resp);
              }
        });
    }
    </script> 

    <script>
    function CargarHoras(val, val1){
      var data = {id: val, id: val1};
      var datosJSON = JSON.stringify(data);
        $.ajax({
              type: "POST",
              url: 'consulta.php',
              data: 'idfecha='+val+'&idDestino='+val1, 
              success: function(resp){
                $('#horas').html(resp);
              }
        });
    }
    </script>


<script type="text/javascript">
function eliminar(valor, destino, fecha, hora){
  if (!confirm("¿Realmente desea eliminar?")) {
    return false;
  }else {
    location.href = "baja.php?id_reserva="+valor+"&id_destino="+destino+"&id_fecha="+fecha+"&id_hora="+hora+"";
    return true;
  }
}
</script>
     
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script> 

  </body>      

</html>