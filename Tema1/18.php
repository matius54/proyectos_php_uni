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
        $palabras = ["Frutas","Deportes","Idiomas","Manzana","Futbol","Español","Naranja","Tenis","Inglés","Sandia","Baloncesto","Francés","Fresa","Beisbol","Italiano"];
        $columnas = 3;
        echo "<table><tr>";
            for($i = 0; $i < sizeof($palabras); $i++){
                if(!($i%$columnas))echo "</tr><tr>";
                echo "<th>".$palabras[$i]."</th>";
            }
        echo "</tr></table>";
    ?>

</body>
</html>