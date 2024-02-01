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
        //1 array vacio
        $notas = [];
        $notasn = 20;
        //un cambio para que no sea tan aleatorio
        $randomItriuX = [rand(0,18),rand(5,20)];
        $rmin = min($randomItriuX);
        $rmax = max($randomItriuX);
        //mas 20 notas aleatorias
        for($i=0;$i<$notasn;$i++)array_push($notas,rand($rmin,$rmax));
        //total inicializado en 0
        $total = 0;
        //muestro las notas (opcional)
        echo "<i>$notasn notas [$rmin<>$rmax] = ";
        foreach($notas as $n)echo "$n ";
        echo "</i>";
        //lista de calificaciones
        $calificacion = [
            //estructura = [nota minima, nota maxima, calificacion]
            [0,5,"Muy Deficiente"],
            [5,9,"Deficiente"],
            [9,13,"Regular"],
            [13,16,"Bueno"],
            [16,18,"Exelente"],
            [18,20,"Sobresaliente"]
        ];
        //suma de todas las notas
        foreach($notas as $n)$total += $n;
        //entre la cantidad de notas
        $total = $total/sizeof($notas);
        echo "<h1>Promedio</h1>";
        //promedio en cuantitativo
        echo "<p>Cuantitativo = $total</p>";
        $cualitativo = "";
        foreach($calificacion as [$notaMin, $notaMax, $calif]){
            if ($total >= $notaMin && $total <= $notaMax){
                $cualitativo = $calif;
                break;
            }
        }
        //promedio en cualitativo
        echo "<p>Cualitativo = $calif</p>";
    ?>
</body>
</html>