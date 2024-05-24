<?php include_once("../Intermedios/UsuarioIntermedio.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/animeVista.css">
    <link rel="stylesheet" href="styles/AdminAnime.css">
    <title>Administracion de usuario</title>


</head>

<body>

    <div class="navbar">
        <div class="animelis">AnimeList</div>


        <?php if (!isset($_SESSION['id_usuario'])) : ?>
            <div class="button-container">
                <button class="button"><a href="Iniciarsesion.php">Iniciar Sesión</a></button>
                <button class="button"><a href="RegistroUsuario.php">Registrarse</a></button>

            </div>
        <?php else : ?>
            <!-- Mostrar imagen de usuario y opciones de perfil -->
            <div class='img' id='usuario_icono' onclick="toggleOptions()">
                <img src="Imagen/usuario.png" class="imagen_usuario">
                <div id="opciones_usuario" style="display: none;">
                    <button class="button"><a href="animeVista.php">Inicio</a></button>
                    <button class="button"><a href="perfil.php">Mi Perfil</a></button>
                    <button class='button'><a href="Listas.php">Listas</a></button>
                    <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin') : ?>
                        <button class="button"><a href="adminAnime.php">Administrar</a></button>
                        <button class="button"><a href="adminUser.php">Usuarios</a></button>
                    <?php endif; ?>
                    <form action="../Intermedios/logout.php" method="post">
                        <input type="submit" value="Cerrar Sesión">
                    </form>
                </div>
            </div>
        <?php endif; ?>



        <script>
            function toggleOptions() {
                var opcionesUsuario = document.getElementById("opciones_usuario");
                if (opcionesUsuario.style.display === "none" || opcionesUsuario.style.display === "") {
                    opcionesUsuario.style.display = "block";
                } else {
                    opcionesUsuario.style.display = "none";
                }
            }
        </script>
    </div>

    <div class="titulo">
        <h1>Usuarios</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Id</th>
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