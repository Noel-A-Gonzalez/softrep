<?php
    require_once('conexion.php');
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Actualizar Datos</title>
     <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">

    <script type="text/javascript">
    function soloNumeros(e){
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    }

    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

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
   
</head>
  <body>
    <?php include("cabecera.html"); ?>

    <div class="container"> 
        <div id="signupbox" style="margin-top:25px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Perfil</strong></div>  
                    <div class="panel-body">
                
                        <?php 
                            
                            $result=mysqli_query($con,"SELECT * FROM usuarios where dni='$_SESSION[username]'");
                                if ($row = mysqli_fetch_row($result)){   
                            
                                echo "<div class='form-group'>                             
                                        <strong>Apellido:</strong>  $row[1]                                        
                                    </div>
                                   
                                    <div class='form-group'>
                                        <strong>Nombre:</strong>  $row[2]                                        
                                    </div>
                            
                                    <div class='form-group'>
                                      <strong>Teléfono:</strong>  $row[3]                                        
                                    </div>  

                                    <div class=form-group>
                                        <strong>Email:</strong> $row[4]
                                    </div>";
                                }
                            
                            ?>                  
                                                               
                               
                            </div>
                            <div class="panel-footer">
                                
                                    <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Actualizar Datos</button></center>
                                    
                            </div>
                        
                    </div>
            </div>        
    </div>

    <div class="modal fade" id="myModal">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Perfil</h4>
        </div>
        <div class="modal-body">

            <form id="actualizarform" class="form-horizontal" role="form" method="POST" action="update_datos.php">                                 
                        <?php 

                            $result=mysqli_query($con,"SELECT * FROM usuarios where dni='$_SESSION[username]'");
                                if ($row = mysqli_fetch_row($result)){   
                            
                                echo "<div class='form-group'>                               
                                        <label for='apellido' class='col-md-3 control-label'>Apellido</label>
                                        <div class='col-md-9'>
                                            <input type='text' class='form-control' name='apellido' onkeypress='return soloLetras(event)' value='$row[1]' required>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label for='nombre' class='col-md-3 control-label'>Nombre</label>
                                        <div class='col-md-9'>
                                            <input type='text' class='form-control' name='nombre' onkeypress='return soloLetras(event)' value='$row[2]' required>
                                        </div>
                                    </div>
                            
                                    <div class='form-group'>
                                        <label for='tel' class='col-md-3 control-label'>Teléfono</label>
                                        <div class='col-md-9'>
                                            <input type='text' class='form-control' name='tel' onkeypress='return soloNumeros(event)' value='$row[3]'>
                                        </div>
                                    </div>  

                                    <div class=form-group>
                                        <label for='email' class='col-md-3 control-label'>Email</label>
                                        <div class='col-md-9'>
                                            <input type='email' class='form-control' name='email' value='$row[4]' required>
                                        </div>
                                    </div>
                                    <div class=form-group>

                                    </div>";
                                }
                            
                            ?>

                            <div class="modal-footer">
                                <span style="margin-left:280px;"></span>
                                <button id="btn-aceptar" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>  Aceptar</button> 
                                <span style="margin-left:8px;"></span>
                                <button type="button" id="btn_cerrar" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-delete"></span>  Cerrar</button>
                                    
                            </div>                  
                            
                
                        </form>


        </div>
        
      </div>
      
    </div>
  </div>

        <?php include("pie.html"); ?>
   
  </body>
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</html> 