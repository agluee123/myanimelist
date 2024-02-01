<?php
include_once ('../Dominio/Anime.php');
class animeNegocio
{
    public function listar(){
        $lista=array();
        $conexion=mysqli_connect("localhost","root","","myanime") or die ("problemas de conexion");
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

    
    public function agregar(Anime $nuevo) {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die ("problemas de conexion");

       
        $nombre = mysqli_real_escape_string($conexion, $nuevo->getNombre());
        $descripcion = mysqli_real_escape_string($conexion, $nuevo->getDescripcion());
        $capitulos = mysqli_real_escape_string($conexion, $nuevo->getCapitulos());
        $estado = mysqli_real_escape_string($conexion, $nuevo->getEstado());
        $imagen_url = mysqli_real_escape_string($conexion, $nuevo->getImagenUrl());
        $id_autor = mysqli_real_escape_string($conexion, $nuevo->getIdAutor());
        $id_genero = mysqli_real_escape_string($conexion, $nuevo->getIdGenero());
        $suma_votos = mysqli_real_escape_string($conexion, $nuevo->getSumaVotos());
        $total_votos = mysqli_real_escape_string($conexion, $nuevo->getTotalVotos());

       
        $query = "INSERT INTO anime (nombre, descripcion, capitulos, estado, imagen_url, id_autor, id_genero, suma_votos, total_votos)
                  VALUES ('$nombre', '$descripcion', '$capitulos', '$estado', '$imagen_url', '$id_autor', '$id_genero', '$suma_votos', '$total_votos')";

        
        $resultado = $conexion->query($query);

       
        if ($resultado) {
            echo "Anime agregado correctamente.";
        } else {
            echo "Error al agregar el anime: " . $conexion->error;
        }

        
        $conexion->close();
    }
}
    



?>