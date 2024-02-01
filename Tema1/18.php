<!-- Ejercicio 18 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>
<body>

    <?php

        $arrayasda = array();
        $palabras = [
            "Frutas","Deportes","Idiomas",
            "Manzana","Futbol","Español",
            "Naranja","Tenis","Inglés",
            "Sandia","Baloncesto","Francés",
            "Fresa","Beisbol","Italiano"
                ];
        $columnas = 3;

        echo "<table><tbody><tr>";
        foreach($palabras as $i => $palabra){
            if($i != 0 && !($i % $columnas))echo "</tr><tr>";
            echo "<th>$palabra</th>";
        }
        echo "</tr></tbody></table>";
    ?>

</body>
</html>