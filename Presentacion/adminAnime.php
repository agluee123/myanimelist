<?php
include_once("../Dominio/Anime.php");
include_once("../Negocio/animeNegocio.php");
include_once("../Negocio/autorNegocio.php");
include_once("../Negocio/generoNegocio.php");
include_once("../Intermedios/AnimeIntermedio.php");

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles/adminAnime.css">
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
                    <button class="button"><a href="perfil.php">Mi Perfil</a></button>
                    <button class='button'><a href="Listas.php">Listas</a></button>
                    <button class='button'><a href="animeVista.php">Inicio</a></button>
                    <form action="../Intermedios/logout.php" method="post">
                        <input type="submit" value="Cerrar Sesión">
                    </form>
                    <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin') : ?>
                        <button class="button"><a href="adminAnime.php">Administrar</a></button>
                    <?php endif; ?>
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

    <form method="post" action="adminAnime.php" class="anime-form" enctype="multipart/form-data"><!--esto sirve para archivos de imagen-->
        <h2>Agregar Anime</h2>
        <label for="nombre">Nombre del Anime:</label>
        <input type="text" id="nombre" name="nombre" required>

        <br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

        <br>

        <label for="capitulos">Número de Capítulos:</label>
        <input type="number" id="capitulos" name="capitulos" required>

        <br>

        <label for="tomo">Número de Tomos:</label>
        <input type="number" id="tomo" name="tomo" required>

        <br>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="En emisión">En emisión</option>
            <option value="Finalizado">Finalizado</option>
            <option value="Proximamente">Proximamente</option>
        </select>

        <br>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Serie">Serie</option>
            <option value="Pelicula">Pelicula</option>
            <option value="Manga">Manga</option>
        </select>

        <br>

        <label for="imagen_url">URL de la Imagen:</label>
        <input type="file" id="imagen_url" name="imagen_url" required>



        <br>

        <label for="id_autor">Autor:</label>

        <select name="id_autor">
            <?php
            if (empty($autores)) {
                echo '<option value="" disabled>No hay datos disponibles</option>';
            } else {
                foreach ($autores as $autor) {
                    echo '<option value="' . $autor->getIdAutor() . '">' . $autor->getNombreAutor() . '</option>';
                }
            }
            ?>
        </select>

        <br>

        <label for="id_genero">Genero:</label>

        <select name="id_genero">
            <?php
            if (empty($generos)) {
                echo '<option value="" disabled>No hay datos disponibles</option>';
            } else {
                foreach ($generos as $genero) {
                    echo '<option value="' . $genero->getIdGenero() . '">' . $genero->getNombreGenero() . '</option>';
                }
            }
            ?>
        </select>

        <br>

        <button type="submit" name="agregar">Agregar Anime</button>
    </form>
    <?php
    //permite cargar archivos y que se guarden en una carpeta

    ?>



    <?php if (!empty($animes)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID Anime</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Capítulos</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Tomo</th>
                    <th>Autor</th>
                    <th>Género</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($animes as $anime) : ?>
                    <tr>
                        <td><?php echo $anime->getIdAnime(); ?></td>
                        <td><?php echo $anime->getNombre(); ?></td>
                        <td><?php echo $anime->getDescripcion(); ?></td>
                        <td><?php echo $anime->getCapitulos(); ?></td>
                        <td><?php echo $anime->getEstado(); ?></td>
                        <td><?php echo $anime->getTipo(); ?></td>
                        <td><?php echo $anime->getTomo(); ?></td>
                        <td>
                            <?php
                            if (empty($autores)) {
                                echo 'No hay datos disponibles';
                            } else {
                                foreach ($autores as $autor) {
                                    if (isset($anime) && $anime->getIdAutor() == $autor->getIdAutor()) {
                                        echo $autor->getNombreAutor();
                                        break;
                                    }
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (empty($generos)) {
                                echo 'No hay datos disponibles';
                            } else {
                                foreach ($generos as $genero) {
                                    if (isset($anime) && $anime->getIdGenero() == $genero->getIdGenero()) {
                                        echo $genero->getNombreGenero();
                                        break;
                                    }
                                }
                            }
                            ?>
                        </td>

                        <td>

                            <form method="POST" action="editarAnime.php">
                                <input type="hidden" name="anime_id" value="<?php echo $anime->getIdAnime(); ?>">
                                <button type="submit" name="id_editar">Editar</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="../Intermedios/animeIntermedio.php">
                                <input type="hidden" name="anime_id" value="<?php echo $anime->getIdAnime(); ?>">
                                <button type="submit" name="eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No hay animes disponibles.</p>
    <?php endif; ?>



</body>

</html>