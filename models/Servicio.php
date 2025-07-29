<?php 
namespace Model;

class Servicio extends ActiveRecord {
    //Base de datos
    protected static $tabla = "servicios";
    protected static $columnasDB = ["id", "nombre", "precio"];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($arreglo = []){
        $this->id = $arreglo["id"] ?? null;
        $this->nombre = $arreglo["nombre"] ?? "";
        $this->precio = $arreglo["precio"] ?? "";
    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas["errores"][] = "El nombre es obligatorio";
        };

        if(!$this->precio){
            self::$alertas["errores"][] = "El precio es obligatorio";
        } else {
            if(!is_numeric($this->precio)){
            self::$alertas["errores"][] = "El precio no es válido";
        };
        };

        return self::$alertas;
    }
}



?>