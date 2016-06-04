<?php
require("conexion.php");

$fecha = mysqli_real_escape_string($con, $_POST["idfecha"]);
$destino = mysqli_real_escape_string($con, $_POST["idDestino"]);
//echo "<script type='text/javascript'>alert($destino);</script>";
$query = "SELECT h.id_hora, h.hora FROM horas h INNER JOIN dest_fecha_hora a ON h.id_hora = a.id_hora INNER JOIN fechas f ON f.id_fecha = a.id_fecha INNER JOIN destinos d ON a.id_destino = d.id_destino WHERE f.id_fecha = $fecha and d.id_destino = $destino ORDER BY hora ASC";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{
    echo '<option value="' .$row["id_hora"]. '">' .$row["hora"]. ' hs</option>';
}
mysqli_close($con);
?>