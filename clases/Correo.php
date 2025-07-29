<?php
namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Correo {
    public $nombre;
    public $correo;
    public $token;

    // Constructor para enviar correo de confirmación
    public function __construct($nombre, $correo, $token){
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->token = $token;
    }

    public function enviar_confirmacion(){
        //Crear el objeto del Correo
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV["CORREO_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["CORREO_PUERTO"];
        $mail->Username = $_ENV["CORREO_USUARIO"];
        $mail->Password = $_ENV["CORREO_PASSWORD"];

        $mail->setFrom("appsalon@admin.com");
        $mail->addAddress("appsalon@admin.com");
        $mail->Subject = "Confirma tu cuenta";

        //Configurar el contenido del correo
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace:</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV["URL_LOCAL"] ."/public/confirmar_cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el correo
        $mail->send();
    }

    public function enviar_recuperacion(){
        //Crear el objeto del Correo
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV["CORREO_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["CORREO_PUERTO"];
        $mail->Username = $_ENV["CORREO_USUARIO"];
        $mail->Password = $_ENV["CORREO_PASSWORD"];

        $mail->setFrom("appsalon@recuperacion.com");
        $mail->addAddress("appsalon@recuperacion.com");
        $mail->Subject = "Reestablece tu contraseña";

        //Configurar el contenido del correo
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has solicitado un cambio de contraseña, puedes cambiarla presionando el siguiente enlace:</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV["URL_LOCAL"] ."/public/recuperar?token=" . $this->token . "'>Reestablecer contraseña</a></p>";
        $contenido .= "<p>Si no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el correo
        $mail->send();
    }
}

?>