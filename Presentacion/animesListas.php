<?php
include_once("../Intermedios/ListasAnimeIntermedio.php");
include_once("../Intermedios/ListasIntermedio.php");
include_once("../Negocio/animeListaNegocio.php");


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
                        
                            <strong>Nombre:</strong> <?php echo isset($anime['Nombre']) ? $anime['Nombre'] : 'Nombre no disponible'; ?><br>
                            <strong>Imagen:</strong> <?php echo isset($anime['imagen_url']) ? $anime['imagen_url'] : 'Estado no disponible'; ?><br>
                            <strong>Descripción:</strong> <?php echo isset($anime['Descripcion']) ? $anime['Descripcion'] : 'descripcion no disponible'; ?><br>
                            <strong>Capitulos:</strong> <?php echo isset($anime['Capitulos']) ? $anime['Capitulos'] : 'Capitulos no disponible'; ?><br>
                            <strong>Estado:</strong> <?php echo isset($anime['Estado']) ? $anime['Estado'] : 'Estado no disponible'; ?><br>
                        
                        <form action="animesListas.php" method="POST">
                            <input type="hidden" name="animeLista_id" value="<?php echo $anime['id_anime']; ?>">
                            <input type="hidden" name="lista_id" value="<?php echo $lista->getIdLista(); ?>">
                            <button type="submit" name="eliminarAnimeDeLista" value="eliminarAnime" onclick="return confirm('¿Seguro que quieres eliminar <?php echo $anime['Nombre']; ?> de esta lista?')">Eliminar Anime</button>
                        </form>       
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