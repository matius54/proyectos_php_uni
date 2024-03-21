<?php 
    require_once "./utils.php";
    require_once "./model.php";
    require_once "./paginator.php";

    $title = null;
    $allActions = [
        "new" => "Nuevo Producto",
        "update" => "Actualizar Producto"
    ];
    $action = URL::decode("action");
    $id = URL::decode("id");
    if(isset($allActions[$action])){
        $title = $allActions[$action];
        $backURL = URL::URIquery(unset: ["action","id"]);
    }else{
        $title = "Lista de productos";
        $action = null;
    }

    include "./components/header.php";
    #USER::login("Admin","admin123");
?>
<main>
    <?php if($action) { ?>
    <div>
        <form method="post" action="./controller.php<?php echo URL::query(["action"=>"product_".$action], ref: true) ?>" autocomplete="off">
            <?php
                $cathegory_id = 0;
                if($action === "update" && $id !== null){
                    $update = PRODUCT::get($id);
                    $name = $update["name"];
                    $description = $update["description"];
                    $quantity = $update["quantity"];
                    $price = $update["price"];
                    $cathegory_id = intval($update["cathegory_id"]);
                }
                include "./components/formInputs/name.php";
                include "./components/formInputs/description.php";
                $dName = "Cantidad";
                $name = "quantity";
                include "./components/formInputs/integer.php";
                $dName = "Precio";
                $name = "price";
                include "./components/formInputs/float.php";
                $cathegories = PRODUCT::getCathegories();
                echo HTML::array2list(array:$cathegories, name: "cathegory_id", title: "Selecciona la categoria", selected: $cathegory_id);
            ?>
            <input type="submit" value="<?php echo $title ?>">
        </form>
    </div>
    <?php 
    } else { 
        //PRODUCT::new("hola","descriptcion",1,1.2);
        [$allTasks, $menu] = PRODUCT::getAll();
        ?>
        <ul class="list task">
        <?php if($userId) { ?>
        <div class="container">
            <a class="button" href="<?php echo URL::URIquery(args: ["action"=>"new"], ref: true) ?>">Nuevo producto</a>
        </div>
        <?php } ?>
        <?php foreach ($allTasks as $key => $value) {
            include "./components/listItemProduct.php";
        }
        ?>
        </ul>
        <?php echo $menu ?>
        <?php } ?>
</main>
<script src="./list.js"></script>
<?php include "./components/footer.php" ?>