<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <fieldset>
            <legend>Frutas</legend>
            <label>pera: <input type="checkbox" name="fruta1" value="manzana"></label><br>
            <label>manzana: <input type="checkbox" name="fruta2" value="pera"></label><br>
        </fieldset><br>
        <fieldset>
            <legend>Colores</legend>
            <label>rojo: <input type="radio" name="color" value="rojo"></label><br>
            <label>azul: <input type="radio" name="color" value="azul"></label><br>
        </fieldset><br>
        <input type="submit">
    </form>
    <br>
    <div>
        <!--Respuesta del servidor-->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_REQUEST)) {
            // Obtiene los valores de las casillas de verificación
            $frutas = [];
            foreach ($_POST as $key => $value) {
                if(str_starts_with($key,"fruta")){
                    array_push($frutas,$value);
                }
            }
            // Muestra los valores en pantalla
            echo "Frutas seleccionadas: ";
            foreach ($frutas as $fruta) {
                echo $fruta . ", ";
            }
        }
        echo "<br><br>";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_REQUEST["color"])) {
                echo "Color seleccionado: " . $_REQUEST["color"];
            }
        }
        ?>
    </div>
</body>

</html>