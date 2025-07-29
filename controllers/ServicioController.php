<?php
namespace Controller;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        session_start();
        admin();

        $servicios = Servicio::all();

        $router->vista("servicios/index", [
            "nombre" => $_SESSION["nombre"],
            "servicios" => $servicios
        ]);
    }

    public static function crear(Router $router){
        session_start();
        admin();

        $servicio = new Servicio;
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicio->sincronizar($_POST); //Sincroniza con los datos del post
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header("Location: /admin/servicios");
                exit;
            };
        };

        $router->vista("servicios/crear", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    public static function actualizar(Router $router){
        session_start();
        admin();

        if (!isset($_GET["id"])) {
            $_SESSION = [];
            session_destroy();
            header("Location: /404");
            exit;
        }

        $id = s($_GET["id"]);
        $es_numero = is_numeric($id);
        if(!$es_numero){
            $_SESSION = [];
            session_destroy();

            header("Location: /404");
            exit;
        };
        $servicio = Servicio::find($id);
        $alertas = [];

        

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header("Location: /admin/servicios");
            };
        };

        $router->vista("servicios/actualizar", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    public static function eliminar(){
        session_start();
        admin();
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if (!isset($_POST["id"])) {
            $_SESSION = [];
            session_destroy();
            header("Location: /404");
            exit;
        }

        $id = s($_POST["id"]);
        $es_numero = is_numeric($id);
        if(!$es_numero){
            $_SESSION = [];
            session_destroy();

            header("Location: /404");
            exit;
        };
        $servicio = Servicio::find($id);
        $servicio->eliminar();
        header("Location: /admin/servicios");

        };
    }
}
?>