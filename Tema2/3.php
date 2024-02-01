<?php
    include "start.php";
    //php 7+
    //$name = $_POST["name"] ?? "";
    //$email = $_POST["email"] ?? "";
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
?>
<form method="POST" class="cnt" autocomplete="off">
    <label>Nombre: <input type="text" name="name" required></label>
    <label>Correo: <input type="email" name="email" required></label>
    <input type="submit">
</form>
<div class="cnt">
    <p>Nombre: <?php echo $name; ?></p>
    <p>Correo: <?php echo $email; ?></p>
</div>
<?php include "end.html" ?> 
