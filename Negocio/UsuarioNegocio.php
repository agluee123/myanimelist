<?php 
include_once('../Negocio/AccesoDatos.php');
include_once ('../Dominio/usuario.php');

class UsuarioNegocio{

    //ESTE METODO HABRIA QUE PROBAR SI FUNCIONA DAIII JAJJAJ NO LO GARANTIZOO EN TEORIA DEBERIA FUNCIONARR PERO NO SEEEE JAJAJAJJA
    public function InsertarUsuario(usuario $nuevo){
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");
        $query=("INSERT into usuario (Nombre, email, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)");
        
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ssisiiiii", $nombre, $email, $contraseña, $tipo_usuario);

        
        $nombre=$nuevo->getNombre();
        $email=$nuevo->getEmail();
        $contraseña=$nuevo->getContraseña();
        $tipo_usuario=$nuevo->getTipoUsuario();

        mysqli_stmt_execute($stmt);
    
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Anime agregado correctamente";
        } else {
            echo "Error al agregar el anime";
        }
    
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        

        
    }
}

?>

        


        