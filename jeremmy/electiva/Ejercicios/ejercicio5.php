<?php include "../web/header.php" ?>
<?php
    if (empty($_POST['option'])){
        $option = "";
    }else {
        $option = $_POST['option'];
    }
?>
<ul>
    <li>
        Crea un formulario con una lista desplegable que contenga diferentes opciones.
    </li>
    <li>
        Cuando se seleccione una opción y se envíe el formulario, muestra en pantalla la opción seleccionada.
    </li>
</ul>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset class="formulario">
            <legend>Formulario con Lista Desplegable</legend>
            <div>
                <select name="option" id="">
                    <option></option>
                    <option>Electiva</option>
                    <option>Programación</option>
                    <option>Base de Datos</option>
                    <option>Ingenieria del Software</option>
                    <option>Proyecto</option>
                </select>
            </div>
            <input type="submit" value="Mostrar">
        </fieldset>
    </form>
</div>
<fieldset class="mensaje">
    <legend>Seleccionaste</legend>
    <p><b><?= $option ?></b></p>
</fieldset>
<?php include "../web/footer.php" ?>