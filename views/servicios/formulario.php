<div class="campo">
    <label for="nombre">Nombre: </label>
    <input type="text" id="nombre" name="nombre" placeholder="Ingresa el nombre del servicio" value="<?php echo $servicio->nombre; ?>">
</div>

<div class="campo">
    <label for="precio">Precio: </label>
    <input type="number" id="precio" name="precio" min="0.01" max="999.99" step="0.01" placeholder="Ingresa el precio del servicio" value="<?php echo $servicio->precio; ?>">
</div>