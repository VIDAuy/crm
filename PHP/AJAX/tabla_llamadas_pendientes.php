<?php
include './configuraciones.php';

$cedula = $_REQUEST['cedula'];
$id_area = $_REQUEST['area'];


$tabla["data"] = [];


$obtener_registros = llamadas_sin_asignar($id_area);



while ($row = mysqli_fetch_assoc($obtener_registros)) {

    $id                   = $row['id'];
    $cedula               = $row['cedula'];
    $nombre               = $row['nombre'];
    $telefono             = $row['telefono'];
    $es_socio             = $row['es_socio'];
    $baja                 = $row['baja'];
    $fecha_hora           = $row['fecha_hora'];
    $mensaje              = $row['mensaje'];
    $fecha_registro       = $row['fecha_registro'];
    $id_usuario_agendo    = $row['id_usuario_registrador'];
    $id_usuario_asignado  = $row['id_sub_usuario'];
    $id_usuario_asignador = $row['id_usuario_asignador'];

    if ($id_usuario_asignado == "" && $id_usuario_asignador == "") {
        $usuario_asignado  = "-";
        $usuario_asignador = "-";
        $usuario_agendo = "-";
        $acciones             = "<button class='btn btn-primary' onclick='abrir_asignar_llamada(true, `" . $id . "`, `" . $id_area . "`, `" . $cedula . "`, `" . $nombre . "`, `" . $telefono . "`, `" . $es_socio . "`, `" . $baja . "`, `" . $fecha_hora . "`, `" . $mensaje . "`, `" . $fecha_registro . "`)'>Asignar</button>";
    } else {
        $usuario_asignado = obtener_nombre_usuario($id_usuario_asignado);
        $usuario_asignador = obtener_nombre_usuario($id_usuario_asignador);
        $usuario_agendo = obtener_nombre_usuario($id_usuario_agendo);
        $acciones             = "<button class='btn btn-warning' onclick='abrir_asignar_llamada(true, `" . $id . "`, `" . $id_area . "`, `" . $cedula . "`, `" . $nombre . "`, `" . $telefono . "`, `" . $es_socio . "`, `" . $baja . "`, `" . $fecha_hora . "`, `" . $mensaje . "`, `" . $fecha_registro . "`, `" . $id_usuario_asignado . "`, `" . $usuario_asignado . "`, `" . $id_usuario_asignador . "`, `" . $usuario_asignador . "`)'>Reasignar</button>";
    }


    $tabla["data"][] = [
        "id"                => $id,
        "cedula"            => $cedula,
        "nombre"            => $nombre,
        "telefono"          => $telefono,
        "socio"             => $es_socio == 1 ? "<span class='text-danger'> Si </span>" : "No",
        "baja"              => $baja == 1 ? "<span class='text-danger'> Si </span>" : "No",
        "fecha_hora"        => date("d/m/Y H:i:s", strtotime($fecha_hora)),
        "comentario"        => $mensaje,
        "fecha_registro"    => date("d/m/Y H:i:s", strtotime($fecha_registro)),
        "usuario_agendo"    => $usuario_agendo == "" ? "-" : $usuario_agendo,
        "usuario_asignado"  => $usuario_asignado == "" ? "-" : $usuario_asignado,
        "usuario_asignador" => $usuario_asignador == "" ? "-" : $usuario_asignador,
        "acciones"          => $acciones,
    ];
}



echo json_encode($tabla);






function llamadas_sin_asignar($id_area)
{
    $conexion = connection(DB);
    $tabla = TABLA_AGENDA_VOLVER_A_LLAMAR;

    $sql = "SELECT 
        id, 
        cedula, 
        nombre, 
        telefono, 
        es_socio, 
        baja, 
        fecha_hora, 
        mensaje, 
        fecha_registro,
        id_usuario_registrador,
        id_sub_usuario,
        id_usuario_asignador 
    FROM 
        {$tabla} 
    WHERE 
        area = '$id_area' AND 
        mostrar = 1 AND
        activo = 1";

    $consulta = mysqli_query($conexion, $sql);

    return $consulta;
}

function obtener_nombre_usuario($id_usuario)
{
    $conexion = connection(DB);
    $tabla = TABLA_SUB_USUARIOS;

    $sql = "SELECT nombre, apellido FROM {$tabla} WHERE id = '$id_usuario'";
    $consulta = mysqli_query($conexion, $sql);
    $resultado = mysqli_fetch_assoc($consulta);

    return $resultado['nombre'] . " " . $resultado['apellido'];
}
