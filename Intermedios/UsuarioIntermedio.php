<?php

include_once ("../Dominio/Usuario.php");
include_once ("../Negocio/usuarioNegocio.php");

// $usuario = new usuario();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     $usuario->setNombre($_POST['nombre']);
//     $usuario->setEmail($_POST['email']);
//     $usuario->setContraseña($_POST['contraseña']);
//     $usuario->setTipoUsuario($_POST['tipo_usuario']);
//     $email->setEmail($_POST['email']);
    
    
//     $usuarioNegocio = new usuarioNegocio();
//     $usuarioNegocio->ValidarUser($email);
//     $usuarioNegocio->InsertarUsuario($usuario);
   
//     echo "Usuario agregado correctamente.";
//     header("Location: ../Presentacion/animeVista.php");
//     exit();
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     // Crear un objeto usuario y establecer sus propiedades
//     $usuario = new usuario();
//     $usuario->setNombre($_POST['nombre']);
//     $usuario->setEmail($_POST['email']);
//     $usuario->setContraseña($_POST['contraseña']);
//     $usuario->setTipoUsuario($_POST['tipo_usuario']);
    
//     // Crear un objeto usuarioNegocio
//     $usuarioNegocio = new usuarioNegocio();

//     // Validar si el usuario ya existe
//     if ($usuarioNegocio->ValidarUser($usuario)) {
//         // El usuario ya existe, mostrar mensaje y no realizar la inserción
//         echo "Ya existe un usuario con ese correo electrónico.";
//     } else {
//         // El usuario no existe, realizar la inserción
//         $usuarioNegocio->InsertarUsuario($usuario);
//         echo "Usuario agregado correctamente.";
//         header("Location: ../Presentacion/animeVista.php");
//         exit();
//     }
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new usuario();
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


?>