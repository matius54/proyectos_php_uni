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
            <a href="./product.php" class="button">Productos</a>
            <a href="./cathegory.php" class="button">Categorias</a>
        </div>
    </main>
<?php include "./components/footer.php" ?>