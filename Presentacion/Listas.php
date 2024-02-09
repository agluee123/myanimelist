<?php
include_once ("../Intermedios/ListasIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>crea tus listas</h3>
    
    <form method="POST" action="Listas.php">
    
    <?php

        if (isset($_SESSION['id_usuario'])) {
            echo '<input type="hidden" name="usuario_id" value="' . $_SESSION['id_usuario'] . '">';
        } else {
            header("Location: login.php");
            exit();
        }
    ?>
        
    <label for="nombre_lista">Nombre de nueva lista:</label>
    <input type="text" name="nombre_lista" required>
    
    <button type="submit" name="agregar">Crear Lista</button>
</form>


<h4>Mis listas</h4>



<?php foreach ($listasUser as $lista) : ?>
    <li>
        <?php echo $lista->getNombre(); ?>
   
        <form action="animesListas.php" method="POST" >
            <input type="hidden" name="lista_id" value="<?php echo $lista->getIdLista(); ?>">
            <button type="submit" name="action" value="agregarAnimes">Agregar Animes</button>
        </form>
        
        <form action="listas.php" method="POST">
            <input type="hidden" name="lista_id" value="<?php echo $lista->getIdLista(); ?>">
            <button type="submit" name="action" value="eliminarLista" onclick="return confirm('¿Seguro que quieres eliminar esta lista?')">Eliminar Lista</button>
        </form>
    </li>
<?php endforeach; ?>




</body>
</html>