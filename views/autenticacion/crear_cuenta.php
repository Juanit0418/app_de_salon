<h1 class="nombre_pagina">Crear Cuenta</h1>
<p class="descripcion_pagina">Ingresa tus datos para crear tu cuenta</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<form class="formulario" method="POST" action="crear_cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" value="<?php echo s($usuario->nombre) ?>" />
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido" value="<?php echo s($usuario->apellido) ?>" />
    </div>

    <div class="campo">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo electrónico" value="<?php echo s($usuario->correo) ?>" />
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" value="<?php echo s($usuario->telefono) ?>" />
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Crea una Contraseña" />
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
  <a href="/">¿Ya estás registrado? Inicia Sesión</a>
  <a href="olvide">¿Olvidaste tu contraseña?</a>
</div> <!-- acciones -->