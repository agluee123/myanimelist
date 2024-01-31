<?php
include_once('../Dominio/Genero.php');
include_once('../Negocio/AccesoDatos.php');

class GeneroNegocio {
    public function listarGenero(){
        $lista=array();
        $conexion=mysqli_connect("localhost","root","","myanime") or die ("problemas de conexion");
        $query="select id_genero,nombre_genero from genero; ";
        $resultado=$conexion->query($query);


        if($resultado->num_rows>0){
            while ($fila=$resultado->fetch_assoc()){
                $aux=new Genero();
                $aux->setIdGenero($fila["id_genero"]);
                $aux->setNombreGenero($fila["nombre_Genero"]);
                

                $lista[]=$aux;
                
                
            }
        }
        $conexion->close();

        return $lista;

    }

}
?>
