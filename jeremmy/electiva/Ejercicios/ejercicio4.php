<?php include "../web/header.php" ?>
<?php
$fruit = [];
$color = [];

if (empty($_POST['item'])) {
    $fruit = [""];
} else {
    $fruit = $_POST['item'];
}
if (empty($_POST['color'])) {
    $color =[""];
} else {
    $color = $_POST['color'];
}
?>
<ul>
    <li>
        Crea un formulario con casillas de verificación para seleccionar uno o varios elementos.
    </li>
    <li>
        Agrega también botones de opción para seleccionar una opción exclusiva.
    </li>
    <li>
        Muestra en pantalla los valores seleccionados al enviar el formulario.
    </li>
</ul>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset class="formulario">
            <legend>Casillas de verificación</legend>
            <div>
                <ul>
                    <li>
                        <input type="checkbox" name="item[]" id="item" value="Mango">
                        <label for="item">Mango</label>
                    </li>
                    <li>
                        <input type="checkbox" name="item[]" id="item-1" value="Mandarina">
                        <label for="item-1">Mandarina</label>
                    </li>
                    <li>
                        <input type="checkbox" name="item[]" id="item-2" value="Cambur">
                        <label for="item-2">Cambur</label>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <input type="radio" name="color[]" id="color" value="Amarillo">
                        <label for="color">Amarillo.</label>
                    </li>
                    <li>
                        <input type="radio" name="color[]" id="color-1" value="Azul">
                        <label for="color-1">Azul.</label>
                    </li>
                    <li>
                        <input type="radio" name="color[]" id="color-2" value="Rojo">
                        <label for="color-2">Rojo</label>
                    </li>
                </ul>
            </div>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</div>
<fieldset class="mensaje">
    <legend>Mensaje</legend>
    <ul>
        <?php
        foreach ($fruit as $item) {
            echo "<li>$item</li>";
        }
        ?>
    </ul>
    <ul>
        <?php
        foreach ($color as $valor) {
            echo "<li>$valor</li>";
        }
        ?>
    </ul>
</fieldset>
<?php include "../web/footer.php" ?>