$(document).ready(function () {

    abrir_modal_identificarse(true);

});



function abrir_modal_identificarse(openModal = false) {
    let sector = $("#sector").val();

    if (sector == "Recepcion" ||
        sector == "Morosos" ||
        sector == "Calidad" ||
        sector == "Servicios" ||
        sector == "Coordinacion" ||
        sector == "Bajas" ||
        sector == "Calidad_interna") {
        if (openModal === true) {
            $('#modal_identificar_persona_en_sesion').modal({ backdrop: 'static', keyboard: false })
            $('#modal_identificar_persona_en_sesion').modal("show");
        } else {
            let sector = $("#sector").val();
            let cedula = $('#cedula_identificar_persona').val();

            if (cedula == "") {
                error("Debe ingresar su cédula");
            } else if (comprobarCI(cedula) === false) {
                error("Debe ingresar una cédula válida");
            } else {

                $.ajax({
                    type: "GET",
                    url: `${url_app}comprobar_persona_en_sesion.php`,
                    data: {
                        sector: sector,
                        cedula: cedula
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.error === false) {
                            let datos = response.datos;
                            localStorage.setItem("id_sub_usuario", datos.id_sub_usuario);
                            localStorage.setItem("id_sector", datos.id_sector);
                            localStorage.setItem("sector", datos.sector);
                            localStorage.setItem("cedula", datos.cedula);
                            localStorage.setItem("nombre", datos.nombre);
                            localStorage.setItem("apellido", datos.apellido);
                            //correcto_pasajero(response.mensaje);
                            $('#cedula_identificar_persona').val('');
                            $('#modal_identificar_persona_en_sesion').modal("hide");
                            $('#nombre_usuario_en_sesion').text(datos.nombre);

                            if (sector == "Calidad" && (cedula == 43382081 || cedula == 49554284 || cedula == 45909437 || cedula == 46955506 || cedula == 48936512)) {
                                tabla_llamadas_pendientes();
                                tabla_alertas_pendientes();
                                setInterval(tabla_llamadas_pendientes, 300000);
                                setInterval(tabla_alertas_pendientes, 300000);

                                $(".administrar_pendientes").css("display", "block");
                            }

                            if (sector == "Bajas" && (cedula == 44417851)) {
                                tabla_llamadas_pendientes();
                                tabla_alertas_pendientes();
                                setInterval(tabla_llamadas_pendientes, 300000);
                                setInterval(tabla_alertas_pendientes, 300000);

                                $(".administrar_pendientes").css("display", "block");
                            }

                            if (sector == "Calidad" || sector == "Morosos" || sector == "Bajas") {
                                $(".ctr_agendar_volver_a_llamar").css("display", "block");
                            }

                        } else {
                            error(response.mensaje);
                        }
                    }
                });

            }
        }
    }
}
