<?php
include_once ("../Dominio/Usuario.php");
include_once ("../Negocio/usuarioNegocio.php");


//INICIA SESION, Y VALIDA SI EL MAIL QUE SE INGRESO ESTA REGISTRADO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user=new usuario();
    $user->setEmail($_POST['email']);
    $user->setContraseña($_POST['contraseña']);

    $usuarioNegocio = new usuarioNegocio();

    // Validar si el usuario ya existe
    if ($usuarioNegocio->ValidarUser($user)) {
        // El usuario ya existe, intentar iniciar sesión
        if ($usuarioNegocio->IniciarSesion($user)) {
            // Inicio de sesión exitoso
            // Puedes redirigir a la página deseada después del inicio de sesión
            echo "Inicio de sesión exitoso.";
        } else {
            // Inicio de sesión fallido
            echo "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    } else {
        // El usuario no existe
        echo "No existe un usuario con ese correo electrónico. Regístrate primero.";
        // Puedes redirigir a la página de registro o mostrar un formulario de registro
    }

    
}


?>