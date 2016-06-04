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
    <title>Consultar Clientes</title> 
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
            <li class="active"><a href="admin_usuarios.php"><strong>Administrar Usuarios</strong></a></li>
            <li><a href="admin_dest_horas.php"><strong>Asignar Fecha - Horario</strong></a></li>
            <li><a href="admin_destinos.php"><strong>Administrar Destinos</strong></a></li>
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

          <div style="padding:15px;"></div>
          <label>Usuarios: Clientes</label>
                                    
          <table id ="datos" class="table table-striped table-bordered" cellspacing="0" width="100%">            
            
            <thead>
              <tr>               
                <th>DNI</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Tel</th>
                <th>Email</th>
                <th>Contraseña</th>
              </tr>
            </thead>
            
            <tbody>              
            <?php  
                
              $consulta = 'SELECT * FROM usuarios WHERE tipo_usuario=3';            
            
              if ($resultado = $con->query($consulta)) {    
                while ($fila = $resultado->fetch_assoc()) {
                  
                  echo "<tr>";
                  echo "<td>";echo $fila["dni"]; echo "</td>";
                  echo "<td>";echo $fila["apellido"]; echo "</td>";
                  echo "<td>";echo $fila["nombre"]; echo "</td>";
                  echo "<td>";echo $fila["tel"]; echo "</td>";
                  echo "<td>";echo $fila["email"]; echo "</td>";
                  echo "<td>";echo $fila["pass"]; echo "</td>";

                  
                  echo "<td>";$id = $fila['dni'];

                  echo "<a onclick='eliminar($id);'> <button class='btn btn-danger btn-xs glyphicon glyphicon-trash'> ELIMINAR</button></a>"; echo "</td>";
                  echo "</td>"; 
                  echo "</tr>";                  
                }
              }                            
            ?>
          </tbody>
          </table>

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
        location.href = "baja_cliente.php?dni="+valor+"";
        return true;
      }
    }
  </script>
  
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script> 
     
  </body>


</html>