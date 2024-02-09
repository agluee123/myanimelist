<?php
include_once ("../Intermedios/ListasAnimeIntermedio.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<?php
if ($DetalleLista) {
    echo "ID Lista: " . $DetalleLista->getIdLista() . "<br>";
    echo "Nombre Lista: " . $DetalleLista->getNombre() . "<br>";
} else {
    echo "La lista no existe.";
}
?>



</body>
</html>