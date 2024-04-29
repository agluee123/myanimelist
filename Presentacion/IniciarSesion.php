<?php

include_once("../intermedios/UsuarioIntermedio.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
    <link rel="stylesheet" href="styles/IniciarSesion.css">
</head>


<main class="container">
    <form class="form" action="../intermedios/IniciarSesionIntermedio.php" method="POST">
        <div class="input">
            <input id="email" name="email" type="email" class="input__element" placeholder=" " />
            <label class="input__label" for="email">Email</label>
        </div>
        <div class="input">
            <input id="password" name="contraseña" type="password" class="input__element" placeholder=" " />
            <label class="input__label" for="password">Contraseña</label>
        </div>
        <button type="submit" class="button">
            <div class="iniciar_sesion">Iniciar Sesión</div>
        </button>
        <a href="/animelist/Presentacion/RegistroUsuario.php" class="button-secondary">
            <div class="Registrarse">Registrarse</div>
        </a>
    </form>
</main>