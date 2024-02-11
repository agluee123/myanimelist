<?php
include_once('../Dominio/Anime_Lista.php');


class AnimeListasNegocio
{

    public function agregarAnimeALista($idLista, $idAnime)
    {
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


    public function obtenerAnimesPorLista($idLista)
    {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $consulta = "SELECT anime.*
        FROM anime
        INNER JOIN anime_lista ON anime.id_anime = anime_lista.id_anime
        WHERE anime_lista.id_lista = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "i", $idLista);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $animes = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        return $animes;
    }

    
    public function eliminarAnimeDeLista($id_anime, $id_lista) {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");
    
        $query = "DELETE FROM anime_lista WHERE id_anime = ? AND id_lista = ?";
    
        $stmt = mysqli_prepare($conexion, $query);
    
        mysqli_stmt_bind_param($stmt, "ii", $id_anime, $id_lista);
    
        mysqli_stmt_execute($stmt);
    
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Anime eliminado correctamente de la lista";
        } else {
            echo "Error al eliminar el anime de la lista";
        }
    
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }
    


}
