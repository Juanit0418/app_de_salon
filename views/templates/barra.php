<div class="barra">
    <p>Hola <?php echo $nombre ?? "" ?></p>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>
<?php
if($_SESSION["admin"] === 1){ ?>
        <div class="barra_servicios">
            <a class="boton" href="/admin">Citas</a>
            <a class="boton" href="/admin/servicios">Servicios</a>
            <a class="boton" href="/admin/servicios/crear">Nuevo Servicio</a>
        </div>
<?php }; ?>
