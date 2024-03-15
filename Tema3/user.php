<?php 
    require_once "./utils.php";
    require_once "./model.php";
    require_once "./paginator.php";

    $title = null;
    $allActions = [
        "login" => "Iniciar sesión",
        "register" => "Registrarse",
        "unregister" => "Eliminar cuenta",
        "update" => "Actualizar informacion",
        "changePassword" => "Cambiar contraseña",
        "profile" => "Perfil"
    ];
    $action = URL::decode("action");
    $id = URL::decode("id");
    if(isset($allActions[$action])){
        $title = $allActions[$action];
        $backURL = URL::baseURI();
    }else{
        $title = "Usuarios registrado";
    }

    include "./components/header.php";  
?>
<main>
    <?php if($action && $action !== "profile") { ?>
    <div>
        <form method="post" action="./controller.php<?php echo URL::query(["action"=>"user_".$action], ref: true) ?>" autocomplete="off">
            <?php
                switch($action){
                    case "login":
                        include "./components/formInputs/user.php";
                        include "./components/formInputs/password.php";
                        $linkText = "No tengo cuenta";
                        $href = URL::URIquery(args: ["action"=>"register"], ref: true);
                        include "./components/formInputs/link.php";
                    break;
                    case "register":
                        include "./components/formInputs/user.php";
                        include "./components/formInputs/password.php";
                        $passwordDisplayName = "Confirmar contraseña";
                        $passwordName = "newPassword";
                        include "./components/formInputs/password.php";
                        $required = false;
                        include "./components/formInputs/email.php";
                    break;
                    case "unregister":
                        include "./components/formInputs/password.php";
                    break;
                    case "update":
                        if($userId){
                            $userInfo = USER::get($userId);
                        }
                        $user = $userInfo["username"];
                        $email = $userInfo["email"];
                        $required = false;
                        include "./components/formInputs/user.php";
                        include "./components/formInputs/email.php";
                        $linkText = "Cambiar contraseña";
                        $href = URL::URIquery(args: ["action"=>"changePassword"], ref: true);
                        include "./components/formInputs/link.php";
                    break;
                    case "changePassword":
                        $passwordDisplayName = "Contraseña actual";
                        $passwordName = "oldPassword";
                        include "./components/formInputs/password.php";
                        $passwordDisplayName = "Contraseña nueva";
                        $passwordName = "newPassword";
                        include "./components/formInputs/password.php";
                    break;
                }
            ?>
            <input type="submit" value="<?php echo $title ?>">
        </form>
    </div>
    <?php 
        } elseif ($action === "profile"){
    ?>
    <div class="container">
    <?php
        $id = URL::decode("id");
        VALIDATE::id($id);
        if($userId || $id){ 
            $linkText = "cerrar sesión";
            $href = "./controller.php".URL::query(args: ["action"=>"user_logout"], ref: true);
            if($userId) include "./components/formInputs/link.php";
            if(!$id) $id = $userId;
            $user = USER::get($id);
            $task = TASK::getUser($id);
            $product = PRODUCT::getUser($id);
        ?>
        <p>ID del usuario: <i><?php echo $user["id"] ?></i></p>
        <p>Nombre de usuario: <i><?php echo $user["username"] ?></i></p>
        <p>Correo electrónico: <i><?php echo $user["email"] ?></i></p>
        <p>Fecha de creación: <i class="unixTimestamp"><?php echo $user["createdAt"] ?></i></p>
        <p>Sesión activa: <i><?php echo $user["lastSession"] ? "si" : "no" ?></i></p>
        <p>Última sesión: <i class="unixTimestamp"><?php echo $user["lastSession"] ?></i></p>
        <p>Último acceso: <i class="unixTimestamp"><?php echo $user["lastAccess"] ?></i></p>
        <p>Número de tareas: <i><?php echo $task["totalTasks"] ?></i></p>
        <p>Número de tareas completadas: <i><?php echo $task["completedTasks"] ?></i></p>
        <p>Número de productos: <i><?php echo $product["totalProducts"] ?></i></p>
    <?php } else { ?>
        <h2>No hay nada para mostrar</h2>
    <?php }  ?>
    </div>
    <?php 
    } else { 
        [$allTasks, $menu] = USER::getAll();
        ?>
        <ul class="list user">
        <?php foreach ($allTasks as $key => $value) {
            include "./components/listItemUser.php";
        }
        ?>
        </ul>
        <?php echo $menu ?>
        <?php } ?>
</main>
<script src="./list.js"></script>
<?php include "./components/footer.php" ?>