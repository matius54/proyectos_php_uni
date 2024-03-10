<?php
$ejercicios = array(
    "Creación de un Formulario Basico",
    "Validación de campos obligatorios",
    "Validación de Dirección de correo electrónico",
    "Uso de casillas de verificación y de opciones",
    "Uso de listas desplegables (select)",
    "Subida de archivos",
    "Uso de sesiones",
    "Validación con expresiones regulares",
    "Creación de un formulario dinámico",
    "Uso de AJAX para envío asíncrono"
);

$url = array(
    "ejercicio1.php",
    "ejercicio2.php",
    "ejercicio3.php",
    "ejercicio4.php",
    "ejercicio5.php",
    "ejercicio6.php",
    "ejercicio7.php",
    "ejercicio8.php",
    "ejercicio9.html",
    "ejercicio10.html"
);
function listarEjercicios($ejercicios, $url)
{
    for ($i = 0; $i <= 9; $i++) {
        echo "<li><a href='Ejercicios/" . $url[$i] . "'>" . $ejercicios[$i] . "</a></li>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ejercicios</title>
</head>

<body>

    <div class="contenido">
        <h2>EJERCICIOS PHP</h2>
        <ol>
            <?php listarEjercicios($ejercicios, $url); ?>
        </ol>
    </div>

    <div class="contenido">
        <h2>CRUD con POO</h2>
        <a href="./CRUD/crud.php">link</a>
    </div>
</body>

</html>