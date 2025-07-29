<?php
namespace Model;

class Cita extends ActiveRecord {
    protected static $tabla = "citas";
    protected static $columnasDB = ["id", "fecha", "hora", "usuario_id"];

    public $id;
    public $fecha;
    public $hora;
    public $usuario_id;

    public function __construct($arreglo = []){
        $this->id = $arreglo["id"] ?? null;
        $this->fecha = $arreglo["fecha"] ?? "";
        $this->hora = $arreglo["hora"] ?? "";
        $this->usuario_id = $arreglo["usuario_id"] ?? "";
    }


}

?>