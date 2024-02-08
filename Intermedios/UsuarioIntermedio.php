<?php

include_once ("../Dominio/Usuario.php");
include_once ("../Negocio/usuarioNegocio.php");
session_start();

//VALIDA EL USUARIO, PERO EN EL REGISTRO SI EXISTE O NO EL EMAIL.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new usuario();

    if (isset($_POST['crear'])) {

    $usuario->setNombre($_POST['nombre']);
    $usuario->setEmail($_POST['email']);
    $usuario->setContraseña($_POST['contraseña']);
    $usuario->setTipoUsuario($_POST['tipo_usuario']);
    
    $usuarioNegocio = new usuarioNegocio();

    // Validar si el usuario ya existe
    if ($usuarioNegocio->ValidarUser($usuario)) {
        // El usuario ya existe, mostrar mensaje y no realizar la inserción
        echo "Ya existe un usuario con ese correo electrónico.";
    } else {
        // El usuario no existe, realizar la inserción
        $usuarioNegocio->InsertarUsuario($usuario);
        echo "Usuario agregado correctamente.";
        header("Location: ../Presentacion/animeVista.php");
        exit();
    }
   }

}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $usuarioNegocio = new usuarioNegocio();

    if (isset($_POST['eliminar'])) {
       
        $id_usuario = $_POST['id_usuario'];

       
        $usuarioNegocio->eliminarUsuario($id_usuario);
       
        session_destroy();

        header("Location: ../Presentacion/animevista.php");
        exit();
    }
}



?>