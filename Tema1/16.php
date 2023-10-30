<!-- Ejercicio 16 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 16</title>
</head>
<body>
    
    <?php
        $variable;
        if(!isset($variable) || !$variable) $variable = "texto";
        echo "<strong>".strtoupper($variable)."</strong>";
    ?>

</body>
</html>