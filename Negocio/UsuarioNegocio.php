<?php 
include_once ('../Dominio/usuario.php');

class UsuarioNegocio{

    public function InsertarUsuario(usuario $nuevo){
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");
        $query=("INSERT into usuario (Nombre, email, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)");
        
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $nombre, $email, $contraseña, $tipo_usuario);

        
        $nombre=$nuevo->getNombre();
        $email=$nuevo->getEmail();
        $contraseña = password_hash($nuevo->getContraseña(), PASSWORD_DEFAULT); 
        $tipo_usuario=$nuevo->getTipoUsuario();

        mysqli_stmt_execute($stmt);
    
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Usuario agregado correctamente";
        } else {
            echo "Error al agregar el anime";
        }
    
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        
    }

    public function ValidarUser(usuario $nuevo){
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");
        $query = ("SELECT email FROM usuario WHERE email=?");
    
        $stmt = mysqli_prepare($conexion, $query);
        $email = $nuevo->getEmail();
        mysqli_stmt_bind_param($stmt, "s", $email);
    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    

        $usuarioExiste = (mysqli_stmt_num_rows($stmt) > 0);
    
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        return $usuarioExiste;
    }
        

    public function IniciarSesion(usuario $usuario){
            $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");
            $email = $usuario->getEmail();
            $contraseña = $usuario->getContraseña();
        
            $query = "SELECT id_usuario, email, nombre, contraseña, tipo_usuario FROM usuario WHERE email=?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        
            // Verificar si el usuario existe
            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $idUsuario, $dbEmail, $nombre, $dbContraseña, $tipoUsuario);
                mysqli_stmt_fetch($stmt);
        
                // Verificar la contraseña
                if (password_verify($contraseña, $dbContraseña)) {
                    // Las credenciales son válidas, iniciar sesión
                    session_start();
                    $_SESSION['id_usuario'] = $idUsuario;
                    $_SESSION['email'] = $dbEmail;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['tipo_usuario'] = $tipoUsuario;
        
                    mysqli_stmt_close($stmt);
                    mysqli_close($conexion);
        
                    return true; // Inicio de sesión exitoso
                }
            }
        
            // Credenciales incorrectas o usuario no encontrado
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
        
            return false;
        
    }

    //HOLA DAII ESTE METODO LO CREE, PARA VER SI PODES CREAR UNA ADMINISTRACION DE USUARIO EN EL FRONT EN TEORIA ESTO DEBERIA MODIFICAR, AUNQUE NO SE LO CREE VIENDO TU CODIGO JAJAJ
    public function ModificarUsuario(Usuario $actualizado){
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $query = "UPDATE usuario SET email=?, nombre=?, contraseña=?, tipo_usuario=? WHERE id_Usuario=?";

        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt, "ssssi", $email, $nombre, $contraseña, $tipo_usuario, $id_usuario);

        $email=$actualizado->getEmail();
        $nombre=$actualizado->getNombre();
        $contraseña=$actualizado->getContraseña();
        $tipo_usuario=$actualizado->getTipoUsuario();
        $id_usuario=$actualizado->getIdUsuario();

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Usuario modificado correctamente";
        } else {
            echo "Error al modificar el Usuario que usted desea". mysqli_error($conexion);
        }
    
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

    }




    //Y ESTE METODO DEBERIA TRAER A LOS USUARIOS QUE SE ENCUENTRAN EN LA DB JAJAJAJA, AUNQUE PENSANDOLO BIEN, NO COMBIENE MAS CREAR UNA LISTA Y LISTAR TODO ?)
    public function ObtenerIdUsuario($id_usuario){
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas de conexión");

        $query = "SELECT id_usuario,email,Nombre,contraseña,tipo_usuario FROM usuario WHERE id_usuario = $id_usuario";
        $resultado = $conexion->query($query);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $usuario = new Usuario();
            $usuario->setIdUsuario($fila["id_usuario"]);
            $usuario->setEmail($fila["email"]);
            $usuario->setNombre($fila["Nombre"]);
            $usuario->setContraseña($fila["contraseña"]);
            $usuario->setTipoUsuario($fila["tipo_usuario"]);
     

            $conexion->close();
            return $usuario;
        } else {
            $conexion->close();
            return null;
        }
    }


    //DEBERIA ELIMINAR??? NO SEEEEE JAJAA
    public function eliminarUsuario($id_usuario){

        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        $query = "DELETE FROM usuario WHERE id_usuario=?";

        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt, "i", $id_usuario);

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Usuario eliminado correctamente";
        } else {
            echo "No se puedo eliminar el usuario";

            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
        }

    }

}

    


?>

        


        