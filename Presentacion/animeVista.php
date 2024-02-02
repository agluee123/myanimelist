<?php
include_once ("../intermedios/AnimeIntermedio.php");
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
        <div class="button-container">
            <button class="button"><a href="RegistroUsuario.php">Registro</a></button>
            <button class="button">Iniciar Sesión</button>
        </div>
</div>   

<h1>Animes</h1>


<?php if (!empty($animes)): ?>
    <div class="card-container">
        <?php foreach ($animes as $anime): ?>
            <div class="card">
            <img src="<?php echo $anime->getImagenUrl(); ?>" alt="Anime Cover">
            <div class="card-content">
                <div class="title"><?php echo $anime->getNombre(); ?></div>
                <div class="info">Capitulos: <?php echo $anime->getCapitulos(); ?></div>
                <div class="info"><?php echo $anime->getEstado(); ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    <div>
<?php else: ?>
    <p>No hay animes disponibles.</p>
<?php endif; ?>


</body>
</html>
