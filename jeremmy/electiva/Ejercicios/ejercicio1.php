<?php include "../web/header.php" ?>

<?php 
    if (empty($_POST['name'])){
        $name="";
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['email'])){
        $email ="";
    } else {
        $email = $_POST['email'];
    }
?>

<ul>
    <li>
        Crea un formulario HTML con dos campos de texto: nombre y correo electrónico.
    </li>
    <br>
    <li>
        Cuando se envíe el formulario, muestra en pantalla los valores ingresados.
    </li>
</ul>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset class="formulario">
            <legend>Datos</legend>
            <div>
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </div>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</div>

<fieldset class="mensaje">
    <legend>Mensaje</legend>
    <p>Hola <b><?= $name ?></b> Bienvenido a un formulario sin Validación.<br>Tu correo es <b><?= $email ?></b></p>
</fieldset>

<?php include "../web/footer.php" ?>