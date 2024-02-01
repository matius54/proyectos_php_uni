<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="st.css">
    <?php
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $size = sizeof($url);
        $name = $url[$size-2];
        $url = end($url);
        $url = explode('.', $url);
        $url = $url[0];
        //echo $url;
    ?>
    <title>Ejercicio <?php echo $url ?></title>
</head>
<body>
    <a href=<?php echo "../#$url-$name" ?> class="back">Volver</a>