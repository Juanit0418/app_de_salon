<h1 class="nombre_pagina">Recuperar Contraseña</h1>
<p class="descripcion_pagina">Reestablece tu contraseña</p>
<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<?php if($error){return;} ?>

<form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Nueva Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu nueva contraseña">
    </div>

    <input type="submit" class="boton" value="Reestablecer Contraseña">
</form>

<div class="acciones">
  <a href="crear_cuenta">¿No tienes una cuenta? Crea una</a>
  <a href="/">¿Recordaste tu contraseña? Inicia Sesión</a>
</div> <!-- acciones -->