<?php
namespace Model;

class Usuario extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ["id", "nombre", "apellido", "correo", "telefono", "password", "admin", "confirmado", "token"];

    public $id;
    public $nombre;
    public $apellido;
    public $correo;
    public $telefono;
    public $password;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($usuario = []){
        $this->id = $usuario['id'] ?? null;
        $this->nombre = $usuario['nombre'] ?? '';
        $this->apellido = $usuario['apellido'] ?? '';
        $this->correo = $usuario['correo'] ?? '';
        $this->telefono = $usuario['telefono'] ?? '';
        $this->password = $usuario['password'] ?? '';
        $this->admin = $usuario['admin'] ?? "0";
        $this->confirmado = $usuario['confirmado'] ?? "0";
        $this->token = $usuario['token'] ?? '';
    }

    public function validar_nueva_cuenta(){
        if(!$this->nombre){
            self::$alertas["errores"][] = "Tu nombre es obligatorio";
        }

        if(!$this->apellido){
            self::$alertas["errores"][] = "Tu apellido es obligatorio";
        }

        if(!$this->correo){
            self::$alertas["errores"][] = "Tu correo electrónico es obligatorio";
        }

        if(!$this->telefono){
            self::$alertas["errores"][] = "Tu número de teléfono es obligatorio";
        }

        if(!$this->password){
            self::$alertas["errores"][] = "La contraseña es obligatoria";
        } else {
            if(strlen($this->password) < 8){
                self::$alertas["errores"][] = "La contraseña debe tener al menos 8 caracteres";
            }
        }

        return self::$alertas;
    }

    public function validar_login(){
        if(!$this->correo){
            self::$alertas["errores"][] = "El correo electrónico es obligatorio";
        }

        if(!$this->password){
            self::$alertas["errores"][] = "La contraseña es obligatoria";
        } else {
            if(strlen($this->password) < 8){
                self::$alertas["errores"][] = "La contraseña debe tener al menos 8 caracteres";
            }
        }

        return self::$alertas;
    }

    public function existe_usuario(){
        $consulta = "SELECT * FROM " . self::$tabla . " WHERE correo = '" . s($this->correo) . "' LIMIT 1";

        $resultado = self::$db->query($consulta);
        if($resultado->num_rows){
            self::$alertas["errores"][] = "El usuario ya está registrado";
        }

        return $resultado;
    }

    public function hash_password(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crear_token(){
        $this->token = trim(uniqid());
    }

    public function validar_inicio($password){
        $resultado = password_verify($password, $this->password);

        if(!$resultado){
            self::setAlerta("errores", "Credenciales incorrectas");
        } else {
            if(!$this->confirmado){
                self::setAlerta("errores", "Tu cuenta no ha sido confirmada");
            } else {
                return true;
            }
        }
    }

    public function validar_correo(){
        if(!$this->correo){
            self::$alertas["errores"][] = "El correo electrónico es obligatorio";
        }
        return self::$alertas;
    }

    public function validar_password(){
        if(!$this->password){
            self::$alertas["errores"][] = "La contraseña es obligatoria";
        } else {
            if(strlen($this->password) < 8){
                self::$alertas["errores"][] = "La contraseña debe tener al menos 8 caracteres";
            }
        }
        return self::$alertas;
    }
}



?>