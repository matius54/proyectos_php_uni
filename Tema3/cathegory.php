<?php 
    require_once "./utils.php";
    require_once "./model.php";
    require_once "./paginator.php";

    $title = null;
    $allActions = [
        "new" => "Nueva categoria",
        "update" => "Actualizar categoria"
    ];
    $action = URL::decode("action");
    $id = URL::decode("id");
    if(isset($allActions[$action])){
        $title = $allActions[$action];
        $backURL = URL::URIquery(unset: ["action","id"]);
    }else{
        $title = "Lista de categorias";
        $action = null;
    }

    include "./components/header.php";
    #USER::login("Admin","admin123");
?>
<main>
    <?php if($action) { ?>
    <div>
        <form method="post" action="./controller.php<?php echo URL::query(["action"=>"cathegory_".$action], ref: true) ?>" autocomplete="off">
            <?php
                if($action == "update" && $id !== null){
                    $update = CATHEGORY::get($id);
                    $description = $update["description"];
                }
                include "./components/formInputs/description.php";
            ?>
            <input type="submit" value="<?php echo $title ?>">
        </form>
    </div>
    <?php 
    } else { 
        //PRODUCT::new("hola","descriptcion",1,1.2);
        [$allCathegories, $menu] = CATHEGORY::getAll();
        ?>
        <ul class="list task">
        <?php if($userId) { ?>
        <div class="container">
            <a class="button" href="<?php echo URL::URIquery(args: ["action"=>"new"], ref: true) ?>">Nueva categoria</a>
        </div>
        <?php } ?>
        <?php foreach ($allCathegories as $key => $value) {
            include "./components/listitemCathegory.php";
        }
        ?>
        </ul>
        <?php echo $menu ?>
        <?php } ?>
</main>
<script src="./list.js"></script>
<?php include "./components/footer.php" ?>