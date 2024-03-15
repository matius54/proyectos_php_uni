<?php 
    if(!isset($dName)) $dName = "Número";
    if(!isset($name)) $name = "integer";
    $value = null;
    if(isset($$name)) $value = $$name;
?>
<label><?= $dName ?><input name="<?= $name ?>" type="number" <?php if($value !== null) echo "value=\"$value\"" ?> required></label>