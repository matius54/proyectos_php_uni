<?php include "start.php" ?> 
<form method="POST" class="cnt">
    <select name="lista">
        <option></option>
        <option>Opcion 1</option>
        <option>Opcion 2</option>
        <option>Opcion 3</option>
        <option>Opcion 4</option>
        <option>Hola</option>
    </select>
    <input type="submit">
</form>
<div class="cnt">
    <?php 
        if(isset($_POST["lista"]) && $_POST["lista"]!==""){
            $opcion = $_POST["lista"];
            echo "<p>$opcion seleccionado</p>";
        }else{
            echo "<i>Ninguna opcion seleccionada</i>";
        }
    ?>
</div>
<?php include "end.html" ?> 