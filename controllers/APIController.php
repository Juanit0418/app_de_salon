<?php 
namespace Controller;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {
    public static function index(){
        $servicio = Servicio::all();

        echo json_encode($servicio);
    }

    public static function guardar(){
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        //Almacena los servicios con el id dela cita
        $id = $resultado["id"];
        $id_servicios = explode(",", $_POST["servicios"]);
        foreach($id_servicios as $id_servicio){
            $arreglo = [
                "cita_id" => $id,
                "servicio_id" => $id_servicio
            ];
            $cita_servicio = new CitaServicio($arreglo);
            $cita_servicio->guardar();
        };

        //Retornamos una respuesta
        $respuesta = [
            "resultado" => $resultado
        ];


        echo json_encode($respuesta);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $cita = Cita::find($id);
            $cita->eliminar();
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        };
    }
}

?>