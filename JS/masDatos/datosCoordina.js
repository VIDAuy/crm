function datosCoordina() {
	$('#b1').prop("disabled", true);
	$('#b1').val('Cargando...');
	$.ajax(
		{
			url: 'PHP/AJAX/masDatos/datosCoordina.php',
			dataType: 'JSON',
			data:
			{
				CI: $('#cedulas').text()
			}
		})
		.done(function (datos) {
			if (datos.error) {
				$('#b1').val('Coordinación (sin registros)');
				alert(datos.mensaje);
			} else {
				$('#tbodyMDCoo tr').remove();
				$.each(datos, function (index, el) {
					let nuevaLinea =
						'<tr>' +
						'<td scope="row">' + el.id + '</td>' +
						'<td>' + el.observacion + '</td>' +
						'<td>' + el.fecha_inicio + '</td>' +
						'<td>' + el.fecha_fin + '</td>' +
						'<td>' + el.hora_inicio + '</td>' +
						'<td>' + el.hora_fin + '</td>' +
						'<td>' + el.horas_x_dia + '</td>' +
						'<td>' + el.lugar + '</td>' +
						'<td>' + el.estado + '</td>' +
						'<td>' + el.patologia + '</td>' +
						'</tr>';
					$(nuevaLinea).appendTo('#tbodyMDCoo');
				});
				$('#modalDatosCoordina').modal('show');
				$('#b1').prop("disabled", false);
				$('#b1').val('Coordinación');
			}
		})
		.fail(function () {
			console.log("error");
		})
}