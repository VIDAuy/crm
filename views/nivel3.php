<script>
	$(function() {
		$('#ci').keypress(function(e) {
			if (e.which == 13) {
				buscar();
			}
		});
	})
</script>
<input type="hidden" id="sector" value="<?= ucfirst($_SESSION['usuario']) ?>">
<input type="hidden" id="nivel" value="<?= $_SESSION['nivel'] ?>">
<input type="hidden" id="idrelacion">


<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
	<div class="container-fluid">
		<a class="navbar-brand">Menú</a>
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="navbar-brand fw-bolder" href="#" id="nombre_usuario_en_sesion"></a>
			</li>
		</ul>
		<div class="d-flex">
			<a class="btn btn-outline-danger" href="cerrarSesion.php" onclick="cerrarSesion()">Cerrar sesión</a>
		</div>
	</div>
</nav>


<div class="container" align="center">
	<h2 style="color:#FB0B0F">CRM</h2>
	<div style="display: flex; justify-content: space-between; align-items: center;">
		<a href="http://192.168.1.13/call/panel_calidad" class="btn btn-primary position-relative" target="_blank">
			Afiliaciones competencia / Convenios especiales
			<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="badgeAfiliacionesCompetencia">0+</span>
		</a>
		<div id="q" style="visibility: hidden;">
			<button type="button" class="btn btn-primary rounded position-relative" onclick="datosAlertas()">
				Alertas
				<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="bq">0+</span>
			</button>
		</div>
	</div>
</div>
<div class="d-flex justify-content-center">
	<div class="container mt-5 mb-3">
		<div class="row">
			<div class="col-lg-6">
				<div class="col-auto">
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Cédula:</span>
						<?php
						if ($_SESSION['usuario'] == 'Morosos' || $_SESSION['usuario'] == 'Calidad_interna') {
							echo '<input type="text" class="form-control" id="ci" name="ci" placeholder="Ingrese cédula a buscar ..." aria-label="Ingrese cédula a buscar ..." aria-describedby="basic-addon1" oninput="ocultarContenido()" maxlength="8">

							<button class="btn btn-danger input-group-text" id="buscarCI" onclick="buscarDatos();">Buscar 🔍</button>';
						} else {
							echo '<input type="text" class="form-control solo_numeros" id="ci" name="ci" placeholder="Ingrese cédula a buscar ..." aria-label="Ingrese cédula a buscar ..." aria-describedby="basic-addon1" oninput="ocultarContenido()" maxlength="8">

							<button class="btn btn-danger input-group-text" id="buscarCI" onclick="buscarSocio();">Buscar 🔍</button>';
						}
						?>
					</div>
				</div>
			</div>
			<?php
			if ($_SESSION['usuario'] == 'Morosos' || $_SESSION['usuario'] == 'Calidad_interna') {
				echo '<div class="col-lg-3"><div class="form-check">
					<input class="form-check-input" type="radio" name="radioBuscar" id="buscarSocio" value="socio" checked>
					<label class="form-check-label" for="buscarSocio">
						Socio
					</label>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="radioBuscar" id="buscarFuncionario" value="funcionario">
					<label class="form-check-label" for="buscarFuncionario">
						Funcionario
					</label>
				</div>
			</div>';
			}
			?>
		</div>
	</div>
</div>
<div class="container">
	<span style="float: right">
		<?php
		if ($_SESSION['usuario'] == 'Calidad' || $_SESSION['usuario'] == 'Bajas') {
			echo '<input type="button" class="btn btn-success" value="Gestionar bajas" onclick="corroborarBajas();">';
		}
		?>
		<!-- <input type="button" class="btn btn-success" value="Gestionar bajas" onclick="corroborarBajas();"> -->
		<!-- <input type="button" id="botonHistorialDeBajas" class="btn btn-primary" value="Ver historial de bajas" onclick="historialDeBajas();"> -->
		<a class="btn btn-primary" href="http://192.168.1.250:82/crm/reportes_bajas.html" target="_blank">Ver historial de bajas</a>
		<?php
		if ($_SESSION['usuario'] == 'Calidad') {
			echo '<button type="button" class="btn btn-primary position-relative" onclick="ir_a_vida_te_lleva()">
					Alerta Vida te lleva 🔔
						<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cantidad_pendientes_vida_te_lleva"></span>
				</button>';
		}
		?>
	</span>

	<input type="button" class="btn btn-danger" value="Solicitar la baja" onclick="listarDatos($('#ci').val());">
</div>


<?php
if ($_SESSION['usuario'] == 'Morosos' || $_SESSION['usuario'] == 'Calidad_interna') {
	echo '<br>
	<div class="container">
		<hr class="style5 container">
			<div class="alert alert-dark border border-dark" role="alert">
				<button class="btn btn-primary" onclick="cargar_documento_y_alertar()">Cargar Documento 📃</button>
					<span style="float: right">
						<button type="button" class="btn btn-primary position-relative" onclick="alertas_de_documentos_cargados()">
							Alertas de funcionarios 🔔
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cantidad_pendientes_leer"></span>
						</button>
					</span>
			</div>
	</div>';
}
?>

<br>

<?php
if ($_SESSION['usuario'] != 'Audit1' && $_SESSION['usuario'] != 'Audit2' && $_SESSION['usuario'] != 'Audit3') {
	echo '<div class="container">
	<hr class="style5 container">
	<div class="alert alert-dark border border-dark" role="alert">
		<div class="row">
			<div class="col-3">
				<button type="button" class="btn btn-info position-relative" onclick="abrir_agenda_volver_a_llamar(true)">
					Agenda volver a llamar 📞
					<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cantidad_pendientes_volver_a_llamar"></span>
				</button>
			</div>
			<div class="col-3">
				<button type="button" class="btn btn-info position-relative" onclick="ver_registros_volver_a_llamar()">
					Historial de volver a llamar
				</button>
			</div>
			<div class="col-3">
				<button type="button" class="btn btn-info position-relative" onclick="ver_registros_alertas()">
					Historial de alertas
				</button>
			</div>
			<div class="col-3">
				<button type="button" class="btn btn-warning position-relative" onclick="enviar_terminos_y_condiciones_socio(true)">
					Enviar términos y condiciones 📲
				</button>
			</div>
		</div>
	</div>
</div>';
}
?>