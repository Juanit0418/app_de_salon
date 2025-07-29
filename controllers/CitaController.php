<?php
namespace Controller;
use MVC\Router;

class CitaController {
    public static function index(Router $router) {
        session_start();
        usuario();
        $nombre = $_SESSION['nombre'];
        $id = $_SESSION["id"];
        
        $router->vista('cita/index', [
            "nombre" => $nombre,
            "id" => $id
        ]);
    }
}

?>