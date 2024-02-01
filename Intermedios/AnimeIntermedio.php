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

}

?>