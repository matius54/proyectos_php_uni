<!-- Ejercicio 5 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    
    <?php
        $numero = $_GET["numero"];
        $numero = intval($numero);
        echo "<h1>Tabla de multiplicar del ".$numero."</h1>";
        for($i = 1; $i <= 10 ; $i++)echo $numero." x ".$i." = ".($i * $numero)."<br>";
    ?>

</body>
</html>