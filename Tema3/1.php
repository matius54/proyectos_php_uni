<?php
    $title = "Página Principal";
    require_once "./model.php";
    $back = false;
    include "./components/header.php";
?>
    <main>
        <div class="container">
            <h2>Opciones</h2>
            <a href="./user.php" class="button">Usuarios</a>
            <a href="./task.php" class="button">Tareas</a>
        </div>
    </main>
<?php include "./components/footer.php" ?>