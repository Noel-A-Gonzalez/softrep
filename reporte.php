<?php
require_once 'dompdf/dompdf_config.inc.php';
include "libchart/classes/libchart.php";
include("conexion.php");

      $mes= $_GET['mes'];
      $año= $_GET['año'];

      
        $result = mysqli_query($con,"SELECT d.descripcion, f.fecha, COUNT(r.id_reserva) AS 'Cantidad reservas' FROM reservas r INNER JOIN destinos d ON r.id_destino=d.id_destino INNER JOIN fechas f ON r.id_fecha=f.id_fecha WHERE f.fecha LIKE '$año-$mes%' GROUP BY f.fecha");

        if ($row = mysqli_fetch_row($result)){
          if ($mes=='01') {
            $descripmes='ENERO';
            }elseif ($mes=='02') {
              $descripmes='FEBRERO';
            }elseif ($mes=='03') {
              $descripmes='MARZO';
            }elseif ($mes=='04') {
              $descripmes='ABRIL';
            }elseif ($mes=='05') {
              $descripmes='MAYO';
            }elseif ($mes=='06') {
              $descripmes='JUNIO';
            }elseif ($mes=='07') {
              $descripmes='JULIO';
            }elseif ($mes=='08') {
              $descripmes='AGOSTO';
            }elseif ($mes=='09') {
              $descripmes='SEPTIEMBRE';
            }elseif ($mes=='10') {
              $descripmes='OCTUBRE';
            }elseif ($mes=='11') {
              $descripmes='NOVIEMBRE';
            }elseif ($mes=='12') {
              $descripmes='DICIEMBRE';
            }

            $html='
                    
          <center><b>Mes:'.$descripmes.' Año:'.$año.' </b></center>
          <div style="padding:5px"></div>
          <table align="center">  
            
                <tr> 
                  <td>Destino</td>                                                                  
                  <td>Cantidad reservas</td>                                                    
                </tr>
            
              
              <tr>';

            $chart = new VerticalBarChart(500, 250);

            $dataSet = new XYDataSet();

            $result2 = "SELECT d.descripcion, f.fecha, COUNT(r.id_reserva) AS 'Cantidad reservas' FROM reservas r INNER JOIN destinos d ON r.id_destino=d.id_destino INNER JOIN fechas f ON r.id_fecha=f.id_fecha WHERE f.fecha LIKE '$año-$mes%' GROUP BY d.descripcion";

            if ($resultado = $con->query($result2)) {    
                  while ($row = $resultado->fetch_assoc()) {

                    $destino=$row["descripcion"];
                    $cantidad=$row["Cantidad reservas"];

                    $html.='
                                                                  
                          <td>'.$destino.'</td>;                        
                          <td>'.$cantidad.'</td>;
                                  
                      </tr>';

                      $dataSet->addPoint(new Point("$destino", $cantidad));
                      }
                    }
                      
              $html.='
                  
              </table>
            ';


          $chart->setDataSet($dataSet);
          $chart->setTitle('Cantidad de reservas por destino');
          $chart->render('libchart/generated/grafico.png'); 
         

$html='
<p align=center>
	<img src="libchart/generated/grafico.png" />
       </p>
';
}
       
$mipdf = new DOMPDF();

# Cargamos el contenido HTML.
$mipdf ->load_html(utf8_decode($html));
 
# Renderizamos el documento PDF.
$mipdf ->render();
 
# Enviamos el fichero PDF al navegador.
$mipdf ->stream('reporte.pdf',array("Attachment" => false ));


?>