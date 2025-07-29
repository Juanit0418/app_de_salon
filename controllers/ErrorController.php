<?php
namespace Controller;
use MVC\Router;

class ErrorController {
    public static function error_404(Router $router){
        $router->vista("error/404");
    }

    public static function restringido(Router $router){
        $router->vista("error/restringido");
    }
}

?>