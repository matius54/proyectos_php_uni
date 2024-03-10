<?php
require_once "db_connection.php";
require_once "functionsTasks.php";

session_start();
if(!isset($_SESSION["username"])){
    header("LOCATION: login.php");
    exit;
}

$tasks = getAllTasks();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tareas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Lista de tareas</h1>
        <p>Bienvenido, <?php echo $_SESSION["username"] ?>!</p>
        <a href="logout.php" class="btn btn-danger">Cerrar sesion</a>
        <hr>
        <h2>Tareas</h2>
        <a href="create_task.php" class="btn btn-primary">Agregar Tarea</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) {
                    $id = $task["id"] ?>
                    <td><?php echo $task["title"] ?></td>
                    <td><?php echo $task["description"] ?></td>
                    <td><?php echo $task["is_completed"] ? "Copletada" : "Pendiente" ?></td>
                    <td>
                        <a href="view_task.php?id=<?php echo $id ?>" class="btn btn-info btn-sm"></a>
                        <a href="edit_task.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm"></a>
                        <a href="delete_task.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm"></a>
                    </td>    
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>