<?php
    require_once "./model.php";
    require_once "./utils.php";

    $action = URL::decode("action");
    if(!$backURL = URL::decode("ref")) $backURL = "./1.php";
    if($action === null) URL::redirect($backURL);
    $username = URL::decode("user",$_POST);
    $password = URL::decode("password",$_POST);
    $oldPassword = URL::decode("oldPassword",$_POST);
    $newPassword = URL::decode("newPassword",$_POST);
    $email = URL::decode("email",$_POST);
    $title = URL::decode("title",$_POST);
    $description = URL::decode("description",$_POST);
    $id = URL::decode("id");
    $quantity = URL::decode("quantity",$_POST);
    $price = URL::decode("price",$_POST);
    $cathegory_id = URL::decode("cathegory_id", $_POST);
    
    try {
        switch($action){
            case "user_login":
                if(VALIDATE::username($username) && VALIDATE::password($password)){
                    USER::login($username,$password);
                }
            break;
            case "user_logout":
                USER::logout();
            break;
            case "user_register":
                if(VALIDATE::username($username) && VALIDATE::password($password) && VALIDATE::password($newPassword)){
                    if($password !== $newPassword) throw new Error("Las contraseñas no coinciden");
                    USER::register($username,$password,$email);
                }
            break;
            case "user_unregister":
                if(VALIDATE::password($password))
                    USER::unregister($password);
            break;
            case "user_update":
                USER::update($username,$email);
            break;
            case "user_changePassword":
                if(VALIDATE::password($oldPassword) && VALIDATE::password($newPassword))
                    USER::changePassword($oldPassword,$newPassword);
            break;
            case "task_new":
                if(VALIDATE::title($title))
                    TASK::new($title,$description);
                URL::redirect(URL::baseURI($backURL).URL::query());
            break;
            case "task_update":
                if(VALIDATE::id($id)) TASK::update($id,$title,$description);
                URL::redirect(URL::baseURI($backURL).URL::query(unset: ["id"]));
            break;
            case "task_delete":
                if(VALIDATE::id($id)) TASK::delete($id);
                URL::redirect(URL::baseURI($backURL).URL::query());
            break;
            case "task_toggle":
                if($json = JSON::getJson()){
                    $taskId = $json["id"];
                    $isCompleted = TASK::toggleCompleted($taskId);
                    if(is_bool($isCompleted)){
                        JSON::sendJson(["isCompleted" => $isCompleted]);
                    }else{
                        JSON::sendJson(["error" => true]);
                    }
                }
            break;
            case "product_new":
                if(
                    VALIDATE::title($title) && 
                    VALIDATE::description($description) && 
                    VALIDATE::int($quantity) && 
                    VALIDATE::float($price)
                ){
                    PRODUCT::new($title, $description, $quantity, $price, $cathegory_id);
                }else{
                    throw new Error("Los datos NO SON validos");
                }
                URL::redirect(URL::baseURI($backURL).URL::query());
            break;
            case "product_update":
                if(
                    VALIDATE::id($id) &&
                    VALIDATE::title($title) && 
                    VALIDATE::description($description) && 
                    VALIDATE::int($quantity) && 
                    VALIDATE::float($price)
                    ){
                        PRODUCT::update($id, $title, $description, $quantity, $price, $cathegory_id);
                    }else{
                        var_dump($cathegory_id);
                        throw new Error("Los datos NO SON validos");
                    }
                URL::redirect(URL::baseURI($backURL).URL::query(unset: ["id"]));
            break;
            case "cathegory_delete":
                if(VALIDATE::id($id)) CATHEGORY::delete($id);
                URL::redirect(URL::baseURI($backURL).URL::query());
            break;
            case "cathegory_new":
                if(VALIDATE::description($description)){
                    CATHEGORY::new($description);
                }
                URL::redirect(URL::baseURI($backURL).URL::query());
            break;
            case "cathegory_update":
                if(
                    VALIDATE::id($id) &&
                    VALIDATE::description($description)
                    ){
                        CATHEGORY::update($id, $description);
                    }else{
                        throw new Error("Los datos NO SON validos");
                    }
                URL::redirect(URL::baseURI($backURL).URL::query(unset: ["id"]));
            break;
            case "cathegory_delete":
                if(VALIDATE::id($id)) CATHEGORY::delete($id);
                URL::redirect(URL::baseURI($backURL).URL::query());
            break;
            default:
                throw new Error("Acción no especificada");
            break;
        }
        URL::redirect(URL::baseURI($backURL));
    } catch (Error $e) {
        $error = $e->getMessage();
        include "./components/error.php";
    }
?>