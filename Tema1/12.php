<!-- Ejercicio 12 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12</title>
</head>
<body>
    
    <?php
        $numeros = array(41,4,784,8,14);
        $buscar = 4;
        echo "<h2>Recorrerlo y mostrarlo.</h2>";
        foreach($numeros as $n)echo "$n<br>";

        echo "<h2>Ordenarlo y mostrarlo.</h2>";
        sort($numeros);
        foreach($numeros as $n)echo "$n<br>";

        echo "<h2>Mostrará su longitud.</h2>";
        echo sizeof($numeros);

        echo "<h2>Buscar en el vector.</h2>";
        echo "Numero $buscar ";
        if(!in_array($buscar,$numeros))echo "no ";
        echo "esta entre los numeros";
    ?>

</body>
</html>