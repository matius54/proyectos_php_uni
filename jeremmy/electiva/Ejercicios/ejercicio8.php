<?php include "../web/header.php" ?>
<?php 
    $error = [];
    
    if (empty($_POST['name'])){
        if (empty($_POST['email'])){
            $error = "x";
        }else {
            $error = "✓";
        }
        $error = "x";
    }else {
        $error = "✓";
    }
?>

<ul>
    <li>
        Mejora el formulario de validación de correo electrónico utilizando expresiones regulares para una validación más precisa.
    </li>
</ul>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset class="formulario">
            <legend>Validación de Correo Electrónico</legend>
            <div>
                <label for="name"><?= $error ?> Nombre</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="email"><?= $error ?> Email</label>
                <input type="text" name="email" id="email">
            </div>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</div>
<fieldset>
    <p>Validación más precisas</p>
</fieldset>
<?php include "../web/footer.php" ?>