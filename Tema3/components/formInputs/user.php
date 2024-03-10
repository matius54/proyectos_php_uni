<?php 
    if(!isset($required)) $required = true;
    if(!isset($user)) $user = null;
?>
<label>Usuario<input name="user" type="text" <?php if($user !== null) echo "value=\"$user\"" ?> maxlength="256" <?php if($required) echo "required" ?>></label>