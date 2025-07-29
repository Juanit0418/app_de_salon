<?php
namespace Model;

class CitaServicio extends ActiveRecord{
    protected static $tabla = "citas_servicios";
    protected static $columnasDB = ["id", "cita_id", "servicio_id"];

    public $id;
    public $cita_id;
    public $servicio_id;

    public function __construct($arreglo = []){
        $this->id = $arreglo["id"] ?? null;
        $this->cita_id = $arreglo["cita_id"] ?? "";
        $this->servicio_id = $arreglo["servicio_id"] ?? "";
    }
}


?>