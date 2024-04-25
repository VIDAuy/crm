const url_operaciones = `${url_app}/php/ajax/operaciones/`;


function mostrar_contenido(div) {
    let array = [
        "gestionar_items_menu",
        "gestionar_menu_por_area",
        "gestionar_menu_por_usuario",
        "gestionar_contenido",
        "gestionar_contenido_por_area",
        "gestionar_usuarios",
        "gestionar_sub_usuarios",
        "gestionar_registros",
    ];

    array.map((val) => {
        $(`#${val}`).css("display", "none");
    });

    $(`#${div}`).css("display", "block");
}


function desestimar_baja(openModal = false) {
    if (openModal == true) {
        $("#modal_desestimarBaja").modal("show");
    } else {
        let cedula = $("#txt_cedula").val();

        if (cedula == "") {
            error("Debe ingresar una cédula");
        } else if (controlCedula(cedula) == false) {
            error("Debe ingresar una cédula válida");
        } else {

            $.ajax({
                type: "POST",
                url: `${url_operaciones}desestimar_baja.php`,
                data: {
                    cedula
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.error === false) {
                        correcto(response.mensaje);
                        tabla_registros();
                    } else {
                        error(response.mensaje);
                    }
                }
            });

        }
    }
}




function select_areas(opcion, div, id_area, nombre_area) {

    let option = opcion == "Agregar" ? `<option value='' selected>Seleccione un área</option>` : `<option value='${id_area}' selected>${nombre_area}</option>`;
    let params = opcion == "Agregar" ? "" : `id_area=${id_area}`;

    document.getElementById(div).innerHTML = `${option}`;

    $.ajax({
        type: "GET",
        url: `${url_operaciones}select_areas.php?${params}`,
        dataType: "JSON",
        beforeSend: function () {
            loading(true);
        },
        complete: function () {
            loading(false);
        },
        success: function (response) {
            let datos = response.datos;
            datos.map((val) => {
                document.getElementById(div).innerHTML += `<option value="${val['id']}">${val['usuario']}</option>`;
            });
        }
    });

}



function select_items(id_div) {
    let div = document.getElementById(id_div);
    div.innerHTML = '<option selected value="">Seleccione una opción</option>';

    $.ajax({
        url: `${url_operaciones}select_items.php`,
        dataType: 'JSON',
        beforeSend: function () {
            loading(true);
        },
        complete: function () {
            loading(false);
        },
        success: function (r) {
            $.each(r.datos, function (i, v) {
                div.innerHTML += `<option value="${v.id}">${v.nombre}</option>`;
            });
        },
    });
}


function select_areas_con_identificacion(opcion, div, id_area, nombre_area) {

    let option = opcion == "Agregar" ? `<option value='' selected>Seleccione un área</option>` : `<option value='${id_area}' selected>${nombre_area}</option>`;
    let params = opcion == "Agregar" ? "" : `id_area=${id_area}`;

    document.getElementById(div).innerHTML = `${option}`;

    $.ajax({
        type: "GET",
        url: `${url_operaciones}select_areas_con_identificacion.php?${params}`,
        dataType: "JSON",
        beforeSend: function () {
            loading(true);
        },
        complete: function () {
            loading(false);
        },
        success: function (response) {
            let datos = response.datos;
            datos.map((val) => {
                document.getElementById(div).innerHTML += `<option value="${val['id']}">${val['usuario']}</option>`;
            });
        }
    });

}


function select_usuarios_del_area(id_div, id_area) {

    $(`#${id_div}`).prop('disabled', false);

    let div = document.getElementById(id_div);
    div.innerHTML = '<option selected value="">Seleccione una opción</option>';

    $.ajax({
        url: `${url_operaciones}select_usuarios_del_area.php?id_area=${id_area}`,
        dataType: 'JSON',
        beforeSend: function () {
            loading(true);
        },
        complete: function () {
            loading(false);
        },
        success: function (r) {
            $.each(r.datos, function (i, v) {
                div.innerHTML += `<option value="${v.id}">${v.nombre}</option>`;
            });
        },
    });

}


function select_contenido(opcion, div, id_contenido, nombre_contenido) {

    let option = opcion == "Agregar" ? `<option value='' selected>Seleccione un contenido</option>` : `<option value='${id_contenido}' selected>${nombre_contenido}</option>`;
    let params = opcion == "Agregar" ? "" : `id_contenido=${id_contenido}`;

    document.getElementById(div).innerHTML = `${option}`;

    $.ajax({
        type: "GET",
        url: `${url_operaciones}select_contenido.php?${params}`,
        dataType: "JSON",
        beforeSend: function () {
            loading(true);
        },
        complete: function () {
            loading(false);
        },
        success: function (response) {
            let datos = response.datos;
            datos.map((val) => {
                document.getElementById(div).innerHTML += `<option value="${val['id']}">${val['nombre']}</option>`;
            });
        }
    });

}