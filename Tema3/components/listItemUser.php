<?php
    require_once "./utils.php";
    if($value["lastSession"]){
        $lastSession = $value["lastSession"] ?? "Desconocido";
    }
    if($value["lastSession"]){
        $lastSession = $value["lastSession"] ?? "Desconocido";
    }

?>

<li id="<?php echo($value["id"]) ?>">
    <div class="head">
        <a title="Expandir">
            <img src="./icons/accordion_dark.svg" class="icon button accordion">
        </a>
        <h2><?php echo $value["username"] ?></h2>
        <div class="options">
            <?php if($value["access"]) { ?> 
            <a title="Editar" href="<?php echo URL::URIquery(args: ["action" => "update"], ref: true) ?>">
                <img src="./icons/edit_dark.svg" class="icon button edit">
            </a>
            <a title="Eliminar Cuenta"  href="<?php echo URL::URIquery(args: ["action" => "unregister"], ref: true) ?>">
                <img src="./icons/delete_dark.svg" class="icon button delete">
            </a>
            <?php } else { ?>
            <a title="Ver perfil de <?php echo($value["username"]) ?>"  href="<?php echo URL::URIquery(args: ["action" => "profile","id" => $value["id"]], ref: true) ?>">
                <img src="./icons/profile_dark.svg" class="icon button profile">
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="body">
        <p><?php if(isset($value["email"])) echo "Correo: ".$value["email"] ?></p>
        <i>Se registro el <span class="unixTimestamp"><?php echo($value["createdAt"]) ?></span></i>
        <i>Ultimo inicio de sesion <span class="unixTimestamp"><?php echo($value["lastSession"]) ?></span></i>
        <i>Ultima actividad <span class="unixTimestamp"><?php echo($value["lastAccess"]) ?></span></i>
    </div>
</li>
