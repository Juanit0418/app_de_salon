<?php
namespace Model;

class AdminCita extends ActiveRecord{
    protected static $tabla = "citas_servicios";
    protected static $columnasDB = ["id", "hora", "cliente", "correo", "telefono", "servicio", "precio"];

    public $id;
    public $hora;
    public $cliente;
    public $correo;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($arreglo = []){
        $this->id = $arreglo["id"] ?? null;
        $this->hora = $arreglo["hora"] ?? "";
        $this->cliente = $arreglo["cliente"] ?? "";
        $this->correo = $arreglo["correo"] ?? "";
        $this->telefono = $arreglo["telefono"] ?? "";
        $this->servicio = $arreglo["servicio"] ?? "";
        $this->precio = $arreglo["precio"] ?? "";
    }
}

?>