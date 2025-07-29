<?php
date_default_timezone_set('America/Guayaquil'); // o la zona que corresponda a tu país
?>


<h1 class="nombre_pagina">Crear nueva cita</h1>

<?php include_once __DIR__ . "/../templates/barra.php"; ?>

<p class="descripcion_pagina">Elige tus servicios y fecha</p>

<div id="app">
    <nav class="tabs">
        <button class="actual" data-paso="1">Servicios</button>
        <button data-paso="2">Datos y Cita</button>
        <button data-paso="3">Resumen</button>
    </nav>
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p>Elige los servicios</p>

        <div id="servicios" class="listado_servicios">

        </div>
    </div> <!-- Paso seccion -->

    <div id="paso-2" class="seccion">
        <h2>Datos y Cita</h2>
        <p>Agrega tus datos y elige tu cita</p>

        <form id="formulario" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" placeholder="Ingresa tu nombre" value="<?php echo $nombre; ?>" disabled>
            </div>

            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" min="<?php echo date("Y-m-d"); ?>">
            </div>

            <div class="campo">
                <label for="hora">Hora:</label>
                <input type="time" id="hora">
            </div>

            <input type="hidden" id="id" value="<?php echo $id; ?>">

        </form>
    </div> <!-- Paso seccion -->

    <div id="paso-3" class="seccion resumen">
        <h2>Resumen</h2>
        <p class="texto_centrado">Verifica la información</p>
        <div class="contenido_resumen">

        </div>

        <div class="informacion_cita">

        </div>
    </div> <!-- Paso seccion -->

    <div class="paginacion">
        <button class="boton" id="anterior">&laquo; Anterior</button>
        <button class="boton" id="siguiente">Siguiente &raquo;</button>
    </div>
</div> <!-- app -->

<?php 
$script = "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src='build/js/app.js'></script>
";
?>