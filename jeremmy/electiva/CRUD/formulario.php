<?php include '../web/header.php'; ?>
<div class="function">
    <label for="activo" id="xd">+</label>

    <input type="checkbox" id="activo" hidden>
    <form action="crud.php" method="post" id="form">
        <div>
            <label for="name">Nombre de la Tarea</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="description">Descripcion de la Tarea</label>
            <input type="text" id="description" name="description" required>
        </div>
        <button name="action" value="addTask">Guardar</button>
        <label for="activo" id="xd-2">X</label>
    </form>
</div>