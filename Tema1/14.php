<!-- Ejercicio 14 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14</title>
</head>
<body>
    
    <?php
        $unArray = array();
        while(sizeof($unArray)<100)array_push($unArray,"valores");
        foreach($unArray as $el)echo "$el, ";
    ?>

</body>
</html>