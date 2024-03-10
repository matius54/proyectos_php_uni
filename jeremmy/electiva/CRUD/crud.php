<?php
class Crud
{

    private $dbh;
    public function __construct()
    {
        $this->conectar();
        if (isset($_POST['action'])) {
            $this->verific($_POST['action']);
        } else {
            $this->showTask();
        }
    }
    private function conectar() // Conectar a la Base de datos
    {
        $host = "localhost";
        $db = "crud";
        $user = "root";
        $password = "";
        $dsn = "mysql:localhost=$host;dbname=$db";

        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }

        // $dbh = null; Para cerrar la conexion
    }

    public function showTask() //Mostrar Tarea
    {
        $this->conectar();
        $stmt = $this->dbh->prepare("SELECT * FROM task");
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($tasks as $task) {
            echo "<div class='task'>";
            echo "<h3>" . $task->name . "</h3>";
            // echo "<p hidden>" . $task->id . "</p>";
            echo "<p>" . $task->description . "</p>";
            echo "<p class='fecha'>". $task->fecha . "</p>";
            echo "<form action='crud.php' method='POST'>";
            echo "<input type='hidden' name='id' value='" . $task->id . "'>";
            echo "<button type='submit' title='Eliminar' name='action' value='deleteTask'>X</button>";
            echo "</form>";
            echo "</div>";
        }
        try {
        } catch (PDOException $e) {
            die("Error al mostrar los datos: " . $e->getMessage());
        }
    }

    private function editTask(int $id)
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        if (!isset($name) && !isset($description)) {
            echo "Campos Vacios";
            return false;
        }
        $this->conectar();
        try {
            $stmt = $this->dbh->prepare("UPDATE task SET name = ?, description = ? WHERE id = ?");
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $description);
            $stmt->bindValue(3, $id);
            $stmt->execute();
            header("location: ./crud.php");
        } catch (PDOException $e) {
            die("Error al editar la tarea: " . $e->getMessage());
        }
    }

    private function deleteTask(int $id) //Eliminar Tarea
    {
        include './';
        $this->conectar();

        try {
            $stmt = $this->dbh->prepare("DELETE FROM task WHERE id = ?;");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            header("location: ./crud.php");
        } catch (PDOException $e) {
            die("Error al eliminar la tarea: " . $e->getMessage());
        }
    }

    private function addTask() //Agregar Tarea
    {
        $this->conectar();
        $a = $_POST['name'];
        $b = $_POST['description'];
        $fecha = date("Y-m-d H:i:s");

        try {
            $stmt = $this->dbh->prepare("INSERT INTO task (name, description, fecha) VALUES (?,?,?);");
            $stmt->bindParam(1, $a);
            $stmt->bindParam(2, $b);
            $stmt->bindParam(3, $fecha);
            $stmt->execute();
            header("location:./crud.php");
        } catch (PDOException $e) {
            die("Error al insertar los valores: " . $e->getMessage());
        }
    }

    private function verific($action)
    {
        switch ($action) {
            case 'addTask':
                $this->addTask();
                break;
            case 'deleteTask':
                $id = $_POST['id']; // Asegúrate de validar el ID antes de usarlo
                $this->deleteTask($id);
                break;
            case 'editTask':
                $this->editTask($_POST['id']); // Asegúrate de validar el ID antes de usarlo
                break;
        }
    }
}
include './formulario.php';
$object = new Crud();
include '../web/footer.php';
