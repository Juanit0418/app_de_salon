<h1 class="nombre_pagina">Nuevo Servicio</h1>

<?php
include_once __DIR__ . "/../templates/barra.php";
?>

<h2 class="descripcion_pagina descripcion_centrada">Agrega el nuevo servicio</h2>

<?php
include_once __DIR__ . "/../templates/alertas.php"; 
?>

<form action="/admin/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    <input type="submit" class="boton" value="Agregar Servicio"> 
</form>