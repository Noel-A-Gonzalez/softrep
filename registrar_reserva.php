<!DOCTYPE html>
<html lang="en">
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">
</head>

<?php 
include("conexion.php"); 
    session_start();

// Recibimos por POST los datos procedentes del formulario 
$dni=$_SESSION['username'];
$destino= $_POST['destino'];
$fecha= $_POST['fecha'];
$hora= $_POST['hora'];
$cant_pasajes = 0;


$result2=mysqli_query($con,"SELECT r.dni FROM reservas r INNER JOIN usuarios u ON r.dni=u.dni INNER JOIN destinos d ON d.id_destino=r.id_destino INNER JOIN fechas f ON f.id_fecha=r.id_fecha INNER JOIN horas h ON h.id_hora=r.id_hora WHERE r.dni='$dni' AND r.id_destino='$destino' AND r.id_fecha='$fecha' AND r.id_hora='$hora'");
	if (! $result2){
			die ('ERROR'. mysqli_error($con));
		}

	elseif ($row = mysqli_fetch_row($result2)){ 
		echo "<script type='text/javascript'>alert('Solo puede realizar una reserva'); window.location='mis_reservas.php';</script>";
	}else{

	$result=mysqli_query($con,"SELECT cant_pasajes FROM dest_fecha_hora WHERE id_destino=$destino AND id_fecha=$fecha AND id_hora=$hora");
		if ($row = mysqli_fetch_row($result)){ 
			$cant_pasajes = $row[0];
		}
	
			if($cant_pasajes > 0){
				mysqli_query($con,"INSERT INTO reservas (dni, id_destino, id_fecha, id_hora) VALUES ('$dni', '$destino', '$fecha', '$hora')");
					$cant = ($cant_pasajes-1);

				mysqli_query($con,"UPDATE dest_fecha_hora SET cant_pasajes ='$cant' WHERE id_destino=$destino AND id_fecha=$fecha AND id_hora=$hora"); 
			}
			else{
				echo "<script type='text/javascript'>alert('Destino no disponible'); window.location='mis_reservas.php';</script>";
			}

		

			$result=mysqli_query($con,"SELECT MAX(id_reserva)from reservas");
				if ($row = mysqli_fetch_row($result)){ 
					$id = trim($row[0]);
			}

			$result=mysqli_query($con,"SELECT * from fechas WHERE id_fecha=$fecha");
				if ($row = mysqli_fetch_row($result)){
					$fechaBase = date_create($row[1]);
                    $fecha = date_format($fechaBase, 'd-m-Y');
					//$fechadesc=$row[1];
				}			
	
			$result=mysqli_query($con,"SELECT * from destinos where id_destino=$destino");
				if ($row = mysqli_fetch_row($result)){
					$destinodesc=$row[1];

				echo "
					<div class='container'> 
						<div style='margin-top:25px;' class='mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2'>
							<div class='panel panel-info'>
				   
              					<div class='panel-body' style='border=5px'>

									<big><center><strong>Se ha registrado una nueva reserva!</strong></center></big>
									
									<span style='padding: 10px;'></span>

									<div class='form-group'>                                         		             
                            			<div class='col-md-8'><strong>Nro. de operacion</strong>: $id </div>
                    				</div>
                    				
									<div class='form-group'>                                         		             
                            			<div class='col-md-8'><strong>Destino</strong>: $destinodesc </div>
                    				</div>
                    				
		     
		    						<div class='form-group'>                                         		             
                            			<div class='col-md-8'><strong> Fecha</strong>: $fecha </div>
                    				</div>";
				}

			$result1=mysqli_query($con,"SELECT * from horas where id_hora=$hora");
				if ($row = mysqli_fetch_row($result1)){ 

						$horadesc=$row[1];

							echo 	"<div class='form-group'>                                         		             
                            			<div class='col-md-8'><strong> Hora</strong>: $horadesc hs. </div>
                  					</div>
		    
		    				</div>

		    				<span style='padding: 5px;'></span>

		    				<div class='form-group'>
		    					<span style='margin-left:280px;'></span>
		    					<a href='comp.php' target='_blank'><button id='btn-imprimir' class='btn btn-primary'>Imprimir comprobante</button></a>
		    					<span style='margin-left:8px;'></span>
		    					<a href='mis_reservas.php'><button id='btn-no' class='btn'>Volver</button></a>
		    				</div>	   
		    			</div>	
		    		</div>	    	
		   		</div>"; 
				}	
			}
					
// Cerramos la conexion a la base de datos 
mysqli_close($con); 

// Confirmamos que el registro ha sido insertado con exito 

?>
	<script src="http://code.jquery.com/jquery.js"></script>
  	<script src="js/bootstrap.min.js"></script>
</html>