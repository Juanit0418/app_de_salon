<h1 class="nombre_pagina">Login</h1>
<p class="descripcion_pagina">Iniciar Sesión</p>

<?php
include_once __DIR__ . "/../templates/alertas.php"; 
?>

<form method="POST" class="formulario" action="">
  <div class="campo">
    <label for="correo">Correo</label>
    <input type="email" id="correo" name="correo" placeholder="Ingresa tu Correo electrónico" >
  </div> <!-- campo -->

  <div class="campo">
    <label for="password">contraseña</label>
    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" >
  </div> <!-- campo -->

  <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
  <a href="crear_cuenta">¿No tienes una cuenta? Crea una</a>
  <a href="olvide">¿Olvidaste tu contraseña?</a>
</div> <!-- acciones -->