<?php
session_start();

include_once("../Negocio/ListasNegocio.php");



$ListasNegocio = new ListasNegocio();
$TodasLaslistas = $ListasNegocio->listarListas();


$listarListasPorUsuario = new ListasNegocio();
$listasUser = $listarListasPorUsuario->listarListasPorUsuario($_SESSION['id_usuario']);




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ListaNegocio = new ListasNegocio();
    if (isset($_POST['agregar'])) {

        $nuevaLista = new Lista();

        $nuevaLista->setNombre($_POST['nombre_lista']);
        $nuevaLista->setIdUsuario($_POST['usuario_id']);


        $ListaNegocio->crearListas($nuevaLista);
    }
}





if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['eliminarLista'])){
    $ListasNegocio = new ListasNegocio();
    
    if (isset($_POST['lista_id'])) {
        $idLista = $_POST['lista_id'];
        $ListasNegocio->eliminarListas($idLista);
    }

}
header("Location: ../Presentacion/Listas.php");
}


?>
