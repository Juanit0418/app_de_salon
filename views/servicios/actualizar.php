<h1 class="nombre_pagina">Actualizar Servicio</h1>

<?php
include_once __DIR__ . "/../templates/barra.php";
?>

<h2 class="descripcion_pagina descripcion_centrada">Actualiza el servicio</h2>

<?php
include_once __DIR__ . "/../templates/alertas.php"; 
?>

<form method="POST" class="formulario">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    <input type="submit" class="boton" value="Guardar Cambios"> 
</form>