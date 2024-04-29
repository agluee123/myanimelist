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
        <?php
        if (!isset($_SESSION['id_usuario'])) {

            echo '<div class="button-container"><button class="button"><a href="RegistroUsuario.php">Registro</a></button>';
            echo '<button class="button"><a href="Iniciarsesion.php">Iniciar Sesion</a></button></div>';
        } else {
            echo '<button class="button"><a href="perfil.php">Mi Perfil</a></button>';
            echo '<form action="../Intermedios/logout.php" method="post">';
            echo '  <input type="submit" value="Cerrar Sesión">';
            echo '</form>';
            if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin') {
                // Si el usuario es administrador, mostrar el CRUD
                echo '<button class="button"><a href="adminAnime.php">Administrar</a></button>';
            }
        }
        ?>

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