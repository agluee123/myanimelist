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
    if (isset($_POST['agregar'])) {
    
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
            $animeActualizado->setImagenUrl($_POST['nueva_imagen_url']);
            $animeActualizado->setTipo($_POST['nuevo_tipo']);
            $animeActualizado->setTomo($_POST['nuevo_tomo']);
            $animeActualizado->setIdAutor($_POST['nuevo_id_autor']);
            $animeActualizado->setIdGenero($_POST['nuevo_id_genero']);
    
            $animeNegocio->modificarAnime($animeActualizado);
        }
    }
    






if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animeNegocio = new AnimeNegocio();

    if (isset($_POST['eliminar'])) {
       
        $idAnime = $_POST['anime_id'];

        $animeNegocio->eliminarAnime($idAnime);
    }
}






?>