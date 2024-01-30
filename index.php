<?php
$version = '?v=1.0.66';
session_start();
date_default_timezone_set('America/Montevideo');

//	DEPENDIENDO DE CON QUE USUARIO ESTÉ LOGUEADO LA PÁGINA QUE CARGA

include('views/header.html');

if (isset($_SESSION['nivel'])) {
	$fecha = date("Y-m-d");
	header("Cache-Control: no-cache, must-revalidate");
	include 'PHP/conexiones/conexion2.php';
	$id = $_SESSION['id'];
	switch ($_SESSION['nivel']) {
		case 1:
			echo '<script src="JS/funciones.js' . $version . '"></script>';

			/** JS General **/
			echo '<script src="JS/general/volver_a_llamar.js' . $version . '"></script>';
			echo '<script src="JS/general/sesion.js' . $version . '"></script>';
			echo '<script src="JS/general/alertas_de_otras_areas.js' . $version . '"></script>';
			echo '<script src="JS/general/buscar_socio_o_funcionario.js' . $version . '"></script>';
			echo '<script src="JS/general/consultas_datos_socio_o_funcionario.js' . $version . '"></script>';
			echo '<script src="JS/general/identificacion_usuario.js' . $version . '"></script>';
			echo '<script src="JS/general/alertas_de_vida_te_lleva.js' . $version . '"></script>';
			echo '<script src="JS/general/cargar_registros.js' . $version . '"></script>';
			echo '<script src="JS/general/historia_comunicacion_de_cedula.js' . $version . '"></script>';
			echo '<script src="JS/general/historial_registros_alertas.js' . $version . '"></script>';
			echo '<script src="JS/general/patologias_socio.js' . $version . '"></script>';
			/** END JS General **/


			include('views/nivel1.php');

			include('views/includes/contenido_filiales.html');

			// MODALES DE INFORMACIÓN
			include('views/modals/modalDatosAlertas.html');
			echo '<script src="JS/masDatos/datosAlertas.js' . $version . '"></script>';
			include('views/modals/modalDatosCobranza.html');
			echo '<script src="JS/masDatos/datosCobranza.js' . $version . '"></script>';
			include('views/modals/modalDatosCoordina.html');
			echo '<script src="JS/masDatos/datosCoordina.js' . $version . '"></script>';
			include('views/modals/modalDatosProductos.html');
			echo '<script src="JS/masDatos/datosProductos.js' . $version . '"></script>';


			include('views/includes/historiaComunicacionDeCedula.html');

			// MODALES DE BAJA Y RELACIONADOS
			include('views/modals/modalInformacionDetalladaBaja.html');
			include('views/modals/modalHistoriaComunicacionDeCedula.html');
			include('views/modals/modalHistorialDeBajas.html');
			echo '<script src="JS/sistemaBajas/historialDeBajas.js' . $version . '"></script>';
			include 'views/modals/modalSolicitarBajaFiliales.html';
			echo '<script src="JS/sistemaBajas/solicitarBaja.js' . $version . '"></script>';
			include('views/modals/modalServiciosContratados.html');
			echo '<script src="JS/serviciosContratados/js.js' . $version . '"></script>';
			include('views/modals/modal_identificar_persona_logueada.html');
			include('views/modals/modalSesionExpirada.html');
			include('views/modals/modal_asignar_llamada_a_usuario.html');
			include('views/modals/modal_asignar_alerta_pendiente.html');
			include('views/modals/modal_historial_registros_de_alertas.html');
			include('views/modals/modal_historial_registros_volver_a_llamar.html');
			include('views/modals/modal_agregar_patologia_socio.html');
			include('views/modals/modal_cambiar_fecha_y_hora_volver_a_llamar.html');

			break;
		case 2:
			echo '<script src="JS/funciones.js' . $version . '"></script>';

			/** JS General **/
			echo '<script src="JS/general/volver_a_llamar.js' . $version . '"></script>';
			echo '<script src="JS/general/sesion.js' . $version . '"></script>';
			echo '<script src="JS/general/alertas_de_otras_areas.js' . $version . '"></script>';
			echo '<script src="JS/general/buscar_socio_o_funcionario.js' . $version . '"></script>';
			echo '<script src="JS/general/consultas_datos_socio_o_funcionario.js' . $version . '"></script>';
			echo '<script src="JS/general/identificacion_usuario.js' . $version . '"></script>';
			echo '<script src="JS/general/alertas_de_vida_te_lleva.js' . $version . '"></script>';
			echo '<script src="JS/general/cargar_registros.js' . $version . '"></script>';
			echo '<script src="JS/general/historia_comunicacion_de_cedula.js' . $version . '"></script>';
			echo '<script src="JS/general/historial_registros_alertas.js' . $version . '"></script>';
			echo '<script src="JS/general/patologias_socio.js' . $version . '"></script>';
			/** END JS General **/


			include('views/nivel2.php');
			include('views/includes/contenido.html');

			// MODALES DE INFORMACIÓN

			include('views/modals/modalDatosAlertas.html');
			echo '<script src="JS/masDatos/datosAlertas.js' . $version . '"></script>';
			include('views/modals/modalDatosCobranza.html');
			echo '<script src="JS/masDatos/datosCobranza.js' . $version . '"></script>';
			include('views/modals/modalDatosCoordina.html');
			echo '<script src="JS/masDatos/datosCoordina.js' . $version . '"></script>';
			include('views/modals/modalDatosProductos.html');
			echo '<script src="JS/masDatos/datosProductos.js' . $version . '"></script>';

			// MODALES DE BAJA Y RELACIONADOS

			include('views/modals/modalInformacionDetalladaBaja.html');
			include('views/modals/modalServiciosContratados.html');
			echo '<script src="JS/serviciosContratados/js.js' . $version . '"></script>';
			include('views/modals/modal_identificar_persona_logueada.html');
			include('views/modals/modalSesionExpirada.html');
			include('views/modals/modal_asignar_llamada_a_usuario.html');
			include('views/modals/modal_asignar_alerta_pendiente.html');
			include('views/modals/modal_historial_registros_de_alertas.html');
			include('views/modals/modal_historial_registros_volver_a_llamar.html');

			break;


		case 3:
			echo '<script src="JS/funciones.js' . $version . '"></script>';

			/** JS General **/
			echo '<script src="JS/general/volver_a_llamar.js' . $version . '"></script>';
			echo '<script src="JS/general/sesion.js' . $version . '"></script>';
			echo '<script src="JS/general/alertas_de_otras_areas.js' . $version . '"></script>';
			echo '<script src="JS/general/buscar_socio_o_funcionario.js' . $version . '"></script>';
			echo '<script src="JS/general/consultas_datos_socio_o_funcionario.js' . $version . '"></script>';
			echo '<script src="JS/general/identificacion_usuario.js' . $version . '"></script>';
			echo '<script src="JS/general/alertas_de_vida_te_lleva.js' . $version . '"></script>';
			echo '<script src="JS/general/cargar_registros.js' . $version . '"></script>';
			echo '<script src="JS/general/historia_comunicacion_de_cedula.js' . $version . '"></script>';
			echo '<script src="JS/general/historial_registros_alertas.js' . $version . '"></script>';
			echo '<script src="JS/general/patologias_socio.js' . $version . '"></script>';
			/** END JS General **/




			include('views/nivel3.php');
			include('views/includes/contenido.html');
			include('views/includes/historiaComunicacionDeCedula.html');
			include('views/includes/historiaComunicacionDeCedula_funcionarios.html');


			// MODALES DE INFORMACIÓN

			include('views/modals/modalDatosAlertas.html');
			echo '<script src="JS/masDatos/datosAlertas.js' . $version . '"></script>';
			include('views/modals/modalDatosCobranza.html');
			echo '<script src="JS/masDatos/datosCobranza.js' . $version . '"></script>';
			include('views/modals/modalDatosCoordina.html');
			echo '<script src="JS/masDatos/datosCoordina.js' . $version . '"></script>';
			include('views/modals/modalDatosProductos.html');
			echo '<script src="JS/masDatos/datosProductos.js' . $version . '"></script>';
			include('views/modals/modal_ver_mas_comentarios.html');
			include('views/modals/modal_licencia_acompanantes.html');
			include('views/modals/modal_faltas_acompanantes.html');
			include('views/modals/modal_horas_acompanantes.html');
			include('views/modals/modal_agendar_volver_a_llamar.html');
			include('views/modals/modal_agenda_volver_a_llamar.html');
			include('views/modals/modal_cargar_registro_volver_a_llamar.html');
			include('views/modals/modal_enviar_terminos_y_condiciones.html');
			include('views/modals/modal_mostrar_imagenes.html');
			include('views/modals/modal_historial_registros_volver_a_llamar.html');
			include('views/modals/modal_historial_registros_de_alertas.html');


			// MODALES DE BAJA Y RELACIONADOS

			include('views/modals/modalInformacionDetalladaBaja.html');
			include('views/modals/modalHistoriaComunicacionDeCedula.html');
			include('views/modals/modalHistorialDeBajas.html');
			echo '<script src="JS/sistemaBajas/historialDeBajas.js' . $version . '"></script>';
			include('views/modals/modalListarBajas.html');
			echo '<script src="JS/sistemaBajas/gestionarBajas.js' . $version . '"></script>';
			include 'views/modals/modalSolicitarBaja.html';
			echo '<script src="JS/sistemaBajas/solicitarBaja.js' . $version . '"></script>';
			include('views/modals/modalServiciosContratados.html');
			echo '<script src="JS/serviciosContratados/js.js' . $version . '"></script>';
			include('views/modals/modalCargarDocumentos.html');
			echo '<script src="JS/enviar_documento_y_alerta/js.js' . $version . '"></script>';
			include('views/modals/modal_alertas_funcionarios.html');
			include('views/modals/modal_identificar_persona_logueada.html');
			include('views/modals/modalSesionExpirada.html');
			include('views/modals/modal_asignar_llamada_a_usuario.html');
			include('views/modals/modal_asignar_alerta_pendiente.html');
			include('views/modals/modal_historial_registros_de_alertas.html');
			include('views/modals/modal_historial_registros_volver_a_llamar.html');
			include('views/modals/modal_agregar_patologia_socio.html');
			include('views/modals/modal_cambiar_fecha_y_hora_volver_a_llamar.html');


			echo '<script src="JS/index.js' . $version . '"></script>';

			break;
		case 4:
			echo '<script src="JS/nivel4/js.js' . $version . '"></script>';
			echo '<script src="JS/general/sesion.js' . $version . '"></script>';
			include('views/nivel4.php');
			include('views/modals/modal_identificar_persona_logueada.html');
			include('views/modals/modalSesionExpirada.html');
			include('views/modals/modal_asignar_llamada_a_usuario.html');
			include('views/modals/modal_asignar_alerta_pendiente.html');
			include('views/modals/modal_historial_registros_de_alertas.html');
			include('views/modals/modal_historial_registros_volver_a_llamar.html');

			break;


		case 5:
			echo '<script src="JS/nivel5/js.js' . $version . '"></script>';
			echo '<script src="JS/general/sesion.js' . $version . '"></script>';
			include('views/nivel5.php');

			// MODALES DE INFORMACIÓN

			include('views/modals/modalDatosCobranza.html');
			echo '<script src="JS/masDatos/datosCobranza.js' . $version . '"></script>';
			include('views/modals/modalDatosCoordina.html');
			echo '<script src="JS/masDatos/datosCoordina.js' . $version . '"></script>';
			include('views/modals/modalDatosCRM.html');
			echo '<script src="JS/masDatos/datosCRM.js' . $version . '"></script>';
			include('views/modals/modalDatosProductos.html');
			echo '<script src="JS/masDatos/datosProductos.js' . $version . '"></script>';


			include('views/modals/modalGestionCentralizado.html');
			include('views/modals/modalGestionDomiciliario.html');
			include('views/modals/modalHistoriaComunicacionDeCedula.html');
			include('views/modals/modalHistorialDeBajas.html');
			echo '<script src="JS/sistemaBajas/historialDeBajas.js' . $version . '"></script>';
			include('views/modals/modalLlamadasPendientes.html');
			echo '<script src="JS/sistemaBajas/gestionarBajas.js' . $version . '"></script>';
			include('views/modals/modalServiciosContratados.html');
			echo '<script src="JS/serviciosContratados/js.js' . $version . '"></script>';
			include('views/modals/modal_identificar_persona_logueada.html');
			include('views/modals/modalSesionExpirada.html');
			include('views/modals/modal_asignar_llamada_a_usuario.html');
			include('views/modals/modal_asignar_alerta_pendiente.html');
			include('views/modals/modal_historial_registros_de_alertas.html');
			include('views/modals/modal_historial_registros_volver_a_llamar.html');

			break;


		case 6:
			echo '<script src="JS/nivel6/js.js' . $version . '"></script>';
			echo '<script src="JS/nivel6/alertas/js.js' . $version . '"></script>';
			echo '<script src="JS/general/sesion.js' . $version . '"></script>';

			include('views/nivel6.php');


			// MODALES DE INFORMACIÓN

			include('views/modals/nivel6/modal_licencia_acompanantes.html');
			include('views/modals/nivel6/modal_horas_acompanantes_personal.html');
			include('views/modals/nivel6/modal_faltas_acompanantes_personal.html');
			include('views/modals/nivel6/modalDatosCoordina_personal.html');
			include('views/modals/nivel6/modalDatosCobranza_personal.html');
			include('views/modals/nivel6/modalDatosProductos_personal.html');

			include('views/modals/nivel6/modal_todas_licencias_acompanantes.html');
			include('views/modals/nivel6/modal_todas_las_horas_acompanantes_personal.html');
			include('views/modals/nivel6/modal_todos_registros_faltas_acompanantes_personal.html');
			include('views/modals/nivel6/modal_alertas_funcionarios.html');
			include('views/modals/nivel6/modal_capacitacion_acompanantes.html');
			include('views/modals/modal_identificar_persona_logueada.html');
			include('views/modals/modalSesionExpirada.html');
			include('views/modals/modal_asignar_llamada_a_usuario.html');
			include('views/modals/modal_asignar_alerta_pendiente.html');
			include('views/modals/modal_historial_registros_de_alertas.html');
			include('views/modals/modal_historial_registros_volver_a_llamar.html');

			break;
	}
} else {
	include('views/log.html');
	echo '<script src="JS/log.js' . $version . '"></script>';
}

include('views/footer.html');
