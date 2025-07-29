<h1 class="nombre_pagina">Olvidé mi Contraseña</h1>
<p class="descripcion_pagina">Reestablece tu contraseña escribiendo tu correo electrónico</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<form class="formulario" method="POST" action="olvide">
    <div class="campo">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo electrónico"/>
    </div>

    <input type="submit" value="Enviar Instrucciones" class="boton">
</form>

<div class="acciones">
  <a href="crear_cuenta">¿No tienes una cuenta? Crea una</a>
  <a href="/">¿Recordaste tu contraseña? Inicia Sesión</a>
</div> <!-- acciones -->