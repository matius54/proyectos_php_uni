<!-- Ejercicio 17 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 17</title>
</head>
<body>
    
    <?php
        $arrayana = array();
        $stringana = "";
        $booleana = false;
        $variables = ["arrayana","stringana","booleana"];
        foreach($variables as $var){
            if(is_array($$var))echo "Variable $".$var." es array.<br>";
            if(is_string($$var))echo "Variable $".$var." es string.<br>";
            if(is_bool($$var))echo "Variable $".$var." es bool.<br>";
        }
    ?> 

</body>
</html>