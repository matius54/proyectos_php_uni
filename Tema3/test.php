<?php   
    $title = "Lista de Tareas";
    $page = 1;
    if(URL::decode("page") !== null){
        $page = intval(URL::decode("page"));
    }
    require_once "./model.php";
    require_once "./paginator.php";

    $pages = TASK::page();
    $lastPage = $pages["lastPage"];
    
    $allTasks = TASK::getAll($page);
    include "./components/header.php";
?>
<main>
    <ul class="list task">
    <?php foreach ($allTasks as $key => $value) {
        include "./components/listItemTask.php";
    }
    ?>
    </ul>
    <?php echo PAGINATOR::show($page,$pages["lastPage"],$pages["itemCount"]) ?>
</main>

<?php include "./components/footer.php" ?>