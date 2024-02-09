<?php

include_once ("../Negocio/animeListaNegocio.php");
include_once ("../Negocio/ListasNegocio.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   $animeLista = new animeListasNegocio();

    if (isset($_POST['agregarAnime'])) {

        
        $idLista = $_POST['lista_id'];
        $idAnime = $_POST['anime_id'];
        
        var_dump($idLista);
        var_dump($idAnime);
        
        $animeLista->agregarAnimeALista($idLista, $idAnime);
        header("Location: ../Presentacion/animeVista.php");
    } else {
        echo "No se recibió el id_lista correctamente.";
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   
    if (isset($_POST['lista_id'])) {
        $idLista = $_POST['lista_id'];
      
        
    

    } else {
        echo "No se recibió el id_lista correctamente.";
    }
}




?>