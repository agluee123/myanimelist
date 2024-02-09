<?php
include_once('../Dominio/Lista.php');


class ListasNegocio
{
    public function listarListas()
    {

        $lista = array();
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("problemas de conexion");
        $query = "SELECT * FROM lista";
        $resultado = $conexion->query($query);


        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $aux = new Lista();

                $aux->setIdLista($fila["id_lista"]);
                $aux->setIdUsuario($fila["id_usuario"]);
                $aux->setNombre($fila["Nombre"]);

                $lista[] = $aux;
            }
        }
        $conexion->close();

        return $lista;
    }

    public function crearListas(Lista $nuevo)
    {

        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $query = 'INSERT INTO lista (Nombre, id_usuario) VALUES (?, ?)';

        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt, "si", $nombre,  $id_usuario);

        $nombre = $nuevo->getNombre();
        $id_usuario = $nuevo->getIdUsuario();


        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Lista agregada correctamente";
        } else {
            echo "Error al agregar la lista";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }



    public function listarListasPorUsuario($id_usuario)
    {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $query = 'SELECT * FROM lista WHERE id_usuario = ?';
        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt, "i", $id_usuario);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $listas = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $lista = new Lista();
            $lista->setIdLista($row['id_lista']);
            $lista->setNombre($row['Nombre']);
            $lista->setIdUsuario($row['id_usuario']);

            $listas[] = $lista;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        return $listas;
    }



    public function ObtenerDetallesLista($idLista)
    {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");
        $query = 'SELECT * FROM lista WHERE id_lista = ?';
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $idLista);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $fila = $result->fetch_assoc();
            $lista = new Lista();
            $lista->setIdLista($fila["id_lista"]);
            $lista->setNombre($fila["Nombre"]);


            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
            return $lista;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
            return null;
        }
    }


    public function eliminarListas()
    {
    }

    public function modificarListas()
    {
    }
}
