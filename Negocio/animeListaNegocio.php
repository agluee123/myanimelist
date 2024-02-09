<?php
include_once('../Dominio/Anime_Lista.php');


class AnimeListasNegocio {
    public function listarAnimeLista(){
       

    }

    public function listarListasAnime(){

    }



    public function agregarAnimeALista($idLista, $idAnime) {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $availableAnimesQuery = "
            SELECT anime.*
            FROM anime
            LEFT JOIN anime_lista ON anime.id_anime = anime_lista.id_anime AND anime_lista.id_lista = ?
            WHERE anime_lista.id_anime IS NULL
        ";

        $stmt = mysqli_prepare($conexion, $availableAnimesQuery);
        mysqli_stmt_bind_param($stmt, "i", $idLista);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $availableAnimes = mysqli_fetch_all($result, MYSQLI_ASSOC);

        
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        return $availableAnimes; 
    }

    

    public function crearAnimeListas(){
       

    }

    public function eliminarAnimeListas(){

    }

    public function modificarAnimeListas(){
        
    }

}
?>