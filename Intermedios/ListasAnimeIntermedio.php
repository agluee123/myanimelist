<?php

include_once ("../Negocio/animeListaNegocio.php");
include_once ("../Negocio/ListasNegocio.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   $animeLista = new animeListaNegocio();

    if (isset($_POST['agregarAnime'])) {

        $idLista = $_POST['lista_id'];
        $idAnime = $_POST['anime_id'];
        
        
        $animeLista->agregarAnimeALista($idLista, $idAnime);

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