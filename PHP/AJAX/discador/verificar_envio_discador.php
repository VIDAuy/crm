<?php
include_once '../../configuraciones.php';

$cedula = $_REQUEST['cedula'];


if ($cedula == "") {
    $response['error'] = true;
    $response['mensaje'] = ERROR_GENERAL;
    die(json_encode($response));
}


$comprobacion = comprobar_envio_discador($cedula);

if ($comprobacion === false) {
    $response['error'] = 222;
    $response['mensaje'] = ERROR_GENERAL_2;
    die(json_encode($response));
}

if (mysqli_num_rows($comprobacion) <= 0) {
    $response['error'] = true;
    $response['mensaje'] = "El usuario no tiene discadores registrados";
    die(json_encode($response));
}


$response['error'] = false;
$response['mensaje'] = "El socio tiene discadores registrados";


echo json_encode($response);




function comprobar_envio_discador($cedula)
{
    $conexion = connection(DB);
    $tabla = TABLA_REGISTROS_DISCADOR;

    try {
        $sql = "SELECT * FROM {$tabla} WHERE cedula_datos_contacto = '$cedula' AND activo = 1";
        $consulta = mysqli_query($conexion, $sql);
        return $consulta;
    } catch (\Throwable $error) {
        registrar_errores($sql, "verificar_envio_discador.php", $error);
        return false;
    }
}
