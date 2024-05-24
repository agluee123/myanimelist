<?php
include_once("../Intermedios/UsuarioIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/RegistroUsuario.css">
    <link rel="stylesheet" href="styles/animevista.css">
    <title>Editar Usuario</title>
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

    <div class="container">

        <form class="form" method="POST" action="../Intermedios/UsuarioIntermedio.php">
            <input type="hidden" name="id_usuario" value="<?php echo isset($usuario) ? $usuario->getIdUsuario() : ''; ?>">
            <div class="input">
                <input id="nombre" name="nombre" type="text" class="input__element" value="<?php echo isset($usuario) ? $usuario->getNombre() : ''; ?>" required>
                <label class="input__label" for="nombre">Nombre</label>
            </div>
            <div class="input">
                <input id="email" name="email" type="email" class="input__element" value="<?php echo isset($usuario) ? $usuario->getEmail() : ''; ?>" required>
                <label class="input__label" for="email">Email</label>
            </div>
            <div class="input">
                <input id="tipo_usuario" name="tipo_usuario" type="text" class="input__element" value="<?php echo isset($usuario) ? $usuario->getTipoUsuario() : ''; ?>" required>
                <label class="input__label" for="tipo_usuario">Tipo de Usuario</label>
            </div>
            <button type="submit" class="button" name="modificar">
                <div class="button__label">Modificar usuario</div>
            </button>
        </form>



    </div>

</body>

</html>