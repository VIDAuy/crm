<input type="hidden" id="sector" value="<?= ucfirst($_SESSION['usuario']) ?>">
<input type="hidden" id="nivel" value="<?= $_SESSION['nivel'] ?>">
<input type="hidden" id="idrelacion">
<nav class="navbar navbar-dark bg-dark text-white mb-4">
	<a class="navbar-brand">Menú</a>
	<h3 class="form-inline" id="nombre_usuario_en_sesion"></h3>
	<form class="form-inline">
		<!--
		<button class="btn btn-outline-danger" style="float: right" onclick="cerrarSesion()">Cerrar sesión</button>
		-->
		<a class="btn btn-outline-danger" style="float: right" href="cerrarSesion.php" onclick="cerrarSesion()">Cerrar sesión</a>
	</form>
</nav>
<div class="container" align="center">
	<h2 style="color:#FB0B0F">CRM</h2>
	<div style="display: flex; justify-content: space-between; align-items: center;">
		<div id="q" style="visibility: hidden;">
			<button type="button" class="btn btn-primary" onclick="datosAlertas()">ALERTAS <span id="bq" class="badge badge-light rounded-circle">?</span></button>
		</div>
	</div>
</div>
<div class="container mt-3">
	<input type="text" class="form-control solo_numeros" id="ci" name="ci" placeholder="Ingrese Cedula a Buscar" oninput="ocultarContenido()" style="margin-bottom: 3px;" maxlength="8">
</div>
<div class="container my-1">
	<input type="button" class="btn btn-primary btn-block" value="Buscar" title="Buscar" onclick="buscar();" id="buscarCI">
</div>