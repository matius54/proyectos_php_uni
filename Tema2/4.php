<?php include "start.php" ?> 
<form method="POST" class="cnt" autocomplete="off">
    <fieldset>
        <legend>Seleccion multiple</legend>
        <label>Opcion 1: <input name="1_a" value="1" type="checkbox"></label>
        <label>Opcion 2: <input name="1_b" value="2" type="checkbox"></label>
        <label>Opcion 3: <input name="1_c" value="3" type="checkbox"></label>
    </fieldset>
    <fieldset>
        <legend>Seleccion exclusiva</legend>
        <label>Opcion 1: <input name="2_" value="1" type="radio"></label>
        <label>Opcion 2: <input name="2_" value="2" type="radio"></label>
        <label>Opcion 3: <input name="2_" value="3" type="radio"></label>
    </fieldset>
    <input type="submit">
</form>
<div class="cnt">
    <!--Respuesta del servidor-->
    <?php
        if($_POST){
            foreach($_POST as $key => $value){
                if(str_starts_with($key,"1_")){
                    echo "<p>Campo 1: opcion $value seleccionada</p>";
                }elseif($key === "2_"){
                    echo "<p>Campo 2: opcion $value seleccionada</p>";
                }
            }
        }else{
            echo "<i>Ninguna opcion seleccionada</i>";
        }
    ?>
</div>
<?php include "end.html" ?> 