<?php
include("conexion.php"); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logof.ico">
    <title>Administrar Destinos</title> 
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

    <?php include("cabecera.html"); ?>

    <div class="container" style="margin-top:20px;">
      <div class="row">

        <div class="panel panel-info">
          <div class="panel-heading"><center><strong>Panel Administrador</strong></center></div>
        <div class="panel-body">
         
       
          <ul class="nav nav-tabs nav-justified">
            <li><a href="admin_usuarios.php"><strong>Administrar Usuarios</strong></a></li>
            <li><a href="admin_dest_horas.php"><strong>Asignar Fecha - Horario</strong></a></li>
            <li class="active"><a href="admin_destinos.php"><strong>Administrar Destinos</strong></a></li>
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

          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Nuevo</button>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Destino</h4>
        </div>
        <div class="modal-body">

            <form id="form" class="form-horizontal" role="form" method="POST" action="registrar_destino.php">                                 
              <div class="form-group col-md-10">
                <label for="destino">Destino *</label>
                <input name="destino" type="text" class="form-control" placeholder="Destino" required> 
              </div>

              <div class="form-group col-md-10">
                <label for="salida">Lugar de Salida *</label>
                <input name="salida" type="text" class="form-control" placeholder="Lugar de Salida" onkeypress="return soloLetras(event)" required> 
              </div>    
                            
              <div class="form-group">                                   
               
              </div>
            
        </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>  Aceptar</button>
        <input id="btn-cancelar" type="button" class="btn" value="Cancelar" onclick="location.href='admin_destinos.php'">
      </div>
      </form>
        
      </div>
      
    </div>
  </div>
          <div style="padding:5px;"></div>
          <div class="col-md-13">                
              <table id ="datos" class="table table-striped table-bordered" cellspacing="0" width="100%">            
                <thead>
                  <tr >
                    <th>Destino</th>
                    <th>Lugar de Salida</th>
                  </tr>
                </thead>
            
                <tbody> 

                <?php  
                    $con = mysql_connect("localhost","root","") or die (mysql_error());
                    mysql_select_db("softrep",$con);
                    $_pagi_sql ="SELECT * FROM destinos ORDER BY descripcion ASC";
                    $_pagi_cuantos = 15;
                    $_pagi_htaccess = 0;
              
                    include("paginator.php");                                            
              
                    $a = 0;
                 
                    while($fila = mysql_fetch_array($_pagi_result)){
                  
                      echo "<tr>";
                        echo "<td>";echo $fila["descripcion"];echo "</td>";
                        echo "<td>";echo $fila["salida"];echo "</td>";                        
                        echo "<td>"; echo "<a href=./editar_destino.php?id_destino=".$fila["id_destino"]."><button class='btn btn-xs glyphicon glyphicon-edit'> EDITAR</button></a>"; echo "</td>";
                        echo "<td>";$id = $fila['id_destino'];
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
 

  <script type="text/javascript">
    function eliminar(valor){
      if (!confirm("¿Realmente desea eliminar?")) {
        return false;
      }else {
        location.href = "baja_destino.php?id_destino="+valor+"";
        return true;
      }
    }
  </script>
  
  
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>   
    
  
  </body>


</html>