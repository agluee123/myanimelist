<?php

include_once("../intermedios/UsuarioIntermedio.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>

<body>

    <body>

        <?php



        if (isset($_SESSION['id_usuario'])) {

            echo "<h1>Bienvenido, " . $_SESSION['nombre'] . "!</h1>";


            if ($_SESSION['tipo_usuario'] === 'admin') {

                echo "<p>Eres un administrador. ¡Accede al panel de administración!</p>";
                echo '<button class="button"><a href="adminAnime.php">Administrar</a></button>';
            }
        } else {

            header("Location: login.php");
            exit();
        }

        ?>

        <form method="POST" action="../Intermedios/usuariointermedio.php">
            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
            <button type="submit" name="eliminar">Eliminar mi cuenta</button>
        </form>

    </body>

</html>