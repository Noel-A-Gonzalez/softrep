
<?php
require_once 'dompdf/dompdf_config.inc.php';
include("conexion.php"); 

$fechactual= date("d/m/Y H:i:s");


$result=mysqli_query($con,"SELECT MAX(id_reserva)from reservas");
	if ($row = mysqli_fetch_row($result)){ 
		$id = trim($row[0]);
	}

	$result=mysqli_query($con,"SELECT * from reservas WHERE id_reserva=$id");
		if ($row = mysqli_fetch_row($result)){
			$destino=$row[2];
			$hora=$row[5];
			$fecha=$row[3];
			
			$html=' 			
			<div style="width:50%;height:6%; border:1px solid; margin:0 auto">
			<img src="images/logo.png">
			</div>
			
			<div style="width:50%;height:28%; border:1px solid; font-size:17px;margin:0 auto">
			
				<table align="center">
				<tr><td></td></tr>
				<tr><td></td></tr>
					<tr>
						<td>Nro. comprobante:</td> <td> '.$row[0].'</td>
					</tr>
					<tr><td></td></tr>
					';

					$result=mysqli_query($con,"SELECT * from fechas WHERE id_fecha=$fecha");
						if ($row = mysqli_fetch_row($result)){
							$fechaBase = date_create($row[1]);
            				$fecha = date_format($fechaBase, 'd-m-Y');

						$html.= '
						<tr>
						<td> Fecha de viaje: </td> <td>'.$fecha.'</td>
						</tr>
						<tr><td></td></tr>
					';

					$result=mysqli_query($con,"SELECT * from destinos WHERE id_destino=$destino");
						if ($row = mysqli_fetch_row($result)){

						$html.= '
						<tr>
						<td> Destino: </td> <td>'.$row[1].'</td>
						</tr>
						<tr><td></td></tr>
					';		

						$result=mysqli_query($con,"SELECT * from horas WHERE id_hora=$hora");
							if ($row = mysqli_fetch_row($result)){

							$html.='
							<tr>
							<td>Hora: </td> <td>'.$row[1].' hs</td>
							</tr>
							<tr><td></td></tr>
 						
 						
						
						<div style="width:50%;height:3%;padding-top:125px;padding-left:210px;">
			 '.$fechactual.'
	</div>
	</table>';	 
												
						}
					}
		}

	}
	
	
	       
$mipdf = new DOMPDF();

# Cargamos el contenido HTML.
$mipdf ->load_html(utf8_decode($html));
 
# Renderizamos el documento PDF.
$mipdf ->render();
 
# Enviamos el fichero PDF al navegador.
$mipdf ->stream('comprobante.pdf', array("Attachment" => false ));

?>
