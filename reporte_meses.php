<?php
require_once 'dompdf/dompdf_config.inc.php';
include "libchart/classes/libchart.php";
include("conexion.php");

      $destino= $_GET['destino'];
      $año= $_GET['año'];

      
        $result1=mysqli_query($con,"SELECT * from destinos WHERE id_destino=$destino");
            if ($row = mysqli_fetch_row($result1)){
              $destinodesc=$row[1];
            }
     
        $result = mysqli_query($con,"SELECT d.descripcion, MONTHNAME(f.fecha) AS Mes, COUNT(r.id_reserva) AS 'Cantidad reservas' FROM reservas r INNER JOIN destinos d ON r.id_destino=d.id_destino INNER JOIN fechas f ON r.id_fecha=f.id_fecha WHERE d.id_destino = $destino AND f.fecha LIKE '$año%' GROUP BY MONTH(f.fecha)" );


        if ($row = mysqli_fetch_row($result)){
          
            $html='
            <tr>
            <td> Mes: </td> <td>'.$destinodesc.'</td>
            </tr>';

            $chart = new VerticalBarChart(500, 250);

            $dataSet = new XYDataSet();

            $con->query("SET lc_time_names = 'es_AR'");

            $result2 = "SELECT d.descripcion, MONTHNAME(f.fecha) AS Mes, COUNT(r.id_reserva) AS 'Cantidad reservas' FROM reservas r INNER JOIN destinos d ON r.id_destino=d.id_destino INNER JOIN fechas f ON r.id_fecha=f.id_fecha WHERE d.id_destino = $destino AND f.fecha LIKE '$año%' GROUP BY MONTH(f.fecha)";


            if ($resultado = $con->query($result2)) {   
                  while ($row = $resultado->fetch_assoc()) {

                    $mes=$row["Mes"];
                    $cantidad=$row["Cantidad reservas"];

                    $html.='
                                                                  
                          <td>'.$mes.'</td>;                        
                          <td>'.$cantidad.'</td>;
                                  
                      </tr>';

                      $dataSet->addPoint(new Point("$mes", $cantidad));
                      }
                    }

          $chart->setDataSet($dataSet);
          $chart->setTitle('Cantidad de reservas por meses');
          $chart->render('libchart/generated/grafico_meses.png'); 
         

$html='
<p align=center>
	<img src="libchart/generated/grafico_meses.png" />
       </p>
';
}
       
$mipdf = new DOMPDF();

# Cargamos el contenido HTML.
$mipdf ->load_html(utf8_decode($html));
 
# Renderizamos el documento PDF.
$mipdf ->render();
 
# Enviamos el fichero PDF al navegador.
$mipdf ->stream('reporte_meses.pdf',array("Attachment" => false ));


?>