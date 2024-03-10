<?php
#credenciales de acceso a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$database = "crud";
#crear conexion
$conn = new mysqli($host, $username, $password, $database);
#verificar si hay errores en la conexion
if($conn->connect_error){
    die("error de coneccion a la base de datos: ".$conn->connect_error);
}
#establecer el conjunto de caracteres de la conexion
$conn->set_charset("utf8");