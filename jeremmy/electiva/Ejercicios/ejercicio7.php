<?php include "../web/header.php" ?>
<?php
/*----- Estos son los datos para iniciar sesion -----*/
$user = "admin";
$password = 1234;

/*----- Desarrollo del Ejercicio -----*/

$aviso = [];
if (empty($_POST['user'])){
    $aviso = " ";
}else {
    if ($user == $_POST['user']) {
        if ($password == $_POST['password']) {
            $aviso = "Correcto.";
        } else {
            $aviso = "Constraseña Incorrecta.";
        }
    } else {
        $aviso = "Usuario Incorrecto.";
    }
}



?>
<ul>
    <li>
        Crea un formulario de inicio de sesión con campos de nombre de usuario y contraseña.
    </li>
    <li>
        Verifica que los datos ingresados coincidan con una combinación válida almacenada en una sesión.
    </li>
    <li>
        Muestra un mensaje de éxito o error según el resultado.
    </li>
</ul>
<div>
    <form action="" method="post">
        <fieldset class="formulario">
            <legend>Iniciar Sesion</legend>
            <div>
                <label for="user">Usuario</label>
                <input type="text" name="user" id="user">
            </div>
            <div>
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
            </div>
            <input type="submit" value="Iniciar">
        </fieldset>
    </form>
</div>
<div>
    <fieldset>
        <legend>Aviso</legend>
        <p><b><?= $aviso ?></b></p>
    </fieldset>
</div>
<?php include "../web/footer.php" ?>