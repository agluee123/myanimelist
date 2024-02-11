<?php

include_once("../Negocio/animeListaNegocio.php");
include_once("../Negocio/ListasNegocio.php");

// Crear instancias de objetos necesarios
$animeListaNegocio = new animeListasNegocio();
$listasNegocio = new ListasNegocio();

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Manejar la solicitud para agregar anime a la lista
    if (isset($_POST['agregarAnime'])) {
        // Verificar si se recibieron correctamente el ID de la lista y el ID del anime
        if (isset($_POST['lista_id']) && isset($_POST['anime_id'])) {
            $idLista = $_POST['lista_id'];
            $idAnime = $_POST['anime_id'];

            // Agregar el anime a la lista
            $animeListaNegocio->agregarAnimeALista($idLista, $idAnime);
            header("Location: ../Presentacion/animeVista.php"); // Redirigir después de agregar el anime
            exit(); // Finalizar la ejecución del script
        } else {
            echo "No se recibió el id_lista o el id_anime correctamente.";
        }
    }
    
    // Manejar la solicitud para obtener el ID de la lista
    if (isset($_POST['lista_id'])) {
        $idLista = $_POST['lista_id'];
        // Puedes realizar más acciones relacionadas con el ID de la lista aquí si es necesario
    } else {
        echo "No se recibió el id_lista correctamente.";
    }
}

// Obtener todas las listas de animes
$listasUser = $listasNegocio->listarListas();



if (isset($_POST['eliminarAnimeDeLista'])) {


    if (isset($_POST['lista_id']) && isset($_POST['animeLista_id'])) {
        $idLista = $_POST['lista_id'];
        $idAnime = $_POST["animeLista_id"];

        $AnimeListasNegocio = new AnimeListasNegocio ();

        $animeListaNegocio->eliminarAnimeDeLista($idAnime,$idLista);
        header("Location: ../Presentacion/animesListas.php"); 
        exit(); 
    } else {
        echo "No se recibió el id_lista o el id_anime correctamente.";
    }
}



?>



