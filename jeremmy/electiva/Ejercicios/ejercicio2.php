<?php include "../web/header.php" ?>
<?php
$nombreError = "";
$emailError = "";
$name = " ";
$email = " ";
if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $nombreError = "El campo nombre es obligatorio.";
}

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $emailError = "El campo email es obligatorio.";
}
?>
<ul>
    <li>
        Los campos de nombre y correo electrónico sean obligatorios.
    </li>
    <br>
    <li>
        Si alguno de los campos no se completa, muestra un mensaje de error.
    </li>
</ul>

<div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset class="formulario">
            <legend>Validación de Campos</legend>
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

<?php include "../web/footer.php" ?>