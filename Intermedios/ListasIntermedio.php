<?php
session_start();

include_once("../Negocio/ListasNegocio.php");

if (!isset($_SESSION['id_usuario'])) {
    // Redirige a la página de inicio de sesión u otra página apropiada si el id_usuario no está definido en la sesión
    header("Location: ../Presentacion/IniciarSesion.php");

    exit; // Asegúrate de salir del script después de la redirección
}

$ListasNegocio = new ListasNegocio();
$TodasLaslistas = $ListasNegocio->listarListas();

$listarListasPorUsuario = new ListasNegocio();
$listasUser = $listarListasPorUsuario->listarListasPorUsuario($_SESSION['id_usuario']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $ListaNegocio = new ListasNegocio();
        $nuevaLista = new Lista();
        $nuevaLista->setNombre($_POST['nombre_lista']);
        $nuevaLista->setIdUsuario($_SESSION['id_usuario']); // Utiliza $_SESSION['id_usuario'] en lugar de $_POST['usuario_id']
        $ListaNegocio->crearListas($nuevaLista);
        header("Location: ../Presentacion/Listas.php");
    }
    elseif (isset($_POST['eliminarLista'])) {
        $ListasNegocio = new ListasNegocio();
        if (isset($_POST['lista_id'])) {
            $idLista = $_POST['lista_id'];
            $ListasNegocio->eliminarListas($idLista);
        }
        header("Location: ../Presentacion/Listas.php");
        exit;
    }
}

?>
