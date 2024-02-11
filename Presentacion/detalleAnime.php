<?php
include_once("../Intermedios/AnimeIntermedio.php");
include_once("../Intermedios/ListasIntermedio.php");
include_once("../Intermedios/puntuacionIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/detalleAnime.css">
</head>

<body>

    <h2>Detalles del Anime</h2>

    <input type="hidden" name="anime_id" value="<?php echo $anime->getIdAnime(); ?>">

    <div class="form-row">
        <div class="image-container">

            <img src="<?php echo  $anime->getImagenUrl(); ?>" alt="Imagen del Anime">
        </div>

        <div class="text-container">
            <h4>Nombre:</h4>
            <p><?php echo  $anime->getNombre(); ?></p>

            <h4>Descripción:</h4>
            <p><?php echo $anime->getDescripcion(); ?></p>

            <h4>Capítulos:</h4>
            <p><?php echo $anime->getCapitulos(); ?></p>

            <h4>Estado:</h4>
            <p><?php echo $anime->getEstado(); ?></p>

            <h4>Tipo:</h4>
            <p><?php echo $anime->getTipo(); ?></p>

            <h4>Tomo:</h4>
            <p><?php echo $anime->getTomo(); ?></p>
            

            <h4>votos:</h4> <p><?php echo $anime->getTotalVotos(); ?></p>
            <h4>Suma:</h4> <p><?php echo $anime->getSumaVotos(); ?></p>

            
            <h4>Promedio Votos:</h4>
        
        <div class="votacion-anime">
        <?php
        // Calcula el valor redondeado del promedio para establecer el número de estrellas a resaltar
         $promedioRedondeado = round($promedio);
         
         // Muestra las estrellas resaltadas según el promedio redondeado
         for ($i = 5; $i >= 1; $i--) : ?>
        <span class="<?php echo $i <= $promedioRedondeado ? 'full-star' : 'empty-star'; ?>" title="<?php echo $i; ?> stars">&#9733;</span>
        <?php endfor; ?>
    </div>
    
    <h5> <?php echo $anime->getTotalVotos(); ?> Votos</h5>


    
            
    <div class="votacion-animes">
    <?php
    // Multiplica el promedio por 2 para obtener un rango de 0 a 10
    $promedioRango = $promedio * 2;

    // Muestra las estrellas resaltadas según el rango
    for ($i = 5; $i >= 1; $i--) : 
        if ($promedioRango >= $i * 2) {
            echo '<span class="full-star" title="' . $i / 2 . ' stars">&#9733;</span>';
        } elseif ($promedioRango >= ($i * 2 - 1.5)) {
            echo '<span class="half-star" title="' . $i / 2 . ' stars">&#9733;</span>';
        } else {
            echo '<span class="empty-star" title="' . $i / 2 . ' stars">&#9734;</span>';
        }
    endfor;
    ?>
</div>









            
        <h4>vota por este anime</h4>
            
            
            <form action="../Intermedios/puntuacionIntermedio.php" method="POST">
                <input type="hidden" name="anime_id" value="<?php echo $anime->getIdAnime(); ?>">
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                <div class="votacion">
                <?php for ($i = 5; $i >= 1; $i--) : ?>     
                        <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" />
                        <label class="full" for="star<?php echo $i; ?>" title="<?php echo $i; ?> stars">&#9733;</label>
                <?php endfor; ?>
                </div>
                <button type="submit" name="submit_voto">Votar</button>
            </form>


       

            <h4>Género:</h4>
            <p><?php
                foreach ($generos as $genero) {
                    if (isset($anime) && $anime->getIdGenero() == $genero->getIdGenero()) {
                        echo $genero->getNombreGenero();
                        break;
                    }
                }

                ?></p>

            <h4>Autor:</h4>
            <p><?php
                foreach ($autores as $autor) {
                    if (isset($anime) && $anime->getIdAutor() == $autor->getIdAutor()) {
                        echo $autor->getNombreAutor();
                        break;
                    }
                }
            ?></p>

            <form action="../Intermedios/ListasAnimeIntermedio.php" method="POST">
                <input type="hidden" name="anime_id" value="<?php echo $anime->getIdAnime(); ?>">
                <label for="listas">Agregar a listas:</label>
                <select name="lista_id" required>
                    <?php
                    if (empty($TodasLaslistas)) {
                        echo '<option value="" disabled>No hay datos disponibles</option>';
                    } else {
                        foreach ($TodasLaslistas as $Lista) {
                            if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $Lista->getIdUsuario()) {
                                echo '<option value="' . $Lista->getIdLista() . '">' . $Lista->getNombre() . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
                <button type="submit" name="agregarAnime">Agregar Anime</button>
            </form>




        </div>
    </div>


</body>

</html>