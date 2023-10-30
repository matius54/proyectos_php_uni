<!-- Ejercicio 13 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 13</title>
</head>
<body>
    
    <?php
        $ip = $_SERVER["REMOTE_ADDR"];
        $user_header = $_SERVER["HTTP_USER_AGENT"];
        echo "<h2>Tu IP es = ".$ip."</h2>";
        if(strpos($user_header,"Firefox")!== false)echo "<h1>Felicidades por seguir usando firefox en 2023!!</h1>";
    ?>

</body>
</html>