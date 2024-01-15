$(document).ready(function () {
  eliminar_local_storage();

  ejecutar_acciones_sesion();
});

function eliminar_local_storage() {
  localStorage.clear();
  localStorage.setItem('status', 'ok');
  $('.ctr_agendar_volver_a_llamar').css('display', 'none');
  $('.administrar_pendientes').css('display', 'none');
}

function ejecutar_acciones_sesion() {
  let sector = $('#sector').val();
  if (
    sector == 'Recepcion' ||
    sector == 'Morosos' ||
    sector == 'Calidad' ||
    sector == 'Servicios' ||
    sector == 'Coordinacion' ||
    sector == 'Bajas' ||
    sector == 'Calidad_interna'
  ) {
    comprobar_evacion_extender_sesion();

    (function ($) {
      var timeout;
      $(document).on('mousemove', function (event) {
        if (timeout !== undefined) {
          window.clearTimeout(timeout);
        }
        timeout = window.setTimeout(function () {
          let cedula = localStorage.getItem('cedula');
          if (cedula != null) {
            //Creas una funcion nueva para jquery
            $(event.target).trigger('mousemoveend');
          }
        }, 600000); //Determinas el tiempo en milisegundo aquí, 10 minutos en 600000 milisegundos
      });
    })(jQuery);
  }
}

function comprobar_evacion_extender_sesion() {
  let status = localStorage.getItem('status');
  if (status == 'pendiente') {
    cerrarSesion();
  }
}

$(document).on('mousemoveend', function () {
  $('#txt_cedula_sesion_expirada').val('');
  $('#modal_sesionExpirada').modal({ backdrop: 'static', keyboard: false });
  $('#modal_sesionExpirada').modal('show');
  localStorage.setItem('status', 'pendiente');
});

function extender_sesion() {
  let cedula = $('#txt_cedula_sesion_expirada').val();
  let cedula_registrada = localStorage.getItem('cedula');
  localStorage.setItem('status', 'pendiente');

  if (cedula == '') {
    error('Debe ingresar su cédula');
    localStorage.setItem('status', 'pendiente');
  } else if (cedula != cedula_registrada) {
    localStorage.clear();
    location.href = `http://192.168.1.250:82/${app}/cerrarSesion.php`;
    localStorage.setItem('status', 'pendiente');
  } else {
    correcto_pasajero('¡Su sesión se ha extendido!');
    $('#modal_sesionExpirada').modal('hide');
    localStorage.setItem('status', 'ok');
  }
}

function cerrarSesion() {
  location.href = `http://192.168.1.250:82/${app}/cerrarSesion.php`;
  localStorage.clear();
}
