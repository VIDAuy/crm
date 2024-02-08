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


<div class="container">

	<h2 class="text-center" style="color:#FB0B0F">CRM</h2>
	<div class="d-flex justify-content-end">
		<div id="q" style="visibility: hidden;">
			<button type="button" class="btn btn-primary rounded position-relative" onclick="datosAlertas()">
				Alertas
				<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="bq">0+</span>
			</button>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="col-auto">
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Cédula:</span>

					<input type="text" class="form-control solo_numeros" id="ci" name="ci" placeholder="Ingrese cédula a buscar ..." aria-label="Ingrese cédula a buscar ..." aria-describedby="basic-addon1" oninput="ocultarContenido()" maxlength="8">

					<button class="btn btn-danger input-group-text" id="buscarCI" onclick="buscar();">Buscar 🔍</button>
				</div>
			</div>
		</div>
	</div>

</div>