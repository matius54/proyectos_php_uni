<!-- Ejercicio 10 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
</head>
<body>
    
    <?php
        $numero = isset($_GET["numero"]) ? $_GET["numero"] : 0;
        $numero = intval($numero);
        //echo "<h1>Tabla de multiplicar del ".$numero."</h1>";
        for($i = 1; $i <= 100 ; $i++)echo "$numero x $i = ".($i * $numero)."<br>";
    ?>

</body>
</html>