<?php
include_once('../Dominio/Anime_Lista.php');


class AnimeListasNegocio {
    public function listarAnimeLista(){
       

    }

    public function listarListasAnime(){

    }





    public function agregarAnimeALista($idLista, $idAnime) {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");
   
        // Verificar si el anime ya está en la lista
        $consulta = "SELECT id_lista FROM anime_lista WHERE id_lista = ? AND id_anime = ?";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "ii", $idLista, $idAnime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
   
        // Si el anime ya está en la lista, no hacer nada
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
            return "El anime ya está en la lista.";
        }
   
        // Insertar el anime en la lista
        $consulta = "INSERT INTO anime_lista (id_lista, id_anime) VALUES (?, ?)";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "ii", $idLista, $idAnime);
        mysqli_stmt_execute($stmt);
   
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
   
        return "Anime agregado a la lista correctamente.";
    } 



    

    public function crearAnimeListas(){
       

    }

    public function eliminarAnimeListas(){

    }

    public function modificarAnimeListas(){
        
    }

}
?>