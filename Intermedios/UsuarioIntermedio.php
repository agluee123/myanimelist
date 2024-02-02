<?php

include_once ("../Dominio/Usuario.php");
include_once ("../Negocio/usuarioNegocio.php");

$usuario = new usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario->setNombre($_POST['nombre']);
    $usuario->setEmail($_POST['email']);
    $usuario->setContraseña($_POST['contraseña']);
    $usuario->setTipoUsuario($_POST['tipo_usuario']);
    
    
    $usuarioNegocio = new usuarioNegocio();
    $usuarioNegocio->InsertarUsuario($usuario);
   
    echo "Usuario agregado correctamente.";
    header("Location: ../Presentacion/animeVista.php");
    exit();
}
?>