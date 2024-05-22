<?php include_once("../Intermedios/UsuarioIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion de usuario</title>

    <h1>Usuarios</h1>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tipo de usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario->getIdUsuario(); ?></td>
                    <td><?php echo $usuario->getNombre(); ?></td>
                    <td><?php echo $usuario->getEmail(); ?></td>
                    <td><?php echo $usuario->getTipoUsuario(); ?></td>

                    <td>

                        <form method="POST" action="../Presentacion/editarUsuario.php">
                            <input type="hidden" name="id_usuario" value="<?php echo $usuario->getIdUsuario(); ?>">
                            <button type="submit" name="id_editar">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="../Intermedios/usuarioIntermedio.php">
                            <input type="hidden" name="id_usuario" value="<?php echo $usuario->getIdUsuario(); ?>">
                            <button type="submit" name="eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>

</html>