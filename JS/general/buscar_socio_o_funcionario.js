function buscar() {
    if ($("#ci").val().length != 0) {
        if (comprobarCI($("#ci").val())) {
            $.ajax({
                url: url_app + "cargarDatos.php",
                type: "GET",
                dataType: "JSON",
                data: { CI: $("#ci").val() },
                beforeSend: function () {
                    $(".contenido").css({ display: "none" });
                    $("#historiaComunicacionDeCedulaDiv").css("display", "none");
                    $("#historiaComunicacionDeCedulaDiv_funcionarios").css("display", "none");
                    $("#b1").val("Coordinación");
                    $("#b1").attr("disabled", false);
                    $("#b2").val("Cobranza");
                    $("#b2").attr("disabled", false);

                    //noEsSocioRegistro
                    $("#cedulasNSR").val("");
                    $("#nombreNSR").val(null);
                    $("#telefonoNSR").val(null);
                    $("#observacionesNSR").val("");
                    $("#avisarNSR").prop("selectedIndex", 0);
                    $("#noEsSocioRegistro").css({ display: "none" });

                    //noEsSocio
                    $("#cedulasNS").val("");
                    $("#nombreNS").val(null);
                    $("#apellidoNS").val(null);
                    $("#telefonoNS").val(null);
                    $("#celularNS").val(null);
                    $("#observacionesNS").val("");
                    $("#avisarNS").prop("selectedIndex", 0);
                    $("#noEsSocio").css({ display: "none" });

                    //siEsSocio
                    $("#cedulas").val("");
                    $("#obser").val("");
                    $("#ensec").prop("selectedIndex", 0);
                    $("#siEsSocio").css({ display: "none" });
                },
            })
                .done(function (datos) {
                    $("#cedulas").text($("#ci").val());
                    historiaComunicacionDeCedula();
                    tabla_patologias_socio();
                    mostrar_cantidad_etiquetas_socio();
                    if (datos.noSocioConRegistros) {
                        warning(datos.mensaje);
                        $("#cedulasNSR").text($("#ci").val());
                        $("#nombreNSR").val(datos.nombre);
                        $("#telefonoNSR").val(datos.telefono);
                        $("#noEsSocioRegistro").css({ display: "block" });
                        $("#historiaComunicacionDeCedulaDiv").css("display", "block");
                        $("#historiaComunicacionDeCedulaDiv_funcionarios").css(
                            "display",
                            "none"
                        );
                    } else if (datos.noSocio) {
                        warning(datos.mensaje);
                        $("#cedulasNS").text($("#ci").val());
                        $("#noEsSocio").css({ display: "block" });
                        $("#historiaComunicacionDeCedulaDiv_funcionarios").css(
                            "display",
                            "none"
                        );
                    } else if (datos.bajaProcesada) {
                        warning(datos.mensaje);
                        $("#cedulasNSR").text($("#ci").val());
                        $("#nombreNSR").val(datos.nombre);
                        $("#telefonoNSR").val(datos.telefono);
                        $("#noEsSocioRegistro").css({ display: "block" });
                        $("#historiaComunicacionDeCedulaDiv").css("display", "block");
                        $("#historiaComunicacionDeCedulaDiv_funcionarios").css(
                            "display",
                            "none"
                        );
                    } else {
                        $("#nom").text(datos.nombre);
                        $("#telefono").text(datos.tel);
                        $("#fechafil").text(datos.fecha_afiliacion);
                        $("#radio").text(datos.radio);
                        $("#sucursal").text(datos.sucursal);
                        $("#inspira").text(datos.inspira);
                        $("#siEsSocio").css({ display: "block" });
                        if (!datos.mostrar_inspira)
                            $("#div_inspira").css("display", "none");
                        $("#historiaComunicacionDeCedulaDiv").css("display", "block");
                        $("#historiaComunicacionDeCedulaDiv_funcionarios").css(
                            "display",
                            "none"
                        );
                    }
                    $(".contenido").css({ display: "block" });
                })
                .fail(function (error) {
                    console.log(error);
                    error(
                        "Ha ocurrido un error, por favor comuníquese con el administrador"
                    );
                });
        } else {
            error("La cédula ingresada no es válida.");
        }
    } else {
        error("Debe ingresar la cédula de la persona que quiera buscar.");
    }
}

function buscarDatos() {
    let cedula = $("#ci").val();
    let consultar = document.querySelector('input[name="radioBuscar"]:checked').value;

    if (cedula.length != 0) {
        if (consultar === "socio" && comprobarCI(cedula)) {
            buscarSocio(cedula);
        } else if (consultar === "funcionario") {
            const regex_numeros = /^[0-9]*$/;
            if (regex_numeros.test(cedula)) {
                buscarFuncionario(cedula, "cedula");
            } else {
                buscarFuncionario(cedula, "pasaporte");
            }
        } else {
            error("La cédula ingresada no es válida.");
        }
    } else {
        error("Debe ingresar la cédula de la persona que quiera buscar.");
    }
}

function buscarSocio() {
    let cedula = $("#ci").val();

    if (cedula == "") {
        error("Debe ingresar la cédula a buscar");
    } else {

        $.ajax({
            url: url_app + "cargar_datos_socios.php",
            type: "GET",
            dataType: "JSON",
            data: { CI: cedula },
            beforeSend: function () {
                $(".contenido").css({ display: "none" });
                $("#acciones_socios_nivel_3").css("display", "block");
                $(".contenido_funcionario").css({ display: "none" });
                $("#historiaComunicacionDeCedulaDiv").css("display", "none");
                $("#historiaComunicacionDeCedulaDiv_funcionarios").css("display", "none");
                $("#b1").val("Coordinación");
                $("#b1").attr("disabled", false);
                $("#b2").val("Cobranza");
                $("#b2").attr("disabled", false);

                //noEsSocioRegistro
                $("#cedulasNSR").val("");
                $("#nombreNSR").val(null);
                $("#telefonoNSR").val(null);
                $("#observacionesNSR").val("");
                $("#avisarNSR").prop("selectedIndex", 0);
                $("#noEsSocioRegistro").css({ display: "none" });

                //noEsSocio
                $("#cedulasNS").val("");
                $("#nombreNS").val(null);
                $("#apellidoNS").val(null);
                $("#telefonoNS").val(null);
                $("#celularNS").val(null);
                $("#observacionesNS").val("");
                $("#avisarNS").prop("selectedIndex", 0);
                $("#noEsSocio").css({ display: "none" });

                //siEsSocio
                $("#cedulas").val("");
                $("#obser").val("");
                $("#ensec").prop("selectedIndex", 0);
                $("#siEsSocio").css({ display: "none" });
            },
        })
            .done(function (datos) {
                $("#cedulas").text(cedula);
                historiaComunicacionDeCedula();
                tabla_patologias_socio();
                mostrar_cantidad_etiquetas_socio();
                if (datos.noSocioConRegistros) {
                    alerta("Problema!", datos.mensaje, "warning");
                    $("#cedulasNSR").text($("#ci").val());
                    $("#nombreNSR").val(datos.nombre);
                    $("#telefonoNSR").val(datos.telefono);
                    $("#noEsSocioRegistro").css({ display: "block" });
                    $("#historiaComunicacionDeCedulaDiv").css("display", "block");
                    $("#historiaComunicacionDeCedulaDiv_funcionarios").css("display", "none");
                } else if (datos.noSocio) {
                    alerta("<span style='color: #9C0404'>¿Está seguro de que la cédula pertenece un socio?</span>", datos.mensaje, "error");
                    $("#cedulasNS").text($("#ci").val());
                    $("#noEsSocio").css({ display: "block" });
                    $("#historiaComunicacionDeCedulaDiv_funcionarios").css("display", "none");
                } else if (datos.bajaProcesada) {
                    alerta("Problema!", datos.mensaje, "warning");
                    $("#cedulasNSR").text($("#ci").val());
                    $("#nombreNSR").val(datos.nombre);
                    $("#telefonoNSR").val(datos.telefono);
                    $("#noEsSocioRegistro").css({ display: "block" });
                    $("#historiaComunicacionDeCedulaDiv").css("display", "block");
                    $("#historiaComunicacionDeCedulaDiv_funcionarios").css(
                        "display",
                        "none"
                    );
                } else {
                    $("#nom").text(datos.nombre);
                    $("#telefono").text(datos.tel);
                    $("#fechafil").text(datos.fecha_afiliacion);
                    $("#radio").text(datos.radio);
                    $("#sucursal").text(datos.sucursal);
                    $("#inspira").text(datos.inspira);
                    $("#siEsSocio").css({ display: "block" });
                    if (!datos.mostrar_inspira) $("#div_inspira").css("display", "none");
                    $("#historiaComunicacionDeCedulaDiv").css("display", "block");
                    $("#historiaComunicacionDeCedulaDiv_funcionarios").css("display", "none");
                }
                $(".contenido").css({ display: "block" });
            })
            .fail(function (error) {
                console.log(error);
                alerta(
                    "Error!",
                    "Ha ocurrido un error, por favor comuníquese con el administrador",
                    "error"
                );
            });

    }
}

function buscarFuncionario(cedula, tipo) {
    $.ajax({
        url: url_app + "cargar_datos_funcionarios.php",
        type: "GET",
        dataType: "JSON",
        data: {
            CI: cedula,
            tipo: tipo,
        },
        beforeSend: function () {
            $(".contenido_funcionario").css({ display: "none" });
            $("#acciones_socios_nivel_3").css("display", "none");
            $(".contenido").css({ display: "none" });
            $("#historiaComunicacionDeCedulaDiv").css("display", "none");
            $("#b1").val("Coordinación");
            $("#b1").attr("disabled", false);
            $("#b2").val("Cobranza");
            $("#b2").attr("disabled", false);

            //noEsSocioRegistro
            $("#cedulasNSR").val("");
            $("#nombreNSR").val(null);
            $("#telefonoNSR").val(null);
            $("#observacionesNSR").val("");
            $("#avisarNSR").prop("selectedIndex", 0);
            $("#noEsSocioRegistro").css({ display: "none" });

            //noEsSocio
            $("#cedulasNS").val("");
            $("#nombreNS").val(null);
            $("#apellidoNS").val(null);
            $("#telefonoNS").val(null);
            $("#celularNS").val(null);
            $("#observacionesNS").val("");
            $("#avisarNS").prop("selectedIndex", 0);
            $("#noEsSocio").css({ display: "none" });

            //siEsSocio
            $("#cedulas").val("");
            $("#obser").val("");
            $("#ensec").prop("selectedIndex", 0);
            $("#siEsSocio").css({ display: "none" });
        },
    })
        .done(function (response) {
            $("#cedulas").text(cedula);
            if (response.error === false) {
                $("#cedula_funcionario").text(cedula);
                $("#numero_nodum").text(response.datos.id_nodum);
                $("#nombre_completo_funcionario").text(response.datos.nombre);
                $("#fecha_ingreso").text(response.datos.fecha_ingreso);
                $("#fecha_egreso").text(response.datos.fecha_egreso);
                $("#empresa_funcionario").text(response.datos.empresa);
                $("#estado_funcionario").text(response.datos.estado);
                $("#causal_de_baja_funcionario").text(response.datos.causa);
                $("#tipo_de_comisionamiento_funcionario").text(response.datos.planes);
                $("#filial_funcionario").text(response.datos.filial);
                $("#sub_filial_funcionario").text(response.datos.sub_filial);
                $("#cargo_funcionario").text(response.datos.cargo);
                $("#centro_de_costos_funcionario").text(response.datos.seccion);
                $("#tipo_de_trabajador_funcionario").text(
                    response.datos.tipo_trabajador
                );
                $("#medio_de_pago_funcionario").text(response.datos.banco);
                $("#telefono_funcionario").text(response.datos.telefono);
                $("#correo_funcionario").text(response.datos.correo);

                $("#historiaComunicacionDeCedulaDiv").css("display", "none");
                $("#historiaComunicacionDeCedulaDiv_funcionarios").css(
                    "display",
                    "block"
                );
                $("#acciones_socios_nivel_3").css("display", "none");

                $(".contenido_funcionario").css({ display: "block" });

                historiaComunicacionDeCedula_funcionarios();
            } else {
                $("#acciones_socios_nivel_3").css("display", "none");
                alerta(
                    "<span style='color: #9C0404'> No se han encontrado resultados! </span>",
                    "Seguro que la cédula ingresada pertenece a un funcionario?",
                    "error"
                );
            }
        })
        .fail(function (response) {
            alerta(
                "Error!",
                "Ha ocurrido un error, por favor comuníquese con el administrador",
                "error"
            );
        });
}