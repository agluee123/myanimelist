<?php
include_once ("../Dominio/Anime.php");
include_once ("../Negocio/animeNegocio.php");
include_once ("../Negocio/autorNegocio.php");
include_once ("../Negocio/generoNegocio.php");
include_once ("../Intermedios/AnimeIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>



    <h2>Agregar Anime</h2>

<form method="post" action="adminAnime.php">
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
    <input type="text" id="imagen_url" name="imagen_url" required>
    <br>

    <label for="id_autor">Autor:</label>
    
    <select name="id_autor">
            <?php
            if (empty($autores)) {
                echo '<option value="" disabled>No hay datos disponibles</option>';
            } else {
                foreach ($autores as $autor) {
                    echo '<option value="' . $autor->getIdAutor() . '">' . $autor->getNombreAutor(). '</option>';
                }
            }
            ?>
    </select>

    <br>    
    
    <label for="id_genero">Genero:</label>

    <select name="id_genero" >
        <?php
        if (empty($generos)) {
            echo '<option value="" disabled>No hay datos disponibles</option>';
        } else {
            foreach ($generos as $genero) {
                echo '<option value="' . $genero->getIdGenero() . '">' . $genero->getNombreGenero(). '</option>';
            }
        }
        ?>
    </select>

    <br>

    <button type="submit">Agregar Anime</button>
</form>

</body>
</html>
