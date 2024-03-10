<?php
class DB {
    private static $instance = null;

    private $conn = null;
    private $result = null;

    private $error = false;
    private $configFile = "db.json";
    private $config;

    private function __construct(){
        $this->config = json_decode(file_get_contents($this->configFile),true);
        try{
            $this->connect();
            $this->error = false;
        }
        catch(PDOException $e){
            if($e->getCode() !== 1049){
                $this->showException($e,"No se ha podido establecer la conexion con la base de datos");
                die();
            }
            # if database doesnt exist
            $this->initialize();
        }
    }
    static public function getInstance(){
        if(self::$instance == null){
            self::$instance = new DB;
        }
        return self::$instance;
    }
    private function showException($e,$message=null,$sql=null,$args=null){
        $this->error = true;
        if(!$this->config["showErrors"])return;
        if($message)echo "<h1>$message.</h1>";
        switch($e->getCode()){
            case 2002:
                echo "<h3>Revisa que el host este bien en en el archivo de configuracion: \"".$this->configFile."\".</h3>";
            break;
            case 1045:
                echo "<h3>Revisa que el usuario y contraseña esten bien en el archivo de configuracion: \"".$this->configFile."\".</h3>";
            break;
        }
        if($sql)echo "<p>Solicitud SQL: $sql.</p>";
        if($args)echo "<p>Argumentos SQL: [".implode(", ",$args)."].</p>";
        echo "<p>Codigo de error: ".$e->getCode().".</p>";
        echo "<p>Mensaje de error: ".$e->getMessage().".</p>";
    }
    private function getBindType($param){
        if(is_int($param)){
            return PDO::PARAM_INT;
        }else if(is_string($param)){
            return PDO::PARAM_STR;
        }else if(is_bool($param)){
            return PDO::PARAM_BOOL;
        }
        return PDO::PARAM_NULL;
    }
    private function initialize(){
        $this->createDB();
        $this->createTables();
        $this->finally();
    }
    private function connect(){
        $this->conn = new PDO("mysql:host=".$this->config["host"].";charset=utf8;dbname=".$this->config["database"], $this->config["username"], $this->config["password"]);
    }
    private function createDB(){
        $conn = new PDO("mysql:host=".$this->config["host"], $this->config["username"], $this->config["password"]);
        $dbname = $this->config["database"];
        $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");
        $conn = null;
        $this->connect();
    }
    private function createTables(){
        foreach ($this->config["structure"] as $table => $value) {
            try{
                $this->conn->exec("CREATE TABLE IF NOT EXISTS $table (".join(", ",$value).")");
                $this->error = false;
            }catch(PDOException $e){
                $this->showException($e,"Ha ocurrido un error creando la tabla \"$table\" automaticamente");
            }
        }
    }
    private function finally(){
        foreach ($this->config["finally"] as $value){
            try{
                $this->conn->query($value);
                $this->error = false;
            }catch(PDOException $e){
                $this->showException($e,"Ha ocurrido un error ejecutando el bloque finally",$value);
            }
        }
    }
    public function close(){
        $this->conn = null;
    }
    public function fetch($htmlspecialchars = false){
        $result = $this->result->fetch(PDO::FETCH_ASSOC);
        if($htmlspecialchars && is_array($result)){
            foreach ($result as $key => $value) {
                $result[$key] = htmlspecialchars($value);
            }
        }
        return $result;
    }
    public function fetchAll($htmlspecialchars = false){
        $data = $this->result->fetchAll(PDO::FETCH_ASSOC);
        if($htmlspecialchars && is_array($data)) {    
            foreach ($data as $index => $element) {
                if(!is_array($data)) continue;
                foreach ($element as $key => $value) {
                    $element[$key] = htmlspecialchars($value);
                }
                $data[$index] = $element;
            }
        }
        return $data;
    }
    public function rowCount(){
        if($this->result === null) return;
        return $this->result->rowCount();
    }
    public function execute($sql,$arg=[]){
        try{
            $prepared = $this->conn->prepare($sql);
            foreach ($arg as $index => $value) {
                $prepared->bindValue($index + 1, $value, $this->getBindType($value));
            }
            $prepared->execute();
            $this->result = $prepared;
            $this->error = false;
        }catch(PDOException $e){
            $this->showException($e,"Ha ocurrido un error ejecutando SQL",$sql,$arg);
        }
    }
    public function beginTransaction(){
        $this->conn->beginTransaction();
    }
    public function rollback(){
        $this->conn->rollback();
    }
    public function commit(){
        $this->conn->commit();
    }
    public function error(){
        return $this->error;
    }
}
?>