<?php 
    if(!isset($description)) $description = null;
?>
<label>Descripcion<textarea name="description"><?php if($description !== null) echo $description ?></textarea></label>