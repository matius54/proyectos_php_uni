<?php
    require_once "./utils.php";
?>
<li id="<?php echo($value["id"]) ?>">
    <div class="head">
        <a title="Expandir">
            <img src="./icons/accordion_dark.svg" class="icon button accordion">
        </a>
        <h2 <?php if($value["completed"])echo "class=\"completed\"" ?>><?php echo $value["title"] ?></h2>
        <div class="options">
        <?php if($value["access"]) { ?>
            <a title="Editar" href="<?php echo URL::URIquery(args: ["action"=>"update","id"=>$value["id"]], ref: true) ?>">
                <img src="./icons/edit_dark.svg" class="icon button edit">
            </a>
            <a title="Borrar" href="./controller.php<?php echo URL::query(args: ["action"=>"task_delete","id"=>$value["id"]], ref: true) ?>">
                <img src="./icons/delete_dark.svg" class="icon button delete">
            </a>
            <a title="¿Esta completada?">
                <img <?php if(!$value["completed"])echo "hidden" ?> src="./icons/check_dark.svg" class="icon button check off">
                <img <?php if($value["completed"])echo "hidden" ?> src="./icons/check_on_dark.svg" class="icon button check on">
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="body">
        <p><?php echo $value["description"] ?></p>
        <i>Creado el <span class="unixTimestamp"><?php echo $value["createdAt"] ?></span> por <?php echo $value["createdBy"] ?>.</i>
    </div>
</li>