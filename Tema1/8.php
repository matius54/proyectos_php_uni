<!-- Ejercicio 8 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>
<body>
    
    <?php
        $numero = 5;
        $factorial = 1;
        for($i=0;$i<$numero;$i++)$factorial*=($numero-$i);
        echo "Factorial de $numero = $factorial";
    ?>

</body>
</html>