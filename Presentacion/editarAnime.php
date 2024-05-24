<?php
include_once("../Intermedios/AnimeIntermedio.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/editarAnime.css">
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



    <form method="post" action="../Intermedios/animeIntermedio.php" class="edit-form" enctype="multipart/form-data">
        <h3>Editar</h3>

        <input type="hidden" name="anime_id" value="<?php echo $anime->getIdAnime(); ?>">


        <label for="nuevo_nombre">Modificar Nombre:</label>
        <input type="text" name="nuevo_nombre" value="<?php echo isset($anime) ? $anime->getNombre() : ''; ?>" required>

        <label for="nueva_descripcion">Modificar Descripción:</label>
        <textarea name="nueva_descripcion" required><?php echo isset($anime) ? $anime->getDescripcion() : ''; ?></textarea>
        <br>

        <label for="nuevos_capitulos">Modificar Capítulos:</label>
        <input type="text" name="nuevos_capitulos" value="<?php echo isset($anime) ? $anime->getCapitulos() : ''; ?>">

        <label for="nuevo_estado">Modificar Estado:</label>
        <input type="text" name="nuevo_estado" value="<?php echo isset($anime) ? $anime->getEstado() : ''; ?>">
        <br>

        <label for="nueva_imagen_url">Modificar URL de la Imagen:</label>
        <input type="file" name="nueva_imagen_url" value="<?php echo isset($anime) ? $anime->getImagenUrl() : ''; ?>">


        <label for="nuevo_tipo">Modificar Tipo:</label>
        <input type="text" name="nuevo_tipo" value="<?php echo isset($anime) ? $anime->getTipo() : ''; ?>">
        <br>

        <label for="nuevo_tomo">Modificar Tomo:</label>
        <input type="text" name="nuevo_tomo" value="<?php echo isset($anime) ? $anime->getTomo() : ''; ?>">
        <br>


        <label for="nuevo_id_autor">Modificar Autor:</label>
        <select name="nuevo_id_autor" required>
            <?php
            if (empty($autores)) {
                echo '<option value="" disabled>No hay datos disponibles</option>';
            } else {
                foreach ($autores as $autor) {
                    $selected = isset($anime) && $anime->getIdAutor() == $autor->getIdAutor() ? 'selected' : '';
                    echo '<option value="' . $autor->getIdAutor() . '" ' . $selected . '>' . $autor->getNombreAutor() . '</option>';
                }
            }
            ?>
        </select>


        <label for="nuevo_id_genero">Modificar Género:</label>
        <select name="nuevo_id_genero" required>
            <?php
            if (empty($generos)) {
                echo '<option value="" disabled>No hay datos disponibles</option>';
            } else {
                foreach ($generos as $genero) {
                    $selected = isset($anime) && $anime->getIdGenero() == $genero->getIdGenero() ? 'selected' : '';
                    echo '<option value="' . $genero->getIdGenero() . '" ' . $selected . '>' . $genero->getNombreGenero() . '</option>';
                }
            }
            ?>
        </select>

        <input type="submit" name="modificar" value="Modificar Anime">
    </form>

    <?php CargarArchivos(isset($_POST["modificar"])); ?>


</body>

</html>