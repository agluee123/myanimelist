<?php
include_once("../Intermedios/ListasIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas</title>
    <link rel="stylesheet" href="styles/Listas.css">
    <link rel="stylesheet" href="styles/animevista.css">
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

    <h3>Crea tus listas</h3>

    <div class="lista-container">

        <div class="div-anime">
            <form method="POST" action="Listas.php">

                <?php

                if (isset($_SESSION['id_usuario'])) {
                    echo '<input type="hidden" name="usuario_id" value="' . $_SESSION['id_usuario'] . '">';
                } else {
                    header("Location: login.php");
                    exit();
                }
                ?>

                <label for="nombre_lista">Nombre de nueva lista:</label>
                <input type="text" name="nombre_lista" required>

                <button type="submit" name="agregar" onclick="return confirm('¿Seguro que quieres crear una lista?')">Crear Lista</button>
            </form>


            <h4>Mis listas</h4>


            <button class="button"><a href="animesListas.php">Ver mis listas</a></button>

            <?php foreach ($listasUser as $lista) : ?>
                <ul>
                    <?php echo $lista->getNombre(); ?>

                    <form action="listas.php" method="POST">
                        <input type="hidden" name="lista_id" value="<?php echo $lista->getIdLista(); ?>">
                        <button type="submit" name="eliminarLista" value="eliminarLista" onclick="return confirm('¿Seguro que quieres eliminar esta lista?')">Eliminar Lista</button>
                    </form>
                </ul>
            <?php endforeach; ?>

        </div>

    </div>




</body>

</html>