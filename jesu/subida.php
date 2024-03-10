<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida</title>
</head>
<body>
</body>
</html>

<?php
// $target_dir = "subidas/";
// $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Compruebe si el archivo de imagen es una imagen real o una imagen falsa

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["archivo"]["tmp_name"]);
    if ($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $target_dir = ".\subidas";
        $target_file = $target_dir . "\\" . basename($_FILES["archivo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;
    }
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
        echo "El archivo " . basename($_FILES["archivo"]["name"]) . " se ha subido correctamente.";
        echo "'<img src=\"$target_file\"/>'";
    } else {
        echo "Hubo un error al subir el archivo.";
        $uploadOk = 0;
    }
}

// echo "'<img src=". $_FILES["archivo"]["tmp_name"] ."' width='". $check[0] ."' height='". $check[1] ."/>'";

?>
