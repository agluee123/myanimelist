<?php

include_once ("../Negocio/animeListaNegocio.php");
include_once ("../Negocio/ListasNegocio.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   
    if (isset($_POST['lista_id'])) {
        $idLista = $_POST['lista_id'];
      
        
    

    } else {
        echo "No se recibió el id_lista correctamente.";
    }
}




?>