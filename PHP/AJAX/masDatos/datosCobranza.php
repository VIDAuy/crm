<?php
	include '../../conexiones/conexion4.php';
	$ci = $_GET['CI'];
	$q = "SELECT MES, ANO, IMPORTE, COBRADO_EN_EL_MES 
			FROM cobrado 
			WHERE CEDULA = $ci 
			ORDER BY ANO DESC";
	$r = mysqli_query ($conexion,$q);
	if(mysqli_num_rows($r) != 0)
	{
		while ($row = mysqli_fetch_assoc($r))
		{
			$f[] = array(
				'mes' 		=> $row['MES'],
				'anho' 		=> $row['ANO'],
				'importe' 	=> $row['IMPORTE'],
				'cobrado' 	=> $row['COBRADO_EN_EL_MES']
			);
		}
	}
	else
	{
		$f = array(
			'sinCuotas' => true,
			'mensaje' => 'Esta persona no tiene registros en cobranzas.'
		);
	}
	echo json_encode($f);