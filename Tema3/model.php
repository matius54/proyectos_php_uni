<?php
    require_once "./utils.php";
    require_once "./db_pdo.php";
    require_once "./paginator.php";

    class USER {
        static function login($username, $password, $isTemporal = false){
            $userId = self::auth($username,$password);
            if($userId){
                self::startSession($userId, $isTemporal);
                return true;
            }
            throw new Error("Usuario y/o contraseña incorrecta");
        }
        static function logout(){
            $id = SESSION::verify();
            if($id){
                $db = DB::getInstance();
                $db->execute("DELETE FROM session WHERE user_id = ?",[$id]);
                SESSION::end();
                return true;
            }
            return false;
        }
        static function register($username, $password, $email = null){
            $hash = null;
            $salt = null;
            SC::password($password,$hash,$salt);
            $db = DB::getInstance();
            $db->execute("SELECT id FROM user WHERE username = ?",[$username]);
            if($db->fetch()) throw new Error("Usuario duplicado");
            $db->execute("INSERT INTO user (username, hash, salt, email, created_at) VALUES (?, UNHEX(?), UNHEX(?), ?, ?)",[$username,$hash,$salt,$email,TIME::now()]);
            $db->execute("SELECT id FROM user WHERE username = ?",[$username]);
            $response = $db->fetch();
            if($response){
                try {
                    self::login($username, $password);
                } catch (Error $e){
                    throw new Error("ha ocurrido un error al iniciar sesion automaticamente: ".$e->getMessage());
                }
                return $response["id"];
            }
            return null;
        }
        static function unregister($password){
            $userId = SESSION::verify();
            $db = DB::getInstance();
            $db->execute("SELECT username FROM user WHERE id = ?",[$userId]);
            $response = $db->fetch();
            if(self::auth($response["username"],$password) === $userId){
                $db->beginTransaction();
                $db->execute("DELETE FROM task WHERE user_id = ?",[$userId]);
                self::logout();
                $db->execute("DELETE FROM user WHERE id = ?",[$userId]);
                $db->commit();
                return true;
            }
            return false;
        }
        static function update($username = null,$email = null){
            $userId = SESSION::verify();
            if($userId){
                $db = DB::getInstance();
                $db->execute("UPDATE user SET username = ?, email = ? WHERE id = ?",[$username, $email, $userId]);
                return true;
            }
            return false;
        }
        static function changePassword($oldPassword, $newPassword){
            $userId = SESSION::verify();
            $db = DB::getInstance();
            $db->execute("SELECT username FROM user WHERE id = ?",[$userId]);
            $response = $db->fetch();
            if(self::auth($response["username"],$oldPassword) === $userId){
                $hash = null;
                $salt = null;
                SC::password($newPassword,$hash,$salt);
                $db->execute("UPDATE user SET hash = UNHEX(?), salt = UNHEX(?) WHERE id = ?",[$hash,$salt,$userId]);
                return true;
            }
            return false;
        }
        static private function auth($username, $password){
            $db = DB::getInstance();
            $db->execute("SELECT HEX(salt) AS salt FROM user WHERE username = ?",[$username]);
            $response = $db->fetch();
            if(!$response)throw new Error("Usuario no encontrado");
            $salt = $response["salt"];
            $hash = null;
            SC::password($password,$hash,$salt);
            $db->execute("SELECT id FROM user WHERE hash = UNHEX(?)",[$hash]);
            $response = $db->fetch();
            if(isset($response["id"])){
                return $response["id"];
            }
            throw new Error("Usuario y contraseña no coinciden");
            return null;
        }
        static private function startSession($id,$isTemporal = false){
            self::logout();
            $sessionKey = SC::randomHexStr(128);
            if(!is_bool($isTemporal))$isTemporal = false;
            $db = DB::getInstance();
            $db->execute("DELETE FROM session WHERE user_id = ?",[$id]);
            $db->execute("INSERT INTO session (user_id, session, temporal, created_at, last_access) VALUES (?,UNHEX(?),?,?,?)",[$id, $sessionKey, $isTemporal, TIME::now(), TIME::now()]);
            SESSION::start($sessionKey,$isTemporal);
            return true;
        }
        static function get($id) : array {
            $db = DB::getInstance();
            $userId = SESSION::verify();
            $db->execute("SELECT user.id AS id, username, email, user.created_at as createdAt, session.created_at as lastSession, last_access as lastAccess, user.id = ? as access FROM user LEFT JOIN session ON user.id = user_id WHERE user.id = ?",[$userId, $id]);
            return $db->fetch(htmlspecialchars: true);
        }
        static function getAll() : array {
            $query = "SELECT user.id AS id, username, email, user.created_at as createdAt, session.created_at as lastSession, last_access as lastAccess, user.id = ? as access FROM user LEFT JOIN session ON user.id = user_id";
            $userId = SESSION::verify();
            return PAGINATOR::paginate($query,[$userId]);
        }
    }
    class TASK {
        static function isValid($id) {
            if(!($id = VALIDATE::toInt($id))) return null;
            $db = DB::getInstance();
            $db->execute("SELECT COUNT(*) FROM task WHERE id = ?",[$id]);
            if($db->fetch()["COUNT(*)"] === 1) return $id;
            return null;
        }
        static function new($title,$description = null) : int {
            $userId = SESSION::verify();
            if(!$userId) throw new Error("Necesita iniciar sesion para crear una tarea");
            $db = DB::getInstance();
            $db->beginTransaction();
            $db->execute("SELECT id FROM task ORDER BY id DESC LIMIT 1");
            $id = $db->fetch()["id"];
            $db->execute("INSERT INTO task (user_id, title, description, created_at) VALUES (?, ?, ?, ?)",[$userId,$title,$description, TIME::now()]);
            $db->commit();
            if(!$db->error()){
                return $id + 1;
            }
            return -1;
        }
        static function update($id,$title,$description){
            if(!($id = self::isValid($id))) return;
            $db = DB::getInstance();
            if($title != null && $description != null){
                $db->execute("UPDATE task SET title = ?, description = ? WHERE id = ?",[$title,$description,$id]);
            }else{
                throw new Error("No se han recibido los parametros necesarios");
            }
        }
        static function toggleCompleted($id) {
            if(!($id = self::isValid($id))) return false;
            if($userId = SESSION::verify()){
                #TODO userId usage and validation
                $db = DB::getInstance();
                $db->execute("SELECT completed FROM task WHERE id = ? AND user_id = ?",[$id, $userId]);
                $result = $db->fetch();
                $result = $result["completed"];
                if(is_int($result)){
                    $db->execute("UPDATE task SET completed = ? WHERE id = ?",[!$result,$id]);
                    return !$result;
                }
            }
        }
        static function delete($id){
            if(!self::isValid($id)) return;
            $db = DB::getInstance();
            $db->execute("DELETE FROM task WHERE id = ?",[$id]);
        }
        static function get($id) : array {
            $db = DB::getInstance();
            $userId = SESSION::verify();
            $db->execute("SELECT task.id AS id, title, description, task.created_at AS createdAt, username AS createdBy, completed, task.user_id = ? AS access FROM task JOIN user ON user_id = user.id WHERE task.id = ?",[$userId, $id]);
            return $db->fetch(htmlspecialchars: true);
        }
        static function getUser($id) : array {
            $db = DB::getInstance();
            $db->execute("SELECT COUNT(*) AS totalTasks, COUNT(CASE WHEN completed = true THEN 1 END) AS completedTasks FROM task WHERE user_id = ?",[$id]);
            return $db->fetch(htmlspecialchars: true);
        }
        static function getAll() : array {
            $query = "SELECT task.id AS id, title, description, task.created_at AS createdAt, username AS createdBy, completed, task.user_id = ? AS access FROM task JOIN user ON user_id = user.id";
            $userId = SESSION::verify();
            return PAGINATOR::paginate($query,[$userId]);
        }
    }
    class PRODUCT {
        static function isValid($id) {
            if(!($id = VALIDATE::toInt($id))) return null;
            $db = DB::getInstance();
            $db->execute("SELECT COUNT(*) FROM product WHERE id = ?",[$id]);
            if($db->fetch()["COUNT(*)"] === 1) return $id;
            return null;
        }
        static function new($name, $description, $quantity, $price) : int {
            $userId = SESSION::verify();
            if(!$userId) throw new Error("Necesita iniciar sesion para crear un producto");
            $db = DB::getInstance();
            $db->beginTransaction();
            $db->execute("SELECT COUNT(*) FROM product ORDER BY id DESC LIMIT 1");
            $id = $db->fetch()["COUNT(*)"];
            $db->execute("INSERT INTO product (user_id, name, description, quantity, price, created_at) VALUES (?, ?, ?, ?, ?, ?)",[$userId,$name,$description,$quantity,$price, TIME::now()]);
            $db->commit();
            if(!$db->error()){
                return $id + 1;
            }
            return -1;
        }
        static function update($id, $name, $description, $quantity, $price){
            if(!($id = self::isValid($id))) return;
            $db = DB::getInstance();
            $db->execute("UPDATE product SET name = ?, description = ?, quantity = ?, price = ?  WHERE id = ?",[$name,$description,$quantity,$price,$id]);
            //throw new Error("No se han recibido los parametros necesarios");
        }
        static function delete($id){
            if(!self::isValid($id)) return;
            $db = DB::getInstance();
            $db->execute("DELETE FROM product WHERE id = ?",[$id]);
        }
        static function get($id) : array {
            $db = DB::getInstance();
            $userId = SESSION::verify();
            $db->execute("SELECT product.id AS id, name, description, quantity, price, product.created_at AS createdAt, product.user_id = ? AS access, user.username AS createdBy FROM product JOIN user ON user_id = user.id WHERE product.id = ?",[$userId, $id]);
            return $db->fetch(htmlspecialchars: true);
        }
        static function getUser($id) : array {
            $db = DB::getInstance();
            $db->execute("SELECT COUNT(*) AS totalProducts FROM product WHERE user_id = ?",[$id]);
            return $db->fetch(htmlspecialchars: true);
        }
        static function getAll() : array {
            $query = "SELECT product.id AS id, name, description, quantity, price, product.created_at AS createdAt, product.user_id = ? AS access, user.username AS createdBy FROM product JOIN user ON user_id = user.id";
            $userId = SESSION::verify();
            return PAGINATOR::paginate($query,[$userId]);
        }
    }
    class SESSION {
        static $key = "__crud_session";
        static $expiration = 3600;
        static function get(){
            if(isset($_COOKIE[self::$key])){
                return $_COOKIE[self::$key];
            }
            return null;
        }
        static function start($value,$session = false) : void {
            $expiration = "";
            if(!$session){
                $expiration = " expires=".gmdate(DateTime::COOKIE,time()+self::$expiration).";";
            }
            header("Set-Cookie: ".self::$key."=$value;$expiration path=/; SameSite=Strict; HttpOnly=true;");
        }
        static function end() : void {
            header("Set-Cookie: ".self::$key."=; expires=".gmdate(DateTime::COOKIE,time()-1)."; path=/; SameSite=Strict; HttpOnly=true;");
        }
        static function verify(){
            if($session = self::get()){
                $db = DB::getInstance();
                $db->execute("SELECT user_id, temporal FROM session WHERE session = UNHEX(?) ORDER BY id DESC LIMIT 1 OFFSET 0",[$session]);
                if($response = $db->fetch()){
                    $userId = $response["user_id"];
                    $db->execute("UPDATE session SET last_access = ? WHERE user_id = ?",[TIME::now(), $userId]);
                    if(!$response["temporal"])self::start($session);
                    return $userId;
                }
            }
            return null;
        }
        static function isSession(){
            if($session = self::get()){
                $db = DB::getInstance();
                $db->execute("SELECT temporal FROM session WHERE session = UNHEX(?) ORDER BY id DESC LIMIT 1 OFFSET 0",[$session]);
                if($response = $db->fetch()){
                    if($response["temporal"]){
                        return true;
                    }else{
                        self::start($session);
                        return false;
                    }
                }
            }
            return null;
        }
    }
?>