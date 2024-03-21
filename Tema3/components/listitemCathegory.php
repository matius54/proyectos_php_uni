<?php
    require_once "./utils.php";
?>
<li id="<?php echo($value["id"]) ?>">
    <div class="head">
        <a title="Expandir">
            <img src="./icons/accordion_dark.svg" class="icon button accordion">
        </a>
        <h2><?= $value["description"] ?></h2>
        <div class="options">
            <a title="Editar" href="<?php echo URL::URIquery(args: ["action"=>"update","id"=>$value["id"]], ref: true) ?>">
                <img src="./icons/edit_dark.svg" class="icon button edit">
            </a>
            <a title="Borrar" href="./controller.php<?php echo URL::query(args: ["action"=>"cathegory_delete","id"=>$value["id"]], ref: true) ?>">
                <img src="./icons/delete_dark.svg" class="icon button delete">
            </a>
        </div>
    </div>
    <div class="body">
        <p>Esta relacionado a: <?= $value["products"] ?></p>
        <i>Creado el <span class="unixTimestamp"><?php echo $value["createdAt"] ?></span>.</i>
    </div>
</li>