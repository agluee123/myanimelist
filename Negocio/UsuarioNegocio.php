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
        $contraseña=$nuevo->getContraseña();
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
        $email=$usuario->getEmail();
        $contraseña=$usuario->getContraseña();

        $query = ("SELECT id_usuario,email,nombre,contraseña,tipo_usuario FROM usuario WHERE email=? and contraseña=?"); 
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email,$contraseña);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        //VERIFICA SI EXISTE
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $idUsuario, $dbEmail, $nombre, $dbContraseña, $tipoUsuario);
            mysqli_stmt_fetch($stmt);

        
            if (password_verify($dbEmail, $dbContraseña)) {
                //SI LOS DATOS SON VALIDOS, INICIA SESION
                session_start();
                $_SESSION['email'] = $dbEmail;
                $_SESSION['contraseña']=$dbContraseña;
                
                
    
                // Puedes almacenar más información del usuario en la sesión según sea necesario
    
                mysqli_stmt_close($stmt);
                mysqli_close($conexion);
    
                return true; // "TRUE" INICIO DE SESION EXITOSO
            }
        }
    
        // SI NO ENCONTRA LAS CREDENCIALES RETORN FALSE
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    
        return false;    



    }


    public function eliminarUsuario(usuario $usuario){

     }

    



    
    



}

?>

        


        