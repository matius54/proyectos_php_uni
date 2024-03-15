<?php
    require_once "./utils.php";
?>
<li id="<?php echo($value["id"]) ?>">
    <div class="head">
        <a title="Expandir">
            <img src="./icons/accordion_dark.svg" class="icon button accordion">
        </a>
        <h2><?= $value["name"] ?></h2>
        <div class="options">
        <?php if($value["access"]) { ?>
            <a title="Editar" href="<?php echo URL::URIquery(args: ["action"=>"update","id"=>$value["id"]], ref: true) ?>">
                <img src="./icons/edit_dark.svg" class="icon button edit">
            </a>
            <a title="Borrar" href="./controller.php<?php echo URL::query(args: ["action"=>"product_delete","id"=>$value["id"]], ref: true) ?>">
                <img src="./icons/delete_dark.svg" class="icon button delete">
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="body">
        <p>Descripcion: <?= $value["description"] ?></p>
        <p>Cantidad: <?= $value["quantity"] ?></p>
        <p>Precio: <?= $value["price"] ?></p>
        <i>Creado el <span class="unixTimestamp"><?php echo $value["createdAt"] ?></span> por <?php echo $value["createdBy"] ?>.</i>
    </div>
</li>