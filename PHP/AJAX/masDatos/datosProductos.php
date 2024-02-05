<?php
include '../../conexiones/conexion.php';
$cedula = $_GET['cedula'];
$q = "SELECT pps.servicio AS nro_servicio, 
		sc.servicio, 
		pps.hora, 
		pps.importe 
	FROM 
		padron_producto_socio AS pps 
		INNER JOIN servicios_codigos AS sc ON pps.servicio = sc.nro_servicio 
	WHERE 
		cedula = $cedula
		AND activo = 1
		";
$r = mysqli_query($conexion, $q);

if (mysqli_num_rows($r) != 0) {
	while ($f = mysqli_fetch_assoc($r)) {
		$nroServicio 	= $f['nro_servicio'];
		$servicio 		= $f['servicio'];
		$horas 			= $f['hora'];
		$importe 		= $f['importe'];

		$repuesta[] = array(
			'nroServicio' 	=> $nroServicio,
			'servicio' 		=> $servicio,
			'horas' 		=> $horas,
			'importe' 		=> $importe
		);
	}
} else {
	$repuesta = array(
		'error' => true,
		'mensaje' => 'Ha ocurrido un error al tratar de traer los registros.'
	);
}

echo json_encode($repuesta);
