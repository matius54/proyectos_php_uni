<!-- Ejercicio 9 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>
<body>
    
    <?php
        $numero_min = 1;
        $numero_max = 100;
        echo "<h1>Numeros pares entre el $numero_min y el $numero_max</h1>";
        for($i = $numero_min;$i <= $numero_max;$i ++)if(!($i%2))echo "$i, ";
    ?>

</body>
</html>