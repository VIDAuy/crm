function datosProductos()
{
	$('#b3').prop("disabled", true);
	$('#b3').val('Cargando...');
	$('#tbodyMDP tr').remove();
	$.ajax(
	{
		url: 'PHP/AJAX/masDatos/datosProductos.php',
		dataType: 'JSON',
		data: {cedula: $('#cedulas').text()},
		success: function(content)
		{
			if(content.error){
				$('#b3').val('Sin Productos');
				alert(content.mensaje);
			}
			else
			{
				$.each(content, function(index, el)
				{
					nuevoServicio = '<tr>' +
										'<td><input type="text" value="'+ el.nroServicio +'"	readonly class="form-control"></td>'+
										'<td><input type="text" value="'+ el.servicio +'"		readonly class="form-control"></td>'+
										'<td><input type="text" value="'+ el.horas +'"			readonly class="form-control"></td>'+
										'<td><input type="text" value="$'+ el.importe +'"		readonly class="form-control"></td>'+
									'</tr>';
					$(nuevoServicio).appendTo('#tbodyMDP');
				});
			}
			$('#modalDatosProductos').modal('show');
			$('#b3').prop("disabled", false);
			$('#b3').val('Productos');
		},
		error: function()
		{
			alert('Ha ocurrido un error inesperado, por favor comuníquese con el administrador.');
		}
	});
};