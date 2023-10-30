<!-- Ejercicio 19 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 19</title>
</head>
<body>
    
    <?php
        $numero = 8;
        function factorial($numero){
            if (!is_int($numero) || $numero<=0) return 0;
            $factorial = 1;
            for($i=0;$i<$numero;$i++)
                $factorial*=($numero-$i);
            return $factorial;
        }
        echo "Factorial de ".$numero." = ".factorial($numero);
    ?>

</body>
</html>