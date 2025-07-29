<?php
namespace Controller;
use Clases\Correo;
use MVC\Router;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){
        session_start();
        iniciado();
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);
            $alertas = $auth->validar_login();

            if(empty($alertas["errores"])){
                //Comprobar si el usuario existe
                $usuario = Usuario::encontrar("correo", $auth->correo);

                if($usuario){
                    //Comprobar si el usuario está confirmado
                    if($usuario->validar_inicio($auth->password)){
                        //Iniciar sesión descomentar si no funciona
                        //session_start();
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION["correo"] = $usuario->correo;
                        $_SESSION["login"] = true;
                        $_SESSION["admin"] = (int) $usuario->admin;
                        
                        if($_SESSION["admin"] === 1){
                            header("Location: /admin");
                        } else {
                            header("Location: /cita");
                        }
                    };
                } else {
                    Usuario::setAlerta("errores", "Credenciales incorrectas");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->vista("autenticacion/login", [
            "alertas" => $alertas,
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header("Location: /");
    }

    public static function olvide(Router $router){
        session_start();
        iniciado();
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);
            $alertas = $auth->validar_correo();

            if(empty($alertas["errores"])){
                $usuario = Usuario::encontrar("correo", $auth->correo);

                if(!$usuario){
                    Usuario::setAlerta("errores", "El correo no está registrado");
                } else {
                    if($usuario->confirmado !== "1"){
                        Usuario::setAlerta("errores", "El usuario no está confirmado");
                    } else {
                        //Generar un nuevo token
                        $usuario->crear_token();
                        $usuario->guardar();

                        //Enviar un correo con el token
                        $correo = new Correo($usuario->nombre, $usuario->correo, $usuario->token);
                        $correo->enviar_recuperacion();

                        //Mensaje de éxito
                        Usuario::setAlerta("exito", "Hemos enviado un correo con las instrucciones para recuperar tu contraseña");
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->vista("autenticacion/olvide", [
            "alertas" => $alertas
        ]);
    }

    public static function recuperar(Router $router){
        session_start();
        iniciado();
        $alertas = [];
        $error = false;
        $token = s($_GET["token"]);

        //Buscar el usuario por el token
        $usuario = Usuario::encontrar("token", $token);
        if(empty($usuario)){
            Usuario::setAlerta("errores", "Token no válido");
            $error = true;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $password = new Usuario($_POST);
            $alertas = $password->validar_password();

            if(empty($alertas["errores"])){
                //sobreescribir el password de la base de datoscon los nuevos datos
                $usuario->password = $password->password;
                $usuario->hash_password();
                $usuario->token = "";

                $resultado = $usuario->guardar();
                if($resultado){
                    header("Location: /");
                } else {
                    Usuario::setAlerta("errores", "Error al actualizar la contraseña");
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->vista("autenticacion/recuperar", [
            "alertas" => $alertas,
            "error" => $error
        ]);
    }

    public static function crear(Router $router){
        session_start();
        iniciado();

        $usuario = new Usuario();
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_nueva_cuenta();

            if(empty($alertas["errores"])){
                //Verificar si el usuario ya existe
                $resultado = $usuario->existe_usuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                } else {
                    //No está registrado

                    //Hashear la contraseña
                    $usuario->hash_password();

                    //Generar un token unico
                    $usuario->crear_token();


                    //Enviar un email de confirmación
                    $correo = new Correo($usuario->nombre, $usuario->correo, $usuario->token);
                    $correo->enviar_confirmacion();

                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header("Location: /mensaje");
                    }
                }
            }
        }
        // Renderizar la vista de crear cuenta
        $router->vista("autenticacion/crear_cuenta", [
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        session_start();
        iniciado();
        $router->vista("autenticacion/mensaje", []);
    }

    public static function confirmar(Router $router){
        session_start();
        iniciado();
        $alertas = [];
        $token = trim(s($_GET["token"]));
        $usuario = Usuario::encontrar("token", $token);
        if(empty($usuario)){
            //Mostrar mensaje de error
            Usuario::setAlerta("errores", "Token no válido");
        } else {
            //Cambiar informacion del usuario
            $usuario->confirmado = "1";
            $usuario->token = "";

            $usuario->guardar();

            Usuario::setAlerta("exito", "Cuenta confirmada, inicia sesión");
        }

        $alertas = Usuario::getAlertas();
        $router->vista("autenticacion/confirmar_cuenta", [
            "alertas" => $alertas
        ]);
    }
}

?>