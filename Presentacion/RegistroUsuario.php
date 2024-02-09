<?php

include_once("../intermedios/UsuarioIntermedio.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>

<body>
    <h2>Formulario de Usuario</h2>
    <form method="POST" action="../intermedios/UsuarioIntermedio.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>
        <br>
        <label for="tipo_usuario">Tipo de Usuario:</label>
        <input type="text" name="tipo_usuario" required>
        <br>
        <button type="submit" name="crear">Agregar Usuario</button>
    </form>
</body>

</html>