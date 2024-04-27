<?php
include_once("../Dominio/Anime.php");
include_once("../Negocio/animeNegocio.php");
include_once("../Negocio/autorNegocio.php");
include_once("../Negocio/generoNegocio.php");

$animeNegocio = new AnimeNegocio();
$animes = $animeNegocio->listar();

$autorNegocio = new AutorNegocio();
$autores = $autorNegocio->listarAutor();


$generoNegocio = new GeneroNegocio();
$generos = $generoNegocio->listarGenero();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animeNegocio = new AnimeNegocio();
    if (isset($_POST['agregar'])) {

        $nuevoAnime = new Anime();

        $nuevoAnime->setNombre($_POST['nombre']);
        $nuevoAnime->setDescripcion($_POST['descripcion']);
        $nuevoAnime->setCapitulos($_POST['capitulos']);
        $nuevoAnime->setEstado($_POST['estado']);
        $nuevoAnime->setImagenUrl($_FILES['imagen_url']['name']);
        $nuevoAnime->setTipo($_POST['tipo']);
        $nuevoAnime->setTomo($_POST['tomo']);
        $nuevoAnime->setIdAutor($_POST['id_autor']);
        $nuevoAnime->setIdGenero($_POST['id_genero']);
        $nuevoAnime->setSumaVotos(0);
        $nuevoAnime->setTotalVotos(0);

        $animeNegocio->agregar($nuevoAnime);

        header("Location: ../Presentacion/adminAnime.php");
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animeNegocio = new AnimeNegocio();

    if (isset($_POST['modificar'])) {
        $idAnime = $_POST['anime_id'];

        $animeActualizado = new Anime();
        $animeActualizado->setIdAnime($idAnime);
        $animeActualizado->setNombre($_POST['nuevo_nombre']);
        $animeActualizado->setDescripcion($_POST['nueva_descripcion']);
        $animeActualizado->setCapitulos($_POST['nuevos_capitulos']);
        $animeActualizado->setEstado($_POST['nuevo_estado']);
        $animeActualizado->setImagenUrl($_FILES['nueva_imagen_url']["name"]);
        $animeActualizado->setTipo($_POST['nuevo_tipo']);
        $animeActualizado->setTomo($_POST['nuevo_tomo']);
        $animeActualizado->setIdAutor($_POST['nuevo_id_autor']);
        $animeActualizado->setIdGenero($_POST['nuevo_id_genero']);

        $animeNegocio->modificarAnime($animeActualizado);
        header("Location: ../Presentacion/adminAnime.php");
    }
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animeNegocio = new AnimeNegocio();

    if (isset($_POST['eliminar'])) {

        $idAnime = $_POST['anime_id'];

        $animeNegocio->eliminarAnime($idAnime);

        header("Location: ../Presentacion/adminAnime.php");
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_editar'])) {

    $animeNegocio = new animeNegocio();

    if (isset($_POST['anime_id'])) {
        $anime_id = $_POST['anime_id'];

        $anime = $animeNegocio->obtenerPorId($anime_id);
    }
}



if (isset($_GET['anime_id'])) {
    $anime_id = $_GET['anime_id'];


    $animeNegocio = new animeNegocio();
    $anime = $animeNegocio->obtenerPorId($anime_id);
}





$animeNegocio = new animeNegocio();

// Verificar si el ID del anime está presente en la solicitud
if (isset($_GET['anime_id'])) {
    // Obtén el ID del anime desde la solicitud
    $animeId = $_GET['anime_id'];

    // Obtén el objeto Anime usando el ID
    $anime = $animeNegocio->obtenerPorId($animeId);

    // Verificar si se pudo obtener el objeto Anime
    if ($anime) {
        // Obtén el promedio de votos para ese anime
        $promedio = $animeNegocio->getPromedioVotos($anime);

        // Resto del código relacionado con la visualización del detalle del anime, incluyendo la lógica de las estrellas

    } else {
        // Manejar el caso en el que no se pueda obtener el objeto Anime
        echo "Error: No se pudo obtener el anime.";
    }
} else {
    // Manejar el caso en el que el ID del anime no está presente en la solicitud
    echo "Error: ID del anime no presente en la solicitud.";
}

function CargarArchivos($issetPost)
{
    if ($issetPost) {
        if (isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] === UPLOAD_ERR_OK) {
            $archivo_nombre = $_FILES['imagen_url']['name'];
            $archivo_tmp = $_FILES['imagen_url']['tmp_name'];
            $archivo_destino = 'Imagen/' . $archivo_nombre;
            if (move_uploaded_file($archivo_tmp, $archivo_destino)) {
                echo "La imagen se ha cargado correctamente en la carpeta de destino.";
            } else {
                echo "Hubo un error al mover la imagen a la carpeta de destino.";
            }
        }
        
        if (isset($_FILES['nueva_imagen_url']) && $_FILES['nueva_imagen_url']['error'] === UPLOAD_ERR_OK) {
            $archivo_nombre = $_FILES['nueva_imagen_url']['name'];
            $archivo_tmp = $_FILES['nueva_imagen_url']['tmp_name'];
            $archivo_destino = '../Presentacion/Imagen/' . $archivo_nombre;
            if (move_uploaded_file($archivo_tmp, $archivo_destino)) {
                echo "La nueva imagen se ha cargado correctamente en la carpeta de destino.";
            } else {
                echo "Hubo un error al mover la nueva imagen a la carpeta de destino.";
            }
        }
    }
}


CargarArchivos(isset($_POST["agregar"]));
CargarArchivos(isset($_POST["modificar"]));


