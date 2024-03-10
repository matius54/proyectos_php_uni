<?php
    require_once "./model.php";
    require_once "./utils.php";

    $userId = SESSION::verify();
    if(!isset($title))
        $title = "";
    if($ref = URL::decode("ref"))
        $backURL = $ref;
    if(!isset($backURL))
        $backURL = "./1.php";
    if(!isset($back))
        $back = true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="guitarherostyles.css">
</head>
<body>
<header class="nav">
    <?php if( $back ) { ?>
    <a title="Volver" href="<?php echo $backURL ?>">
        <img src="./icons/accordion_dark.svg" class="icon button accordion" style="transform: rotate(90deg);">
    </a>
<?php } ?>
<h1><?php echo $title ?></h1>
<?php if( $userId ) { ?>
<a title="Ver mi perfil" href="<?php echo "./user.php".URL::query(args: ["action"=>"profile"],ref: true, unset: ["id"]) ?>">
    <img src="./icons/profile_dark.svg" class="icon button profile">
</a>
<?php } else { ?>
<a title="Iniciar Sesión" href="<?php echo "./user.php".URL::query(args: ["action"=>"login"],ref: true) ?>">
    <img src="./icons/login_dark.svg" class="icon button login">
</a>
<?php } ?>
</header>