<?php
  require_once('conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Registrarse</title>
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

    <script>
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

    <div class="container"> 
        <div id="signupbox" style="margin-top:25px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Registrarse</strong></div>  
                        
                <div class="panel-body" >

                    <form data-toggle="validator" id="registroform" class="form-horizontal" role="form" action="registrar_usuario.php" method="post">
                                 
                        <div class="form-group">
                            <label for="dni" class="col-md-3 control-label">DNI *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="dni" placeholder="DNI" maxlength="8" onkeypress="return numeros(event)" required>
                            </div>                                    
                        </div>   

                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Email *</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>
                                    
                        <div class="form-group">
                            <label for="apellido" class="col-md-3 control-label">Apellido *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="apellido" placeholder="Apellido" onkeypress="return soloLetras(event)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre" class="col-md-3 control-label">Nombre *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" onkeypress="return soloLetras(event)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tel" class="col-md-3 control-label">Teléfono</label>
                            <div class="col-md-8">
                                <input type="int" class="form-control" name="tel" placeholder="Teléfono">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass" class="col-md-3 control-label">Contraseña *</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
                            </div>
                        </div>

                        <div class="form-group">                                 
                            <div class="col-md-offset-3 col-md-9" style="margin-top:15px;"> 
                                <button id="registrar" name="registrar" type="submit" class="btn btn-primary">Registrarse</button> 
                                <span style="margin-left:8px;"></span>
                                <input id="cancelar" type="button" class="btn" onclick="location.href='index.php'" value='Cancelar'>
                            </div>
                        </div>

                    </form>
                </div>
                        
                    <div class="panel-footer ">(*) Campos obligatorios</div>
            </div>        
        </div>
    </div>
        <?php include("pie.html"); ?>

    </body>

    <script>
        function validarSiNumero(numero){
            if (!/^([0-9])*$/.test(numero))
            alert("El campo DNI debe ser numérico");
        }
    </script>

    <script>
        function validarAlfa(letra){
            if (!/^([A-Z])*$/.test(letra))
            alert("Debe ingresar solo letras");
        }
    </script>

</html> 