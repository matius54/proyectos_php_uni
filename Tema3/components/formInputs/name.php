<?php 
    if(!isset($name)) $name = null;
?>
<label>Nombre<input name="title" type="text" <?php if($name !== null) echo "value=\"$name\"" ?> maxlength="256" required></label>