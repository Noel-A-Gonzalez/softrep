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
    <title>Administrar Horarios</title> 
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
            <li><a href="admin_usuarios.php"><strong>Administrar Usuarios</strong></a></li>
            <li><a href="admin_dest_horas.php"><strong>Asignar Fecha - Horario</strong></a></li>
            <li><a href="admin_destinos.php"><strong>Administrar Destinos</strong></a></li>
            <li><a href="admin_fechas.php"><strong>Administrar Fechas</strong></a></li>
            <li class="active"><a href="admin_horas.php"><strong>Administrar Horarios</strong></a></li>            
          </ul>
          
          <div class="col-md-4 col-md-offset-1">
          <div style="padding:15px;"></div>           
         
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalnuevo">Nuevo</button>
                      
          <div style="padding:5px;"></div>
                                    
          <table id ="horas" class="table table-striped table-bordered" cellspacing="0" width="100%">            
            <thead>
              <tr >               
                <th>Horarios</th>
              </tr>
            </thead>
            
            <tbody>              
            <?php  
                $con = mysql_connect("localhost","root","") or die (mysql_error());
                    mysql_select_db("softrep",$con);
                    $_pagi_sql ="SELECT * FROM horas ORDER BY hora ASC";
                    $_pagi_cuantos = 15;
                    $_pagi_htaccess = 0;
              
                    include("paginator.php");                                            
              
                    $a = 0;
                 
                    while($fila = mysql_fetch_array($_pagi_result)){ 
               
        
                  
                  echo "<tr>";
                  echo "<td>";echo $fila["hora"]; echo " hs";echo "</td>";
                  
                  echo "<td>";$id = $fila['id_hora'];

                  echo "<a onclick='eliminar($id);'> <button class='btn btn-danger btn-xs glyphicon glyphicon-trash'> ELIMINAR</button></a>"; echo "</td>";
                  echo "</td>"; 
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

  <div class="modal fade" id="modalnuevo">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Horario</h4>
        </div>
        <div class="modal-body">

            <form id="form" class="form-horizontal" role="form" method="POST" action="registrar_hora.php">                                 
              <div class="form-group col-md-7">
                <label for="hora">Horario *</label>
                <input name="hora" type="text" class="form-control" placeholder="Horario" required> 
              </div>             
                            
              <div class="form-group">                                   
               
              </div>
           
        </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Aceptar</button>
                <input id="btn-cancelar" type="button" class="btn" value="Cancelar" onclick="location.href='admin_horas.php'">
              </div>
          
        </form> 
     
      </div>
    </div>
  </div>
 
      <script type="text/javascript">
    function eliminar(valor){
      if (!confirm("¿Realmente desea eliminar?")) {
        return false;
      }else {
        location.href = "baja_hora.php?id_hora="+valor+"";
        return true;
      }
    }
  </script>
   
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script> 
        
  </body>


</html>