function datosCobranza() {
	$('#b2').prop("disabled", true);
	$('#b2').val('Cargando...');
	$("#example4").DataTable().destroy();
	$("#tbodyMDC tr").remove();
	if ($('#cedulas').text() == '') {
		error('Antes de consultar los datos debe ingresar una cédula');
	}
	else {
		$.ajax(
			{
				url: 'PHP/AJAX/masDatos/datosCobranza.php',
				dataType: 'JSON',
				data:
				{
					CI: $('#cedulas').text()
				},
			})
			.done(function (datos) {
				if (datos.sinCuotas) {
					error(datos.mensaje);
					$('#b2').val('Sin datos de cobranza');
				}
				else {
					$.each(datos, function (index, el) {
						let nuevaLinea =
							'<tr>' +
							'<th>' + el.mes + '</th>' +
							'<th>' + el.anho + '</th>' +
							'<th>$' + el.importe + '</th>' +
							'<th>' + el.cobrado + '</th>' +
							'</tr>';
						$(nuevaLinea).appendTo('#tbodyMDC');
					});
					$("#example4").DataTable(
						{
							searching: true,
							paging: true,
							lengthChange: false,
							ordering: true,
							info: true,
							order: [1, 'asc'],
							columnDefs:
								[
									{
										targets: [0],
										orderData: [0, 1]
									}, {
										targets: [3],
										orderData: [3, 0]
									}
								],
							language:
							{
								zeroRecords: "No se encontraron registros.",
								info: "Pagina _PAGE_ de _PAGES_",
								infoEmpty: "No Hay Registros Disponibles",
								infoFiltered: "(filtrado de _MAX_ hasta records)",
								search: "Buscar:",
								paginate:
								{
									first: "Primero",
									last: "Último",
									next: "Siguiente",
									previous: "Anterior"
								},
							}
						});
					stateSave: true
					$('[type="search"]').addClass('form-control-static');
					$('[type="search"]').css({ borderRadius: '5px' });
					$('#modalDatosCobranza').modal('show');
					$('#b2').prop("disabled", false);
					$('#b2').val('Cobranza');
				}
			})
			.fail(function () {
				console.log("error");
			})
	}
}