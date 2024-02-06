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
    
        // // if (mysqli_stmt_num_rows($stmt) > 0) {
        // //     echo "Ya existe un usuario con ese correo electrónico.";
        // // } else {
        // //     echo "Puedes crear el usuario con ese correo electrónico.";
        // // }

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


    

    



    
    



}

?>

        


        