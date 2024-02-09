<?php
include_once ("../Intermedios/AnimeIntermedio.php");
include_once ("../Intermedios/ListasIntermedio.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/detalleAnime.css">
</head>
<body>

<form method="post" action="../Intermedios/animeIntermedio.php" class="detail-form">
    <h2>Detalles del Anime</h2>

    <input type="hidden" name="anime_id" value="<?php echo $anime->getIdAnime(); ?>">

    <div class="form-row">
        <div class="image-container">
           
            <img src="<?php echo  $anime->getImagenUrl() ; ?>" alt="Imagen del Anime">
        </div>

        <div class="text-container">
            <h4>Nombre:</h4>
            <p><?php echo  $anime->getNombre(); ?></p>

            <h4>Descripción:</h4>
            <p><?php echo $anime->getDescripcion() ; ?></p>

            <h4>Capítulos:</h4>
            <p><?php echo $anime->getCapitulos() ; ?></p>

            <h4>Estado:</h4>
            <p><?php echo $anime->getEstado() ; ?></p>

            <h4>Tipo:</h4>
            <p><?php echo $anime->getTipo() ; ?></p>

            <h4>Tomo:</h4>
            <p><?php echo $anime->getTomo() ; ?></p>

            <h4>Género:</h4>
            <p><?php 
            foreach ($generos as $genero) {
                if (isset($anime) && $anime->getIdGenero() == $genero->getIdGenero()) {
                    echo $genero->getNombreGenero();
                    break;
                }
            }
            
            ?></p>

            <h4>Autor:</h4>
            <p><?php  
                foreach ($autores as $autor) {
                    if (isset($anime) && $anime->getIdAutor() == $autor->getIdAutor()) {
                        echo $autor->getNombreAutor();
                        break;
                    }
                }
            ?></p>


            <label for="listas">Agregar a listas:</label>
                <select name="listas" required>

                    <?php
                    if (empty($TodasLaslistas)) {
                        echo '<option value="" disabled>No hay datos disponibles</option>';
                    } else {
                        foreach ($TodasLaslistas as $Lista) {

                                if(isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] === $Lista->getIdUsuario()){
                                
                                    echo "<option value=" . $Lista->getNombre() . "</option>" ;
                                   

                                }

                        }
                    }

                    ?>
                </select>
            
        </div>
    </div>
</form>

</body>
</html>