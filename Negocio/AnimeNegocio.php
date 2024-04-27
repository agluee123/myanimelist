<?php
include_once('../Dominio/Anime.php');
class animeNegocio
{
    public function listar()
    {
        $lista = array();
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("problemas de conexion");
        $query = "select id_anime,nombre,descripcion, capitulos,estado,imagen_url,tipo,tomo,id_autor,id_genero,suma_votos,total_votos from anime";
        $resultado = $conexion->query($query);


        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $aux = new Anime();
                $aux->setIdAnime($fila["id_anime"]);
                $aux->setNombre($fila["nombre"]);
                $aux->setDescripcion($fila["descripcion"]);
                $aux->setCapitulos($fila["capitulos"]);
                $aux->setEstado($fila["estado"]);
                $aux->setImagenUrl($fila["imagen_url"]);
                $aux->setTipo($fila['tipo']);
                $aux->setTomo($fila['tomo']);
                $aux->setIdAutor($fila['id_autor']);
                $aux->setIdGenero($fila['id_genero']);
                $aux->setSumaVotos($fila['suma_votos']);
                $aux->setTotalVotos($fila['total_votos']);


                $lista[] = $aux;
            }
        }
        $conexion->close();

        return $lista;
    }

    public function agregar(Anime $nuevo)
    {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $query = "INSERT INTO anime (nombre, descripcion, capitulos, estado, imagen_url, id_autor, id_genero, suma_votos, total_votos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt, "ssissiiii", $nombre, $descripcion, $capitulos, $estado, $imagenUrl, $id_autor, $id_genero, $suma_votos, $total_votos);
        //la s es cuando pasas un string(varchar)  int es i -
        $nombre = $nuevo->getNombre();
        $descripcion = $nuevo->getDescripcion();
        $capitulos = $nuevo->getCapitulos();
        $estado = $nuevo->getEstado();
        $imagenUrl = $nuevo->getImagenUrl();
        $id_autor = $nuevo->getIdAutor();
        $id_genero = $nuevo->getIdGenero();
        $suma_votos = $nuevo->getSumaVotos();
        $total_votos = $nuevo->getTotalVotos();

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Anime agregado correctamente";
        } else {
            echo "Error al agregar el anime";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }

    public function modificarAnime(Anime $actualizado)
    {

        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $query = "UPDATE anime SET nombre=?, descripcion=?, capitulos=?, estado=?, imagen_url=?, id_autor=?, id_genero=?, suma_votos=?, total_votos=? WHERE id_anime=?";

        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt, "ssissiiiii", $nombre, $descripcion, $capitulos, $estado, $imagenUrl, $id_autor, $id_genero, $suma_votos, $total_votos, $id_anime);

        $nombre = $actualizado->getNombre();
        $descripcion = $actualizado->getDescripcion();
        $capitulos = $actualizado->getCapitulos();
        $estado = $actualizado->getEstado();
        $imagenUrl = $actualizado->getImagenUrl();
        $id_autor = $actualizado->getIdAutor();
        $id_genero = $actualizado->getIdGenero();
        $suma_votos = $actualizado->getSumaVotos();
        $total_votos = $actualizado->getTotalVotos();
        $id_anime = $actualizado->getIdAnime();

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Anime modificado correctamente";
        } else {
            echo "Error al modificar el anime" . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }


    public function obtenerPorId($idAnime)
    {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas de conexión");
        $query = "SELECT * FROM anime WHERE id_anime = $idAnime";
        $resultado = $conexion->query($query);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $anime = new Anime();
            $anime->setIdAnime($fila["id_anime"]);
            $anime->setNombre($fila["Nombre"]);
            $anime->setDescripcion($fila["Descripcion"]);
            $anime->setCapitulos($fila["Capitulos"]);
            $anime->setEstado($fila["Estado"]);
            $anime->setImagenUrl($fila["imagen_url"]);
            $anime->setTipo($fila['Tipo']);
            $anime->setTomo($fila['tomo']);
            $anime->setIdAutor($fila['id_autor']);
            $anime->setIdGenero($fila['id_genero']);
            $anime->setSumaVotos($fila['suma_votos']);
            $anime->setTotalVotos($fila['total_votos']);

            $conexion->close();
            return $anime;
        } else {
            $conexion->close();
            return null;
        }
    }





    public function eliminarAnime($id_anime)
    {

        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $query = "DELETE FROM anime WHERE id_anime=?";

        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt, "i", $id_anime);

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Anime eliminado correctamente";
        } else {
            echo "Error al eliminar el anime";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }




    public function getPromedioVotos(Anime $anime)
    {
        if ($anime->getTotalVotos() > 0) {
            return round($anime->getSumaVotos() / $anime->getTotalVotos(), 2);
        } else {
            return 0;
        }
    }
}
