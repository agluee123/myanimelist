<?php
include_once ("../Dominio/Usuario.php");
include_once ("../Negocio/usuarioNegocio.php");

// INICIA SESION Y VALIDA SI EL MAIL QUE SE INGRESÓ ESTÁ REGISTRADO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new usuario();
    $user->setEmail($_POST['email']);
    $user->setContraseña($_POST['contraseña']);

    $usuarioNegocio = new usuarioNegocio();

    // Intenta iniciar sesión
    if ($usuarioNegocio->IniciarSesion($user)) {
        // Inicio de sesión exitoso
        echo "Inicio de sesión exitoso.";
        header("Location: ../Presentacion/animeVista.php");

        // Puedes redirigir a la página deseada después del inicio de sesión
    } else {
        // Inicio de sesión fallido
        echo "Credenciales incorrectas. Por favor, inténtalo de nuevo o regístrate.";
    }
}



?>