<?php include "../web/header.php" ?>
<?php
$tiposPermitidos = array("image/jpeg", "image/png", "image/gif");
$aviso = [];
if(empty($_FILES['file'])){
    $aviso = "Los archivos permitidos son JPEG, PNG, GIF";
}else{
    $archivo = $_FILES['file'];
    if (in_array($archivo['type'], $tiposPermitidos)) {
        move_uploaded_file($archivo['tmp_name'],"uploads/" . $archivo['name']);
        $aviso = "Archivo subido correctamente.";
    } else {
        $aviso = "El tipo de archivo no es válido.";
    }
} 
?>
<ul>
    <li>
        Crea un formulario que permita a los usuarios subir archivos al servidor.
    </li>
    <li>
        Al recibir el archivo, valida que sea de un tipo permitido y muestra un mensaje de éxito o error.
    </li>
</ul>
<div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <fieldset class="formulario">
            <legend>Envia un Archivo</legend>
            <div>
                <label for="file">Archivo</label>
                <input type="file" name="file" id="file">
            </div>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</div>
<fieldset>
    <legend>Aviso</legend>
    <p><b><?= $aviso ?></b></p>
</fieldset>
<?php include "../web/footer.php" ?>