<?php
include_once("../intermedios/AnimeIntermedio.php");

session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animes</title>
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

    </div>

    <h1>Animes</h1>


    <?php if (!empty($animes)) : ?>
        <div class="card-container">
            <?php foreach ($animes as $anime) : ?>
                <a href="detalleanime.php?anime_id=<?php echo $anime->getIdAnime(); ?>" class="card-link">
                    <div class="card">
                        <img src="Imagen/<?php echo $anime->getImagenUrl(); ?>" alt="Anime Cover">
                        <div class="card-content">
                            <div class="title"><?php echo $anime->getNombre(); ?></div>
                            <div class="info">Capitulos: <?php echo $anime->getCapitulos(); ?></div>
                            <div class="info"><?php echo $anime->getEstado(); ?></div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>No hay animes disponibles.</p>
    <?php endif; ?>


</body>

</html>