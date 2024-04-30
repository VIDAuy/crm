<!-- Etiquetas Del Socio -->
<div class="container" id="contenedor_etiquetas_de_socio" style="display: none">

    <div class="hstack gap-3">
        <div id="contenedor_auditorias_socio">
            <div class="p-2" id="div_auditorias_socio"></div>
        </div>
        <div id="contenedor_socio_equifax">
            <div class="p-2" id="div_socio_equifax"></div>
        </div>
        <div class="p-2 ms-auto">
            <button type="button" class="btn btn-secondary position-relative" onclick="ver_etiquetas_socio()">
                Ver etiquetas de socio
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cantidad_etiquetas_socio">
                </span>
            </button>
        </div>
        <div class="p-2" id="div_agregarEtiquetaSocio" style="display: none;">
            <button class="btn btn-success" onclick="agregar_etiqueta_socio(true)">Agregar etiqueta a
                socio</button>
        </div>
    </div>
</div>
<!-- End Etiquetas Del Socio -->