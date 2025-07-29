<?php

namespace MVC;

class Router
{
    public array $get_rutas = [];
    public array $post_rutas = [];

    public function get($url, $funcion)
    {
        $this->get_rutas[$url] = $funcion;
    }

    public function post($url, $funcion)
    {
        $this->post_rutas[$url] = $funcion;
    }

    public function comprobarRutas()
    {
        
        // Proteger Rutas...
        // session_start();

        // Arreglo de rutas protegidas...
        // $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        // $auth = $_SESSION['login'] ?? null;

        $url_actual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method === 'GET') {
            $funcion = $this->get_rutas[$url_actual] ?? null;
        } else {
            $funcion = $this->post_rutas[$url_actual] ?? null;
        }


        if ( $funcion ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($funcion, $this); // This es para pasar argumentos
        } else {
            header("Location: /404");
        }
    }

    public function vista($view, $datos = [])
    {

        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}
