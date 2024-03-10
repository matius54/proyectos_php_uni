<?php

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];

// Validar datos
if(empty($nombre)) {
    echo " ";
}else if (empty($correo)) {
    echo " ";
} else {
    echo " Enviado correctamente." . $nombre;
}

// Procesar datos
// ...



?>