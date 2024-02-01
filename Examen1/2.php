<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="st.css">
    <title>Ejercicio 2</title>
</head>
<body>
    <?php
        $nombres = ["Jose","Manuel","Marcos","Sebastian"];
        $salario = [389.0,737.0,862.0,725.0];
        
        if (sizeof($nombres)!=sizeof($salario))die();

        $table_head = ["nombres","salario","LPH","SSO","Alimentacion","Familia","total"];
        echo "<table border=\"1\"><thead><tr>";
        foreach($table_head as $th)echo "<th>$th</th>";
        echo "</tr></thead><tbody>";
        foreach($nombres as $i => $nombre){
            echo "<tr>";
            echo "<th>$nombre</th>";
            $sal = $salario[$i];
            $total = $sal;
            echo "<th>$sal</th>";
            $total -= $sal*(3/100);
            echo "<th>- ".$sal*(3/100)."</th>";
            $total -= $sal*(2/100);
            echo "<th>- ".$sal*(2/100)."</th>";
            $total += $sal*(10/100);
            echo "<th>+ ".$sal*(10/100)."</th>";
            $total += $sal*(5/100);
            echo "<th>+ ".$sal*(5/100)."</th>";
            echo "<th>$total</th>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    ?>
</body>
</html>