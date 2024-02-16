<?php

/** Verificar si es socio **/
function es_socio($cedula)
{
    $conexion = connection(DB);
    $tabla = TABLA_REGISTROS;
    $sql = "SELECT socio FROM {$tabla} WHERE cedula = '$cedula' ORDER BY id DESC LIMIT 1";
    $consulta = mysqli_query($conexion, $sql);
    return mysqli_fetch_assoc($consulta)['socio'];
}

/** Verificar si esta dado de baja **/
function esta_en_baja($cedula)
{
    $conexion = connection(DB);
    $tabla = TABLA_REGISTROS;
    $sql = "SELECT baja FROM {$tabla} WHERE cedula = '$cedula' ORDER BY id DESC LIMIT 1";
    $consulta = mysqli_query($conexion, $sql);
    return mysqli_fetch_assoc($consulta)['baja'];
}
