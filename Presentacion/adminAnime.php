<?php
include_once ("../Dominio/Anime.php");
include_once ("../Negocio/animeNegocio.php");
include_once ("../Negocio/autorNegocio.php");
include_once ("../Negocio/generoNegocio.php");

$animeNegocio = new AnimeNegocio();
$animes = $animeNegocio->listar();

$autorNegocio = new AutorNegocio();
$autores = $autorNegocio->listarAutor();


$generoNegocio = new GeneroNegocio();
$generos = $generoNegocio->listarGenero();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animeNegocio = new AnimeNegocio();

    
    $nuevoAnime = new Anime();

    
    $nuevoAnime->setNombre($_POST['nombre']);
    $nuevoAnime->setDescripcion($_POST['descripcion']);
    $nuevoAnime->setCapitulos($_POST['capitulos']);
    $nuevoAnime->setEstado($_POST['estado']);
    $nuevoAnime->setImagenUrl($_POST['imagen_url']);
    $nuevoAnime->setTipo($_POST['tipo']);
    $nuevoAnime->setTomo($_POST['tomo']);
    $nuevoAnime->setIdAutor($_POST['id_autor']);
    $nuevoAnime->setIdGenero($_POST['id_genero']);
    $nuevoAnime->setSumaVotos(0);
    $nuevoAnime->setTotalVotos(0);
	
    $animeNegocio->agregar($nuevoAnime);

    echo "Anime agregado correctamente.";
}

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