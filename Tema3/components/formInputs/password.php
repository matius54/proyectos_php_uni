<?php 
    if(!isset($passwordDisplayName)) $passwordDisplayName = "Contraseña";
    if(!isset($passwordName)) $passwordName = "password";
?>
<label><?php echo $passwordDisplayName ?><input name="<?php echo $passwordName ?>" type="password" required></label>