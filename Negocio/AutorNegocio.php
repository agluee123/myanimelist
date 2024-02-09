<?php
include_once('../Dominio/Autor.php');



////DEBERIA SER UN METODO, DE INSERTAR AUTOR, CON ALGUNA VALIDACION, PARA CORROBORAR QUE NO SE CARGUE EL MISMO AUTOR EN LA DB.
class AutorNegocio
{

    //ESTO ESTA MAL, POR QUE DEBE PERMITIRA ESCRIBIR EL AUTOR, Y NO LISTARLO
    public function listarAutor()
    {
        $lista = array();
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("problemas de conexion");
        $query = "select id_autor,nombre_autor from autor; ";
        $resultado = $conexion->query($query);


        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $aux = new Autor();
                $aux->setIdAutor($fila["id_autor"]);
                $aux->setNombreAutor($fila["nombre_autor"]);

                $lista[] = $aux;
            }
        }
        $conexion->close();

        return $lista;
    }

    public function InsertarAutor(autor $nuevo)
    {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");
        $query = "INSERT INTO autor (nombre_autor) VALUES (?)";
        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt, "s", $nombre);
        $nombre = $nuevo->getNombreAutor();

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Autor agregado correctamente";
        } else {
            echo "Error al agregar al autor";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }
}
