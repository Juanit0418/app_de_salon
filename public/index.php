<?php 

require_once __DIR__ . '/../includes/app.php';

use Controller\AdminController;
use Controller\CitaController;
use Controller\LoginController;
use Controller\APIController;
use Controller\ErrorController;
use Controller\ServicioController;
use MVC\Router;

$router = new Router();

//Error 404
$router->get("/404", [ErrorController::class, "error_404"]);
$router->get("/restringido", [ErrorController::class, "restringido"]);

//Iniciar Sesión
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);

//Recuperar Contraseña
$router->get("/olvide", [LoginController::class, "olvide"]);
$router->post("/olvide", [LoginController::class, "olvide"]);
$router->get("/recuperar", [LoginController::class, "recuperar"]);
$router->post("/recuperar", [LoginController::class, "recuperar"]);

//Crear cuenta
$router->get("/crear_cuenta", [LoginController::class, "crear"]);
$router->post("/crear_cuenta", [LoginController::class, "crear"]);

//Confirmar cuenta
$router->get("/mensaje", [LoginController::class, "mensaje"]);
$router->get("/confirmar_cuenta", [LoginController::class, "confirmar"]);

//Area Privada
$router->get("/cita", [CitaController::class, "index"]);
$router->get("/admin", [AdminController::class, "index"]);

//Api de citas
$router->get("/api/servicios", [APIController::class, "index"]);
$router->post("/api/citas", [APIController::class, "guardar"]);
$router->post("/api/eliminar", [APIController::class, "eliminar"]);

//Crud de servicios
$router->get("/admin/servicios", [ServicioController::class, "index"]);
$router->get("/admin/servicios/crear", [ServicioController::class, "crear"]);
$router->post("/admin/servicios/crear", [ServicioController::class, "crear"]);
$router->get("/admin/servicios/actualizar", [ServicioController::class, "actualizar"]);
$router->post("/admin/servicios/actualizar", [ServicioController::class, "actualizar"]);
$router->post("/admin/servicios/eliminar", [ServicioController::class, "eliminar"]);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();