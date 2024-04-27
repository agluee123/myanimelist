<?php

include_once("../intermedios/UsuarioIntermedio.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="styles/RegistroUsuario.css">
</head>

<body>
    <main class="container">
        <form class="form" method="POST" action="../intermedios/UsuarioIntermedio.php">
            <div class="input">
                <input id="nombre" name="nombre" type="text" class="input__element" placeholder=" " required>
                <label class="input__label" for="nombre">Nombre</label>
            </div>
            <div class="input">
                <input id="email" name="email" type="email" class="input__element" placeholder=" " required>
                <label class="input__label" for="email">Email</label>
            </div>
            <div class="input">
                <input id="contraseña" name="contraseña" type="password" class="input__element" placeholder=" " required>
                <label class="input__label" for="contraseña">Contraseña</label>
            </div>
            <div class="input">
                <input id="tipo_usuario" name="tipo_usuario" type="text" class="input__element" placeholder=" " required>
                <label class="input__label" for="tipo_usuario">Tipo de Usuario</label>
            </div>
            <button type="submit" class="button" name="crear">
                <div class="button__label">Agregar Usuario</div>
            </button>
        </form>
    </main>
</body>

</html>


</html>