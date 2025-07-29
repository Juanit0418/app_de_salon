<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function autenticado(){
    if(!isset($_SESSION["login"])){
        header("Location: /");
        exit;
    };
}

//USar en paginas de administracion
function admin(){
    autenticado();
    if($_SESSION["admin"] !== 1){
        $_SESSION = [];
        session_destroy();
        header("Location: /restringido");
        exit;
    };

}

function usuario(){
    autenticado();
    if($_SESSION["admin"] == 1){
        $_SESSION = [];
        session_destroy();
        header("Location: /restringido");
        exit;
    };
}

//Usar en paginas de no logueo
function iniciado(){
    if(isset($_SESSION["login"])){
        if($_SESSION["admin"] !== 1){
            header("Location: /cita");
            exit;
        } else {
            header("Location: /admin");
            exit;
        }
    };
}