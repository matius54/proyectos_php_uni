<!-- Ejercicio 3 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    
    <?php
        for($i = 1; $i <= 30 ; $i++){
            $cuadrado = pow($i,2);
            echo "Numero $i ^2 = $cuadrado";
            if($cuadrado % 2){
                echo " y es impar";
            }else{
                echo " y es par";
            }
            echo "<br>";
        }
    ?>

</body>
</html>