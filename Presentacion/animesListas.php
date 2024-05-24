<?php
include_once("../Intermedios/ListasAnimeIntermedio.php");
include_once("../Intermedios/ListasIntermedio.php");
include_once("../Negocio/animeListaNegocio.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas de Animes</title>
    <link rel="stylesheet" href="styles/animeListas.css">
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
                    <button class='button'><a href="animeVista.php">Inicio</a></button>
                    <button class="button"><a href="perfil.php">Mi Perfil</a></button>
                    <button class='button'><a href="Listas.php">Listas</a></button>
                    <form action="../Intermedios/logout.php" method="post">
                        <input type="submit" value="Cerrar Sesión">
                    </form>
                    <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin') : ?>
                        <button class="button"><a href="adminAnime.php">Administrar</a></button>
                        <button class="button"><a href="adminUser.php">Usuarios</a></button>
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

    <?php if (!empty($listasUser)) : ?>
        <?php foreach ($listasUser as $lista) : ?>
            <h3>Lista: <?php echo $lista->getNombre(); ?></h3>

            <?php
            $animes = $animeListaNegocio->obtenerAnimesPorLista($lista->getIdLista());
            if (!empty($animes)) :
            ?>

                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Capitulos</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($animes as $anime) : ?>
                            <tr>
                                <td><?php echo isset($anime['Nombre']) ? $anime['Nombre'] : 'Nombre no disponible'; ?></td>
                                <td><img src="imagen/<?php echo isset($anime['imagen_url']) ? $anime['imagen_url'] : 'Estado no disponible'; ?>" alt="Anime Cover"></td>
                                <td><?php echo isset($anime['Descripcion']) ? $anime['Descripcion'] : 'Descripción no disponible'; ?></td>
                                <td><?php echo isset($anime['Capitulos']) ? $anime['Capitulos'] : 'Capítulos no disponibles'; ?></td>
                                <td><?php echo isset($anime['Estado']) ? $anime['Estado'] : 'Estado no disponible'; ?></td>
                                <td>
                                    <form action="animesListas.php" method="POST">
                                        <input type="hidden" name="animeLista_id" value="<?php echo $anime['id_anime']; ?>">
                                        <input type="hidden" name="lista_id" value="<?php echo $lista->getIdLista(); ?>">
                                        <button type="submit" name="eliminarAnimeDeLista" value="eliminarAnime" onclick="return confirm('¿Seguro que quieres eliminar <?php echo $anime['Nombre']; ?> de esta lista?')">Eliminar Anime</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php else : ?>
                <p>No hay animes en esta lista.</p>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No hay listas de animes disponibles.</p>
    <?php endif; ?>

</body>

</html>