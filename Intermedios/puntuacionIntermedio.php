<?php

include_once("../Negocio/PuntuacionNegocio.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $puntuacionNegocio = new PuntuacionNegocio();

    $idAnime = $_POST['anime_id'];
    $puntuacion = $_POST['rating'];
    $idUsuario = $_POST['id_usuario'];

    if (!empty($idAnime) && !empty($puntuacion)) {
       
    
    $puntuacionNegocio->PuntuacionAnime($idAnime, $puntuacion, $idUsuario);
    } else {
        echo "Error: Datos insuficientes para procesar la puntuación del anime.";
    }

    header("Location: ../Presentacion/detalleanime.php?anime_id=$idAnime"); 
}



?>




