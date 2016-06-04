<?php
require("conexion.php");
$fechactual= date("Y/m/d H:i:s");

$destino = mysqli_real_escape_string($con, $_POST["iddestino"]);
$query = 'SELECT DISTINCT f.id_fecha, f.fecha FROM fechas f INNER JOIN dest_fecha_hora a ON f.id_fecha = a.id_fecha INNER JOIN destinos d ON a.id_destino = d.id_destino WHERE f.fecha > "'.$fechactual.'" AND d.id_destino = "'.$destino.'"  ORDER BY fecha ASC';
$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
		$fechaBase = date_create($row["fecha"]);
 		$fecha = date_format($fechaBase, 'd-m-Y');    
    		echo '<option value="' .$row["id_fecha"]. '">' .$fecha. '</option>';
	}
mysqli_close($con);
?>