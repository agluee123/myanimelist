<?php
include_once('../Dominio/Autor.php');
include_once('../Negocio/AccesoDatos.php');


////DEBERIA SER UN METODO, DE INSERTAR AUTOR, CON ALGUNA VALIDACION, PARA CORROBORAR QUE NO SE CARGUE EL MISMO AUTOR EN LA DB.
class AutorNegocio {
    public function listarAutor(){
        $lista=array();
        $conexion=mysqli_connect("localhost","root","","myanime") or die ("problemas de conexion");
        $query="select id_autor,nombre_autor from autor; ";
        $resultado=$conexion->query($query);


        if($resultado->num_rows>0){
            while ($fila=$resultado->fetch_assoc()){
                $aux=new Autor();
                $aux->setIdAutor($fila["id_autor"]);
                $aux->setNombreAutor($fila["nombre_autor"]);
                

                $lista[]=$aux;
                
                
            }
        }
        $conexion->close();

        return $lista;

    }

}
?>