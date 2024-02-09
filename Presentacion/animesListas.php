<?php
include_once ("../Intermedios/ListasAnimeIntermedio.php");
include_once ("../Intermedios/ListasIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas de Animes</title>
</head>
<body>

<h1>Listas de Animes</h1>

<?php if (!empty($listasUser)) : ?>
    <?php foreach ($listasUser as $lista) : ?>
        <h3>Lista: <?php echo $lista->getNombre(); ?></h3>

        <?php
        $animes = $animeListaNegocio->obtenerAnimesPorLista($lista->getIdLista());
        if (!empty($animes)) :
        ?>
            <ul>
                <?php foreach ($animes as $anime) : ?>
                    <li>
                        <strong>Nombre:</strong> <?php echo isset($anime['nombre']) ? $anime['nombre'] : 'Nombre no disponible'; ?><br>
                        <strong>Descripción:</strong> <?php echo isset($anime['descripcion']) ? $anime['descripcion'] : 'descripcion no disponible'; ?><br>
                        <!-- Agregar más detalles del anime si es necesario -->
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No hay animes en esta lista.</p>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else : ?>
    <p>No hay listas de animes disponibles.</p>
<?php endif; ?>

</body>
</html>







