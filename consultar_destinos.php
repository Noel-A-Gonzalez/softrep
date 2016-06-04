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
    <title>Consultar Destinos</title>
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">

    <script type="text/javascript">
    function validacion(){
        indice = document.getElementById("destino").selectedIndex;
          if( indice == null || indice == 0 ) {
          alert("Seleccione un destino")
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
                
                <div style="padding:25px;"></div>
                  <div class="col-md-10" style="margin-left:250px;"> 

                    <form name="formulario" role="form" method="POST" action="filtro_destinos.php" onsubmit="return validacion()">
                
                       <div class="col-xs-9">
                          <div class="form-group col-md-8">
                            <label for="destino">Destino</label>
                              <select class="form-control" name="destino" id="destino" onchange="CargarFechas(this.value);">
                                <option value="0">- Seleccione destino -</option>
                                  <?php
                                  $fechactual= date("Y/m/d H:i:s");

                                    $query = 'SELECT DISTINCT d.descripcion,dfh.id_destino FROM destinos d INNER JOIN dest_fecha_hora dfh ON d.id_destino=dfh.id_destino INNER JOIN fechas f ON f.id_fecha = dfh.id_fecha WHERE f.fecha > "'.$fechactual.'" ORDER BY descripcion ASC';
                                    $result = mysqli_query($con, $query);
                                      while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
                                        echo '<option value="' .$row["id_destino"]. '">' .$row["descripcion"]. '</option>';
                                      }
                                  ?>
                                </select>
                          </div>
                
                        <div class="form-group col-md-8">
                          <label for="fecha">Fecha Salida</label>
                          <select class="form-control" name="fecha" id="fechas">
                                <option value="0">- Seleccione fecha -</option>

                          </select> 
                        </div>        
                                
                        <div class="form-group">                                 
                          <div class="col-md-offset-3 col-md-9" style="margin:25px; margin-left:130px;"> 
                            <button id="btn-aceptar" type="submit" class="btn btn-primary btn-lg">Consultar</button> 
                            <span style="margin-left:8px;"></span>
                            <input id="btn-volver" class="btn btn-lg" type="button" onclick="location.href='inicio.php'" value='Volver'>
                          </div>      
                        </div>

                    </div>                  
                  </form>

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
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>  
       
  </body>

</html>