<?php
require_once 'Dominio/Anime.php';
class animeNegocio
{
    public function listar(){
        $lista=array();
        $conexion=mysqli_connect("localhost","root","myanime") or die ("problemas de conexion");
        $query="select nombre,descripcion, capitulos,estado,imagen_url from anime";
        $resultado=$conexion->query($query);


        if($resultado->num_rows>0){
            while ($fila=$resultado->fetch_assoc()){
                $aux=new Anime();
                $aux->setNombre($fila["nombre"]);
                $aux->setDescripcion($fila["descripcion"]);
                $aux->setCapitulos($fila["capitulos"]);
                $aux->setEstado($fila["estado"]);
                $aux->setImagenUrl($fila["imagen_url"]);

                $lista[]=$aux;
                
                
            }
        }
        $conexion->close();

        return $lista;

    }
    



}

?>