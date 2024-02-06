<?php

include_once ("../intermedios/UsuarioIntermedio.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
</head>

<body>
    <h2>Iniciar Sesion</h2>
    <form method="POST" action="../intermedios/IniciarSesionIntermedio.php">
        
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>
        <br>
        <button type="submit" name="Inicio Sesion">Iniciar Sesion</button>
    </form>

    
</body>

</html>