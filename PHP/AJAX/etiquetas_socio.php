<?php
include './configuraciones.php';


$opcion = $_REQUEST['opcion'];
if (isset($_REQUEST['cedula'])) $cedula = $_REQUEST['cedula'];
if (isset($_REQUEST['etiqueta'])) $mensaje = $_REQUEST['etiqueta'];
if (isset($_REQUEST['id_sub_usuario'])) $id_sub_usuario = $_REQUEST['id_sub_usuario'];



/** Tabla Etiquetas **/
if ($opcion == 1) {
    $tabla["data"] = [];

    $obtener_etiquetas = obtener_etiquetas($cedula);

    while ($row = mysqli_fetch_assoc($obtener_etiquetas)) {

        $id             = $row['id'];
        $etiqueta       = $row['mensaje'];
        $usuario_agrego = $row['id_sub_usuario'];
        $fecha_registro = date("d/m/Y", strtotime($row['fecha_registro']));

        $tabla["data"][] = [
            "id"             => $id,
            "etiqueta"       => $etiqueta,
        ];
    }

    echo json_encode($tabla);
}

/** Cantidad Etiquetas **/
if ($opcion == 2) {
    $cantidad_etiquetas = obtener_cantidad_etiquetas($cedula);

    $response['error'] = false;
    $response['cantidad'] = $cantidad_etiquetas;
    echo json_encode($response);
}

/** Registrar Nueva Etiqueta **/
if ($opcion == 3) {

    if ($cedula == "" || $mensaje == "" || $id_sub_usuario == "") {
        $response['error'] = true;
        $response['mensaje'] = ERROR_GENERAL;
        die(json_encode($response));
    }

    $insert_etiqueta = registrar_nueva_etiqueta($cedula, $mensaje, $id_sub_usuario);

    if ($insert_etiqueta === false) {
        $response['error'] = true;
        $response['mensaje'] = "Ocurrieron errores al registrar la etiqueta";
        die(json_encode($response));
    }

    $response['error'] = false;
    $response['mensaje'] = "Se ha registrado la etiqueta con éxito";

    echo json_encode($response);
}





function obtener_etiquetas($cedula)
{
    $conexion = connection(DB);
    $tabla = TABLA_ETIQUETA_SOCIO;

    $sql = "SELECT * FROM {$tabla} WHERE cedula = '$cedula' AND activo = 1";
    $consulta = mysqli_query($conexion, $sql);

    return $consulta;
}

function obtener_cantidad_etiquetas($cedula)
{
    $conexion = connection(DB);
    $tabla = TABLA_ETIQUETA_SOCIO;

    $sql = "SELECT COUNT(id) AS 'cantidad' FROM {$tabla} WHERE cedula = '$cedula' AND activo = 1";
    $consulta = mysqli_query($conexion, $sql);

    if ($consulta === false) {
        $response['error'] = true;
        $response['mensaje'] = "Ocurrio un error al obtener la cantidad de etiquetas del socio";
        die(json_encode($response));
    }

    return mysqli_fetch_assoc($consulta)['cantidad'];
}

function registrar_nueva_etiqueta($cedula, $mensaje, $id_sub_usuario)
{
    $conexion = connection(DB);
    $tabla = TABLA_ETIQUETA_SOCIO;

    $sql = "INSERT INTO {$tabla} (cedula, mensaje, id_sub_usuario, fecha_registro) VALUES ('$cedula', '$mensaje', '$id_sub_usuario', NOW())";
    $consulta = mysqli_query($conexion, $sql);

    return $consulta;
}
