<?php
    $value = null;
    if(!isset($dName)) $dName = "Número";
    if(!isset($name)) $name = "float";
    if(isset($$name)) $value = $$name;
?>
<label><?= $dName ?><input name="<?= $name ?>" type="text" <?php if($value !== null) echo "value=\"$value\"" ?> maxlength="256" required></label>