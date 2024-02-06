<?php
include_once("../intermedios/AnimeIntermedio.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animes</title>
    <link rel="stylesheet" href="styles/animevista.css">
</head>

<body>

    <div class="navbar">
        <div class="animelis">AnimeList</div>
        <div class="button-container">
            <button class="button"><a href="RegistroUsuario.php">Registro</a></button>
            <button class="button">Iniciar Sesión</button>
        </div>
    </div>

    <h1>Animes</h1>


    <?php if (!empty($animes)) : ?>
        <div class="card-container">
            <?php foreach ($animes as $anime) : ?>
                <div class="card">
                    <img src="<?php echo $anime->getImagenUrl(); ?>" alt="Anime Cover">
                    <div class="card-content">
                        <div class="title"><?php echo $anime->getNombre(); ?></div>
                        <div class="info">Capitulos: <?php echo $anime->getCapitulos(); ?></div>
                        <div class="info"><?php echo $anime->getEstado(); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div>
            <?php else : ?>
                <p>No hay animes disponibles.</p>
            <?php endif; ?>

            <?php session_start(); // Asegúrate de iniciar la sesión al principio de la página

            if (isset($_SESSION['id_usuario'])) {
                // Si el usuario ha iniciado sesión, muestra los datos
                echo "ID de Usuario: " . $_SESSION['id_usuario'] . "<br>";
                echo "Email: " . $_SESSION['email'] . "<br>";
                echo "Nombre: " . $_SESSION['nombre'] . "<br>";
                echo "Tipo de Usuario: " . $_SESSION['tipo_usuario'] . "<br>";
            } else {
                // Si el usuario no ha iniciado sesión, puedes mostrar un mensaje o redirigir a otra página
                echo "No has iniciado sesión.";
            }
            if ($_SESSION['tipo_usuario'] === 'admin') {
                // Si el usuario es administrador, mostrar el CRUD
                // Aquí puedes incluir el código para mostrar el CRUD
                //echo "Bienvenido Administrador. Aquí está el CRUD.<br>";
                echo'<button class="button"><a href="adminAnime.php">Administrar</a></button>';

            } else {
                // Si el usuario es normal, mostrar un mensaje
                echo "Bienvenido Usuario Normal. No tienes permiso para acceder al CRUD.<br>";
            }
        
            ?>


</body>

</html>