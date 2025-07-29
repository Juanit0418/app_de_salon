<h1 class="nombre_pagina">Panel de Administracion</h1>

<?php include_once __DIR__ . "/../templates/barra.php"; ?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario" method="GET" action="">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php
if(count($citas) === 0){
    echo "<h2>No hay citas disponibles en esta fecha</h2>";
};
?>

<div id="citas_admin">
    <ul class="citas">
        <?php
        $id_cita = 0;
        $primera_iteracion = true;
        $total = 0;

        foreach($citas as $index => $cita) {
            // Si cambia la cita, cerramos la anterior
            if ($id_cita !== $cita->id) {
                // Cierra cita anterior si no es la primera
                if (!$primera_iteracion) {
                    echo "<p>Total: <span>$" . number_format($total, 2) . "</span></p>";
                    ?>
                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id_cita; ?>">
                        <input type="submit" class="boton_eliminar" value="Eliminar">
                    </form>
                    <?php
                    echo "</li>";
                } else {
                    $primera_iteracion = false;
                }

                // Inicia nueva cita
                echo "<li>";
                echo "<p><span>ID: </span>{$cita->id}</p>";
                echo "<p><span>Cliente: </span>{$cita->cliente}</p>";
                echo "<p><span>Hora: </span>{$cita->hora}</p>";
                echo "<p><span>Correo: </span>{$cita->correo}</p>";
                echo "<p><span>Teléfono: </span>{$cita->telefono}</p>";
                echo "<h3>Servicios</h3>";

                $id_cita = $cita->id;
                $total = 0;
            }

            // Mostrar servicio y sumar al total
            echo "<p class='servicio'>{$cita->servicio} <span>$" . number_format($cita->precio, 2) . "</span></p>";
            $total += $cita->precio;
        }

        // Después del foreach: cerrar la última cita
        if (!$primera_iteracion) {
            echo "<p>Total: <span>$" . number_format($total, 2) . "</span></p>";
            ?>
            <form action="/api/eliminar" method="POST">
                <input type="hidden" name="id" value="<?php echo $id_cita; ?>">
                <input type="submit" class="boton_eliminar" value="Eliminar">
            </form>
            <?php
            echo "</li>";
        }
        ?>
    </ul>
</div>


<?php 
$script = "<script src='build/js/buscador.js'></script>";

?>