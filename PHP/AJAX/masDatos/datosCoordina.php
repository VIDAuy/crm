<?php
include '../../conexiones/conexion3.php';
$ci = $_GET['CI'];
$q = "SELECT
		p.id,
		p.obs_socio,
		p.id_socio,
		p.nombre_socio,
		p.fecha_ini,
		p.fechafin,
		p.hs_ini,
		p.hrfin,
		p.hs_x_dia,
		REPLACE ( p.lugar, '_', ' ' ) AS lugar,
		e.estado,
		p.id_estado_pedido,
		a.patologia 
	  FROM
		pedido_acomp AS p
	    INNER JOIN estados_pedido AS e ON p.id_estado_pedido = e.id_estado
        INNER JOIN patologias AS a ON p.id_patologia = a.id_patologia 
	  WHERE
		id_socio = '$ci' 
	  ORDER BY p.id DESC";
$r = mysqli_query($conexion, $q);
if (mysqli_num_rows($r) == 0) {
	$f = [
		'error' => true,
		'mensaje' => 'El usuario no tiene servicios en coordinación.'
	];
} else {
	while ($row = mysqli_fetch_array($r)) {

		$id           = $row['id'];
		$observacion  = $row['obs_socio'];
		$fecha_inicio = $row['fecha_ini'];
		$fecha_fin    = $row['fechafin'];
		$hora_inicio  = $row['hs_ini'];
		$hora_fin     = $row['hrfin'];
		$horas_x_dia  = $row['hs_x_dia'];
		$lugar        = $row['lugar'];
		$id_estado    = $row['id_estado_pedido'];
		$patologia    = $row['patologia'];

		if ($id_estado == 2) {
			$estado = "<span style='color: purple'> CANCELADO </span>";
		} else if ($id_estado == 3) {
			$estado = "<span class='text-danger'> FINALIZADO </span>";
		} else {
			$estado = "<span class='text-success'> ACTIVO </span>";
		}


		$f[] = array(
			'id' 			=> $id,
			'observacion' 	=> $observacion,
			'fecha_inicio'  => $fecha_inicio == null || $fecha_inicio == "0000-00-00" || $fecha_inicio == "" ? "-" : date("d/m/Y", strtotime($fecha_inicio)),
			'fecha_fin'     => $fecha_fin == null || $fecha_fin == "0000-00-00" || $fecha_fin == "" ? "-" : date("d/m/Y", strtotime($fecha_fin)),
			'hora_inicio'   => $hora_inicio == null || $hora_inicio == "" ? "-" : date("H:i:s", strtotime($hora_inicio)),
			'hora_fin'      => $hora_fin == null || $hora_fin == "" ? "-" : date("H:i:s", strtotime($hora_fin)),
			'horas_x_dia'   => $horas_x_dia,
			'lugar'         => $lugar,
			'estado'        => $estado,
			'patologia'     => $patologia,
		);
	}
}

echo json_encode($f);
