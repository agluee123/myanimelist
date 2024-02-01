<?php
include_once ("../Dominio/Anime.php");
include_once ("../Negocio/animeNegocio.php");

$animeNegocio = new AnimeNegocio();
$animes = $animeNegocio->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animes</title>
</head>
<body>

<h1>Animes</h1>

<?php if (!empty($animes)): ?>
    <ul>
        <?php foreach ($animes as $anime): ?>
            <li>
                <strong>Nombre:</strong> <?php echo $anime->getNombre(); ?><br>
                <strong>Descripción:</strong> <?php echo $anime->getDescripcion(); ?><br>
                <strong>Capítulos:</strong> <?php echo $anime->getCapitulos(); ?><br>
                <strong>Estado:</strong> <?php echo $anime->getEstado(); ?><br>
                <img src="<?php echo $anime->getImagenUrl(); ?>" alt="Imagen del Anime"><br>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay animes disponibles.</p>
<?php endif; ?>


</body>
</html>
