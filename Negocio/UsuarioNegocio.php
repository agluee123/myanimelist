<?php 
include_once('../Negocio/AccesoDatos.php');
include_once ('../Dominio/usuario.php');

class UsuarioNegocio{
    public function InsertarUsuario(usuario $nuevo){
        $datos=new AccesoDatos();
        
        $email = $nuevo->getEmail();
        $contraseña = $nuevo->getContraseña();
        $tipo_usuario = $nuevo->getTipoUsuario();

        $datos->setearConsulta("INSERT into usuario (Nombre, email, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)");
        $datos->setearParametro("s",$email);
        $datos->setearParametro("s",$contraseña);
        $datos->setearParametro("s",$tipo_usuario);
        $datos->ejecutarAccion();
        $datos->cerrarConexion();

    }
}

?>
        

        


        