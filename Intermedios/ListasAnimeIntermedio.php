<?php

include_once ("../Negocio/animeListaNegocio.php");
include_once ("../Negocio/ListasNegocio.php");


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $DetalleLista= new ListasNegocio();
    if (isset($_POST['lista_id'])) {
        $idLista = $_POST['lista_id'];
        echo "El id_lista recibido es: " . $idLista;
        
       
        $DetalleLista->obtenerDetallesLista($idLista);
      
        echo "Detalles de la lista:<br>";
        var_dump($DetalleLista);

    } else {
        echo "No se recibió el id_lista correctamente.";
    }
}




?>