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

    <script type="text/javascript">
    function validacion(){
        indice = document.getElementById("mes").selectedIndex;
        indice2 = document.getElementById("año").selectedIndex;
          if( indice == null || indice == 0 || indice2 == null || indice2 == 0 ) {
          alert("Seleccione una opción")
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
                    <li><a href="consultar_destinos_emp.php"> <i style="margin-right: 6px" class="fa fa-bus fa-lg"></i> <big><strong>Consultar Destino</strong></big></a></li>
                    <li><a href="consultar_reservas.php"> <i style="margin-right: 6px" class="fa fa-list-alt fa-lg"></i> <big><strong>  Reservas</strong></big></a></li>
                    <li class="active"><a href="opcion_reporte.php"> <i style="margin-right: 6px" class="fa fa-area-chart" aria-hidden="true"></i> <big><strong>  Reportes</strong></big></a></li>                      
                  </ul>

                <div style="padding:25px;"></div>
                  <div class="col-md-8" style="margin-left:350px;"> 

                    <form name="formulario" role="form" method="POST" action="filtro.php" onsubmit="return validacion()">
                
                      <div class="col-xs-8">
                        <div class="form-group col-md-8">
                          <label for="mes">Mes: </label>
                          <div style="padding:5px;"></div>
                            <select class="form-control" name="mes" id="mes">
                              <option value="0">- Seleccione opcion -</option>
                              <option value="01">Enero</option>
                              <option value="02">Febrero</option>
                              <option value="03">Marzo</option>
                              <option value="04">Abril</option>
                              <option value="05">Mayo</option>
                              <option value="06">Junio</option>
                              <option value="07">Julio</option>
                              <option value="08">Agosto</option>
                              <option value="09">Septiembre</option>
                              <option value="10">Octubre</option>
                              <option value="11">Noviembre</option>
                              <option value="12">Diciembre</option>                                
                            </select>
                        </div>

                    
                        <div class="form-group col-md-8">
                          <label for="año">Año: </label>
                          <div style="padding:5px;"></div>
                            <select class="form-control" name="año" id="año">
                              <option>- Seleccione opcion -</option>
                              <option> 2015 </option>
                              <option> 2016 </option>                               
                            </select>
                         
                      </div>                                               
                                
                        <div class="form-group">                                 
                          <div class="col-md-offset-3 col-md-9" style="margin:25px; margin-left:80px;"> 
                            <button id="btn-aceptar" type="submit" class="btn btn-primary btn-lg">Consultar</button> 
                          </div>      
                        </div>

                    </div>                  
                  </form>

              </div>            
            </div>
          </div>
      </div>
    </div>



  </body>
  <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</html>