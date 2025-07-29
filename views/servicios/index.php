<h1 class="nombre_pagina">Servicios</h1>
<p class="descripcion_pagina descripcion_centrada">Administración de servicios</p>

<?php
include_once __DIR__ . "/../templates/barra.php";
?>

<ul class="servicios">
    <?php foreach($servicios as $servicio){ ?>
        <li>
            <p><span>ID: </span> <?php echo $servicio->id; ?></p>
            <p><span>Nombre: </span> <?php echo $servicio->nombre; ?></p>
            <p><span>Precio: </span> <?php echo "$" . $servicio->precio; ?></p>

            <div class="acciones">
                <a href="/admin/servicios/actualizar?id=<?php echo $servicio->id; ?>" class="boton_1">Actualizar</a>

                <form action="/admin/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <input type="submit" value="Eliminar" class="boton_eliminar">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>