<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Cambiar Contraseña</title>
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">    
  </head>

  <body>
      <?php include("cabecera.html"); ?>

    <div class="container"> 
      <div id="cambiarpassbox" style="margin-top:25px;" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading"><strong>Cambiar Contraseña</strong></div>  
            
            <div class="panel-body" >
              <form id="signupform" class="form-horizontal" role="form" method="post" action="update_pass.php">                                                            
                    
                <div class="form-group">
                  <label for="passactual" class="col-md-3 control-label">Contraseña actual</label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="passactual" placeholder="Contraseña actual" required>
                  </div>
                </div>
                    
                <div class="form-group">
                  <label for="passnueva" class="col-md-3 control-label">Contraseña nueva</label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="passnueva" placeholder="Contraseña nueva" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="passnueva" class="col-md-3 control-label">Repetir contraseña nueva </label>
                  <div class="col-md-6">
                    <input type="password" class="form-control" name="confirmpass" placeholder="Contraseña nueva" required>
                  </div>
                </div>

            </div>
            <div class="panel-footer">                                 
                   <center> <button id="btn-aceptar" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>  Aceptar</button></center>

                  </div>
            </form>
            
        </div>        
      </div>
    </div>
             
      <?php include("pie.html"); ?>

  </body>
  <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</html>