function cargo(param, socioParam) {
    if (controlCargo(param) == "") {
        if (param == 0) {
            nombre = $("#nombreNSR").val();
            telefono = $("#telefonoNSR").val();
            observacion = $("#observacionesNSR").val();
            ensec = $("#avisarNSR").val();
        } else if (param == 1) {
            nombre = $("#nombreNS").val() + " " + $("#apellidoNS").val();
            telefono = $("#telefonoNS").val() + " " + $("#celularNS").val();
            observacion = $("#observacionesNS").val();
            ensec = $("#avisarNS").val();
        } else {
            nombre = $("#nom").text();
            telefono = $("#telefono").text();
            observacion = $("#obser").val();
            ensec = $("#ensec").val();
        }

        cedulas = $("#cedulas").text();
        sector = $("#sector").val();
        let id_sub_usuario = localStorage.getItem("id_sub_usuario");

        if (ensec == "sin_seleccion") {
            alerta("Error!", "Debe seleccionar a quien desea avisar", "error");
        } else {

            var form_data = new FormData();
            form_data.append("nombre", nombre);
            form_data.append("telefono", telefono);
            form_data.append("observacion", observacion);
            form_data.append("ensec", ensec);
            form_data.append("cedulas", cedulas);
            form_data.append("sector", sector);
            form_data.append("socio", socioParam);
            form_data.append("id_sub_usuario", id_sub_usuario);


            if (param == 0) {
                let totalImagenes = $("#cargar_imagen_registro_1").prop("files").length;
                for (let i = 0; i < totalImagenes; i++) {
                    form_data.append("cargar_imagen_registro_1[]", $("#cargar_imagen_registro_1").prop("files")[i]);
                }
            } else if (param == 1) {
                let totalImagenes = $("#cargar_imagen_registro_2").prop("files").length;
                for (let i = 0; i < totalImagenes; i++) {
                    form_data.append("cargar_imagen_registro_2[]", $("#cargar_imagen_registro_2").prop("files")[i]);
                }
            } else {
                let totalImagenes = $("#cargar_imagen_registro_3").prop("files").length;
                for (let i = 0; i < totalImagenes; i++) {
                    form_data.append("cargar_imagen_registro_3[]", $("#cargar_imagen_registro_3").prop("files")[i]);
                }
            }


            $.ajax({
                type: "POST",
                data: form_data,
                url: `${url_app}datos.php`,
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: function () {
                    mostrarLoader();
                },
                complete: function () {
                    mostrarLoader("O");
                },
                success: function (content) {
                    if (content.error === false) {
                        $("#ci").val("");
                        $("#cargar_imagen_registro_1").val("");
                        $("#cargar_imagen_registro_2").val("");
                        $("#cargar_imagen_registro_3").val("");
                        ocultar_todo_contenido();
                        correcto(content.message);
                    } else {
                        alerta("Error!", content.message, "error");
                    }
                },
            });

        }

    } else {
        alerta(
            "Error!",
            "Ha ocurrido lo siguiente:\n" + controlCargo(param),
            "error"
        );
    }

}

function cargo_registro_fucionario() {
    let cedula = $("#cedula_funcionario").text();
    let nombre = $("#nombre_completo_funcionario").text();
    let telefono = $("#telefono_funcionario").text();
    let observacion = $("#obser_funcionarios").val();
    let avisar = $("#ensec_funcionarios").val();

    if (cedula == "") {
        alerta("Error!", "Debe ingresar una cedula", "error");
    } else if (observacion == "") {
        alerta("Error!", "Debe ingresar una observación", "error");
    } else {
        $.ajax({
            type: "POST",
            url: url_app + "datos_funcionarios.php",
            data: {
                cedula: cedula,
                nombre: nombre,
                tel: telefono,
                observacion: observacion,
                avisar: avisar,
            },
            dataType: "JSON",
            success: function (response) {
                if (response.error == false) {
                    alerta("Exito!", response.mensaje, "success");
                    $("#obser_funcionarios").val("");
                    $("#ensec_funcionarios").val("");
                    historiaComunicacionDeCedula_funcionarios();
                } else {
                    alerta("Error!", response.mensaje, "error");
                }
            },
        });
    }
}