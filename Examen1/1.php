<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="st.css">
    <title>Ejercicio 1</title>
</head>
<body>
    <?php
        $notas = [15,20,20,4,10,13,8,17,15,12,15,11,14,15,16,14,15,8,19,20];
        $total = 0;
        $calificacion = [[1,5,"Muy Deficiente"],[6,9,"Deficiente"],[10,13,"Regular"],[14,16,"Bueno"],[17,18,"Exelente"],[19,20,"Sobresaliente"]];
        foreach($notas as $n){
            $total += $n;
        }
        $total = $total/sizeof($notas);
        $calif = "";
        foreach($calificacion as $cal){
            if ($total >= $cal[0] && $total <= $cal[1]){
                $calif = $cal[2];
                break;
            }
        }
        echo "<h1>Promedio</h1>";
        echo "Cuantitativo = $total<br>";
        echo "Cualitativo = $calif";
    ?>
</body>
</html>