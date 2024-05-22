<?php
include_once("../Intermedios/UsuarioIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>

<body>

    <form class="form" method="POST" action="../Intermedios/UsuarioIntermedio.php">
        <input type="hidden" name="id_usuario" value="<?php echo isset($usuario) ? $usuario->getIdUsuario() : ''; ?>">
        <div class="input">
            <label class="input__label" for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="input__element" value="<?php echo isset($usuario) ? $usuario->getNombre() : ''; ?>" required>
        </div>
        <div class="input">
            <label class="input__label" for="email">Email</label>
            <input id="email" name="email" type="email" class="input__element" value="<?php echo isset($usuario) ? $usuario->getEmail() : ''; ?>" required>
        </div>
        <div class="input">
            <label class="input__label" for="tipo_usuario">Tipo de Usuario</label>
            <input id="tipo_usuario" name="tipo_usuario" type="text" class="input__element" value="<?php echo isset($usuario) ? $usuario->getTipoUsuario() : ''; ?>" required>
        </div>
        <button type="submit" class="button" name="modificar">
            <div class="button__label">Modificar usuario</div>
        </button>
    </form>

</body>

</html>