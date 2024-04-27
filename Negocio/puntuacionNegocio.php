
<?php
include_once('../Dominio/puntuacion.php');


class PuntuacionNegocio
{


    public function PuntuacionAnime($idAnime, $puntuacion, $idUsuario)
    {
        $conexion = mysqli_connect("localhost", "root", "", "myanime") or die("Problemas con la conexión");

        // Verificar si el usuario ya ha votado anteriormente
        $queryVerificarVoto = "SELECT * FROM puntuacion WHERE id_Usuario = ? AND id_anime = ?";
        $stmtVerificarVoto = mysqli_prepare($conexion, $queryVerificarVoto);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$stmtVerificarVoto) {
            die("Error en la preparación de la consulta de verificación de voto: " . mysqli_error($conexion));
        }

        mysqli_stmt_bind_param($stmtVerificarVoto, "ii", $idUsuario, $idAnime);
        mysqli_stmt_execute($stmtVerificarVoto);
        mysqli_stmt_store_result($stmtVerificarVoto);

        if (mysqli_stmt_num_rows($stmtVerificarVoto) > 0) {
            // El usuario ya ha votado anteriormente, puedes manejar esto como desees
            echo "El usuario ya ha votado anteriormente este anime";
        } else {
            // Obtener los valores actuales de suma_votos y total_votos
            $queryObtenerVotos = "SELECT suma_votos, total_votos FROM anime WHERE id_anime = ?";
            $stmtObtenerVotos = mysqli_prepare($conexion, $queryObtenerVotos);

            if (!$stmtObtenerVotos) {
                die("Error en la preparación de la consulta de obtención de votos: " . mysqli_error($conexion));
            }

            mysqli_stmt_bind_param($stmtObtenerVotos, "i", $idAnime);
            mysqli_stmt_execute($stmtObtenerVotos);
            mysqli_stmt_bind_result($stmtObtenerVotos, $sumaVotosActual, $totalVotosActual);
            mysqli_stmt_fetch($stmtObtenerVotos);
            mysqli_stmt_close($stmtObtenerVotos);

            // Actualizar los valores de suma_votos y total_votos
            $nuevaSumaVotos = $sumaVotosActual + $puntuacion;
            $nuevoTotalVotos = $totalVotosActual + 1;

            $queryActualizarPuntuacion = "UPDATE anime SET suma_votos=?, total_votos=? WHERE id_anime=?";
            $stmtActualizarPuntuacion = mysqli_prepare($conexion, $queryActualizarPuntuacion);

            if (!$stmtActualizarPuntuacion) {
                die("Error en la preparación de la consulta de actualización de puntuación: " . mysqli_error($conexion));
            }

            mysqli_stmt_bind_param($stmtActualizarPuntuacion, "iii", $nuevaSumaVotos, $nuevoTotalVotos, $idAnime);
            mysqli_stmt_execute($stmtActualizarPuntuacion);

            if (mysqli_stmt_affected_rows($stmtActualizarPuntuacion) > 0) {
                // Registrar el voto del usuario en la tabla de votos
                $queryRegistrarVoto = "INSERT INTO puntuacion (id_usuario, id_anime) VALUES (?, ?)";
                $stmtRegistrarVoto = mysqli_prepare($conexion, $queryRegistrarVoto);

                if (!$stmtRegistrarVoto) {
                    die("Error en la preparación de la consulta de registro de voto: " . mysqli_error($conexion));
                }

                mysqli_stmt_bind_param($stmtRegistrarVoto, "ii", $idUsuario, $idAnime);
                mysqli_stmt_execute($stmtRegistrarVoto);

                if (mysqli_stmt_affected_rows($stmtRegistrarVoto) > 0) {
                    echo "Puntuación actualizada correctamente";
                } else {
                    echo "Error al registrar el voto del usuario" . mysqli_error($conexion);
                }

                mysqli_stmt_close($stmtRegistrarVoto);
            } else {
                echo "Error al actualizar la puntuación del anime" . mysqli_error($conexion);
            }

            mysqli_stmt_close($stmtActualizarPuntuacion);
        }

        mysqli_close($conexion);
    }
}

?>