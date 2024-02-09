<?php
include_once ("../Intermedios/ListasAnimeIntermedio.php");
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



<?php foreach ($listasUser as $lista) : ?>
   
        <?php
        if( $lista->getIdLista() == $idLista ){ ?>
            <h3>Lista:  
                <?php echo $lista->getNombre(); ?>
            </h3>
            
            <input type="hidden" name="lista_id" value="<?php echo $lista->getIdLista(); ?>">
            
        <?php } ?>
       
<?php endforeach; ?>








</body>
</html>