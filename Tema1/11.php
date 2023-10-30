<!-- Ejercicio 11 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
</head>
<body>
    
    <?php
        function esBueno($numero){
            if(!isset($numero) || !is_int($numero) || $numero <= 0) return false;
            $suma = 0;
            for($i = 0; $i < $numero-1; $i++){
                $rev_n = $numero - $i;
                if(!($numero%$rev_n))$suma += $rev_n;
            }
            return $numero == $suma ? true : false;
        }
            //primeros 500 numeros naturales buenos
            //for($n=1;$n<=500;$n++)echo "(".$n.") es ".(esBueno($n)?"bueno":"no bueno")."<br>";
        echo "(7) es ".(esBueno(7)?"bueno":"no bueno");
    ?>
</body>
</html>