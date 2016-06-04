<?php
    session_start();
    if (isset($_SESSION["user"])){
        header("location:inicio.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Login</title>

 
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
  </head>

    <body>
        <div class="container">    
            <div id="loginbox" style="margin-top:130px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading"><center><img src="images/logo.png"></center></div>
                    <div class="panel-heading"><strong>Login</strong>
                        <div style="float:right; font-size: 80%; position: relative; top:-1px">
                            <a href="" data-toggle="modal" data-target="#myModal2">Olvidó su contraseña?</a>
                        </div>
                    </div> 

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                          
                        <span class="error"><?php if(isset($error)) { echo $error; } ?></span>
                            
                        <form id="loginform" class="form-horizontal" role="form" action="login_validar.php" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-user" type="text" class="form-control" name="user" placeholder="DNI" onkeypress="return numeros(event)" required>
                            </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-pass" type="password" class="form-control" name="pass" placeholder="Password" required>
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">   
                                    <button id="ingresar" name="ingresar" type="submit" href="#" class="btn btn-info"> Ingresar</button>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" ><big>No tiene una cuenta?</big> 
                                        <a href="usuarios.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            <big>Registrarse aquí</big>
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                            <p align =right> <a href="doc/manual_softrep.pdf" target="_blank">
              Ayuda <span class="glyphicon glyphicon-question-sign "></span></a></p>    
                        </form>

                    </div>                     
                </div>  
            </div>     
        </div>


<div class="modal fade" id="myModal2">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Restablecer Contraseña</h4>
        </div>
        <div class="modal-body">

            <form class="form-horizontal" role="form" method="POST" action="restablecer_pass.php">                                                          

                        <div class=form-group>
                            <label for='email' class='col-md-3 control-label'>Email:</label>
                            <div class='col-md-6'>
                                <input type='text' class='form-control' name='email' required>
                            </div>
                        </div>

                        <div class=form-group>
                            <label for='pass' class='col-md-3 control-label'>Nueva Contraseña:</label>
                            <div class='col-md-6'>
                                <input type='password' class='form-control' name='passnueva' required>
                            </div>
                        </div>

                        <div class=form-group>
                            <label for='pass2' class='col-md-3 control-label'>Repetir Contraseña:</label>
                            <div class='col-md-6'>
                                <input type='password' class='form-control' name='passrep' required>
                            </div>
                        </div>
                                                                                               
                        <div class="form-group">                                   
                            <div class= "col-md-offset-3 col-md-9" style="margin-left:200px;"> 
                                <button id="btn-aceptar" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>  Aceptar</button> 
                                <span style="margin-left:8px;"></span>
                                <input id="btn-cancelar" type="button" class="btn" onclick="location.href='index.php'" value="Cancelar">
                            </div>
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