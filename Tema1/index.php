<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios Tema 1</title>
</head>
<body>
    <?php
        $ej = [
            "1) Crea dos variables cuyo nombre sea “uno” y “dos” e imprímelas por pantalla. Pon un comentario con el tipo de dato que contienen.",
            "2) Escribe un programa que imprima por pantalla los cuadrados (el número multiplicado por sí mismo) de los 30 primeros números naturales.",
            "3) Modifica el ejercicio anterior para que muestre al lado de cada cuadrado si es un número par o impar.",
            "4) Escribe un programa que multiplique los 20 primeros números naturales.",
            "5) Imprimir por pantalla la tabla de multiplicar del número pasado en un parámetro GET por la URL.",
            "6) Crear un array llamado meses y que almacene el nombre de los doce meses del año. Recorrerlo con FOR para mostrar por pantalla los doce nombres.",
            "7) Igual que el anterior pero utilizando el foreach.",
            "8) Escribir un programa que calcule el factorial de 5.",
            "9) Mostrar todos los números pares que hay entre el 1 y el 100.",
            "10) Mostrar los números múltiplos de un número pasado por la URL que hay del 1 al 100.",
            "11) Un número es bueno si y sólo si la suma de sus divisores sin contarse el mismo da ese número. Programa que calcule si un número es bueno o no.",
            "12) Hacer un programa que tenga un array de 5 números enteros.",
            "13) Escribe un programa que muestre la dirección IP del usuario que visita nuestra web y si usa Firefox darle la enhorabuena.",
            "14) Escribe un programa que añade valores a un array mientras que su longitud sea menor a 100 y después que se muestre la información del array por pantalla.",
            "15) No existe",
            "16) Escribe un programa que compruebe si una variable está vacía y si está vacía, rellenarla con texto en minúsculas y mostrarlo convertido a mayúsculas en negrita.",
            "17) Crea un script PHP que tenga tres variables, una tipo array, otra tipo string y otra boleana y que imprima un mensaje según el tipo de variable que sea.",
            "18) Crea un array con el contenido de una tabla y mostrarla",
            "19) El cálculo del factorial se realiza en un bucle que va disminuyendo el valor de una variable y multiplicando todos los valores entre sí, como ya hemos visto anteriormente.",
            "20) Utiliza una función de PHP para mostrar la fecha actual por pantalla."
        ];
        echo "hola mundo, estos son los ejercicios de Tema1";
        for ($i = 1; $i <= 20 ;$i ++)echo "<br><a title=\"".$ej[$i-1]."\" href=".$i.".php>Ejercicio ".$i."</a>";
    ?>
    
</body>
</html>