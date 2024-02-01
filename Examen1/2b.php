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
        $nombresRandom = [
            "Carlos Perez","Sergio Gutierrez","Nicolás Herrera","Oscar Lopez",
            "Ana Benitez","Cesar Gomez","Pedro Benitez","Valeria Lopez",
            "Juan Garcia","Juan Herrera","Daniel Acosta","Ana Gonzalez",
            "Cesar Torres","Luis Sosa","Graciela Lopez","Norma Martinez",
            "Nélida Rodriguez","Susana Perez","Martín Flores","Patricia Martinez",
            "María Gimenez","Mónica Gonzalez","Valeria Flores","Mauricio Herrera",
        ];
        //array 1 de nombres
        $nombres = [];
        //array 2 de salarios
        $salarios = [];
        
        //a llenar los 2 arrays con informacion "pseudo" aleatoria
        $ciclos = rand(5,sizeof($nombresRandom)-10);
        for($i=0;$i<$ciclos;$i++){
            do{
                $numeroNombre = rand() % sizeof($nombresRandom);
            }while(in_array($nombresRandom[$numeroNombre],$nombres));
            array_push($nombres,$nombresRandom[$numeroNombre]);
            array_push($salarios,rand(100,800)+(rand(0,1000)/1000));
        }

        //inicia la construccion de la tabla
        $table_head = ["Nombre","Salario","- LPH","- SSO","+ Alimentacion","+ Familia","Total"];
        
        //construccion del cuerpo de la tabla
        $table_body = [];
        for($i=0;$i<sizeof($nombres);$i++){
            $nombre = $nombres[$i];
            $salario = $salarios[$i];
            $lph = $salario * (3/100); //3%
            $sso = $salario * (2/100); //2%
            $alimentacion = $salario * (10/100); //10%
            $familia = $salario * (5/100); //5%
            $total = $salario - $lph - $sso + $alimentacion + $familia;
            array_push($table_body,[$nombre,$salario,$lph,$sso,$alimentacion,$familia,$total]);
        }

        //mostrar la tabla
        echo "<table border=\"1\"><thead><tr>";
        foreach($table_head as $th)echo "<th>$th</th>";

        //mostrar el cuerpo de la tabla
        echo "</tr></thead><tbody>";
        foreach($table_body as $fila){
            echo "<tr>";
                foreach($fila as $celda)echo "<th>$celda</th>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    ?>
</body>
</html>