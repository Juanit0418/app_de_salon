<?php
namespace Controller;

use Model\Admin;
use Model\AdminCita;
use MVC\Router;

class AdminController{
    public static function index(Router $router){
        session_start();
        admin();

        $fecha = $_GET['fecha'] ?? date("Y-m-d");
        $fecha_separada = explode("-", $fecha);
        $fecha_existe = checkdate($fecha_separada[1], $fecha_separada[2], $fecha_separada[0]);
        if(!$fecha_existe){
            header("Location: /404");
        };


        //Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente, usuarios.correo, usuarios.telefono, servicios.nombre as servicio, servicios.precio FROM citas ";
        $consulta .= "LEFT OUTER JOIN usuarios ON citas.usuario_id = usuarios.id "; 
        $consulta .= "LEFT OUTER JOIN citas_servicios ON citas_servicios.cita_id = citas.id ";
        $consulta .= "LEFT OUTER JOIN servicios ON servicios.id = citas_servicios.servicio_id ";
        $consulta .= "WHERE fecha = '{$fecha}'";

        $citas = AdminCita::sql($consulta);

        $router->vista("admin/index", [
            "nombre" => $_SESSION["nombre"],
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }
}

?>