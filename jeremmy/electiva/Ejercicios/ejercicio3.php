<?php include "../web/header.php" ?>
<?php 
    $nombreError="";
    $emailError="";

    if(empty($_POST['email'])){
        $email = "";
    }else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $email = $_POST['email'];
    } else {
        $emailError = "Correo no Valido";
    }
?>
<ul>
    <li>
        Agrega una validación adicional al campo de correo electrónico para asegurarte de que sea una dirección de correo válida.
    </li>
    <li>
        Si la dirección no es válida, muestra un mensaje de error.
    </li>
</ul>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset class="formulario">
            <legend>Validación de Correo Electrónico</legend>
            <div>
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name">
                <p class="error">
                    <?= $nombreError; ?>
                </p>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <p class="error">
                    <?= $emailError; ?>
                </p>
            </div>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</div>
<fieldset class="mensaje">
    <p>
        Validación de Correo Electrónico.
    </p>
</fieldset>
<?php include "../web/footer.php" ?>