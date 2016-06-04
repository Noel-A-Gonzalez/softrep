<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Panel Administrador</title> 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">    

  </head>

  <body>
    <?php include("cabecera.html"); ?>
    <div class="container"> 
      <div style="margin-top:25px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading"><strong>Editar Destino</strong></div>  
              <div class="panel-body">
                <form id="editform" class="form-horizontal" role="form" method="get" action="update_destinos.php">

                   <?php 

                    include("conexion.php"); 

                    $id_destino=$_GET['id_destino'];

                    $result=mysqli_query($con,"SELECT *  FROM destinos WHERE id_destino='".$id_destino."'");
                    if ($row = mysqli_fetch_row($result)){
	                   

		                  echo " 

                      <input type='hidden' name='id_destino' value=' $row[0]'>

			                   <div class='form-group'>                               
           		             <label for='descripcion' class='col-md-3 control-label'>Destino</label>
                            <div class='col-md-9'>
                              <input type='text' class='form-control' name='destino' value='$row[1]' required>
                            </div>
                        </div>

                        <div class='form-group'>
                          <label for='salida' class='col-md-3 control-label'>Lugar de Salida</label>
                            <div class='col-md-9'>
                              <input type='text' class='form-control' name='salida' value='$row[2]' required>
                            </div>
                        </div>
                            
                      ";

                    }
              
              ?>
              </div>

              <div class='panel-footer'>                                 
                <span style="margin-left:300px;"></span>
                    <button id="btn-aceptar" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>  Aceptar</button> 
                    <span style='margin-left:5px;'></span>
                    <button id="btn-cancelar" type="button" class="btn" onclick="location.href='admin_destinos.php'"><span class="glyphicon glyphicon-remove"></span>  Cancelar</button></a>                                 
              </div>
            </form>
          
          </div>
                        
        </div>
      </div>
    </div>        
  
                               
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>  

     
  </body>


</html>