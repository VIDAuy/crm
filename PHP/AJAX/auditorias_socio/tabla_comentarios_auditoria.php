<?php
include_once '../../configuraciones.php';

$tabla["data"] = [];

$id = $_REQUEST['id'];
$comentarios_auditoria = obtener_comentarios_auditoria($id);

while ($row = mysqli_fetch_assoc($comentarios_auditoria)) {

    $id = $row['id'];
    $comentario = $row['comentario'];
    $area_registro = $row['area_registro'] != "" ? ucfirst(obtener_datos_usuario($row['area_registro'])['usuario']) : "-";
    $usuario_registro = ($area_registro == "Audit1") ? "Nathalia Horvat" : (($area_registro == "Audit2") ? "Andrea Horvat" : (($area_registro == "Audit3") ? "Tatiana Landa" : $area_registro));
    $fecha_registro = $row['fecha_registro'];
    $archivos_del_comentario = imagenes_comentario($id);
    $btnArchivos = strlen($archivos_del_comentario) > 0 ? "<button class='btn btn-sm btn-info' onclick='modal_ver_mp3(`" . URL_DOCUMENTOS_AUDITORIA . "`, `" . $archivos_del_comentario . "`);'>Ver Archivos</button>" : "-";
    $acciones = $btnArchivos;

    if (strlen($comentario) > 20) {
        $br  = array("<br />", "<br>", "<br/>");
        $comentario = str_ireplace($br, "\r\n", $comentario);

        $comentario_sin_editar = $comentario;
        $comentario = substr($comentario, 0, 50) . " ...<button class='btn btn-link' onclick='verMasTabla(`" . $comentario_sin_editar . "`);'>Ver Más</button>";
        $comentario = mb_convert_encoding($comentario, 'UTF-8', 'UTF-8');
    }


    $tabla["data"][] = [
        "id"               => $id,
        "comentario"       => $comentario,
        "usuario_registro" => $usuario_registro,
        "fecha_registro"   => date("d/m/Y H:i", strtotime($fecha_registro)),
        "acciones"         => $acciones,
    ];
}



echo json_encode($tabla);




function imagenes_comentario($id_comentario)
{
    $conexion = connection(DB);
    $tabla = TABLA_ARCHIVOS_AUDITORIAS;

    $sql = "SELECT * FROM {$tabla} WHERE id_comentario_auditoria = '$id_comentario' AND activo = 1";
    $consulta = mysqli_query($conexion, $sql);

    $archivos = "";
    while ($row = mysqli_fetch_assoc($consulta)) {
        $archivos .= $archivos == "" ? $row['nombre_archivo'] : ", " . $row['nombre_archivo'];
    }

    return $archivos;
}
