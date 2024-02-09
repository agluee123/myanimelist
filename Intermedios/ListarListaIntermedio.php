<?php
include_once ("../Negocio/animeListaNegocio.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Verificar si se recibió el ID de la lista a través de la URL
    if (isset($_GET['id_lista'])) {
        $idLista = $_GET['id_lista'];

        // Crear una instancia de la clase de negocios
        $animeLista = new animeListasNegocio();

        // Obtener los animes asociados a la lista específica
        $animes = $animeLista->obtenerAnimesPorLista($idLista);

        // Enviar los datos a la capa de presentación para mostrarlos en la interfaz de usuario
        include_once("../Presentacion/mostrarAnimesPorLista.php");
    } else {
        echo "No se recibió el ID de la lista correctamente.";
    }
}
?>
