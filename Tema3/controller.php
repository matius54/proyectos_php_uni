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