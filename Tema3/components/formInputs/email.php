<?php 
    if(!isset($email)) $email = null;
    if(!isset($required)) $required = false;
?>
<label>Correo<input name="email" type="email" <?php if($email !== null) echo "value=\"$email\"" ?> maxlength="100" <?php if($required) echo "required" ?>></label>