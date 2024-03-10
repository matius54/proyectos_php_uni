<?php 
    require_once "./utils.php";
    require_once "./model.php";
    require_once "./paginator.php";

    $title = null;
    $allActions = [
        "new" => "Nueva Tarea",
        "update" => "Actualizar Tarea"
    ];
    $action = URL::decode("action");
    $id = URL::decode("id");
    if(isset($allActions[$action])){
        $title = $allActions[$action];
        $backURL = URL::URIquery(unset: ["action","id"]);
    }else{
        $title = "Lista de Tareas";
        $action = null;
    }

    include "./components/header.php";
    #USER::login("Admin","admin123");
?>
<main>
    <?php if($action) { ?>
    <div>
        <form method="post" action="./controller.php<?php echo URL::query(["action"=>"task_".$action], ref: true) ?>" autocomplete="off">
            <?php
                if($action == "update" && $id !== null){
                    $update = TASK::get($id);
                    $name = $update["title"];
                    $description = $update["description"];
                }
                include "./components/formInputs/name.php";
                include "./components/formInputs/description.php";
            ?>
            <input type="submit" value="<?php echo $title ?>">
        </form>
    </div>
    <?php 
    } else { 
        [$allTasks, $menu] = TASK::getAll();
        ?>
        <ul class="list task">
        <?php if($userId) { ?>
        <div class="container">
            <a class="button" href="<?php echo URL::URIquery(args: ["action"=>"new"], ref: true) ?>">Nueva tarea</a>
        </div>
        <?php } ?>
        <?php foreach ($allTasks as $key => $value) {
            include "./components/listItemTask.php";
        }
        ?>
        </ul>
        <?php echo $menu ?>
        <?php } ?>
</main>
<script src="./ajax.js"></script>
<script src="./list.js"></script>
<?php include "./components/footer.php" ?>