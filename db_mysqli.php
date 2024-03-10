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
        catch(mysqli_sql_exception $e){
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
    private function getBindStr($params){
        $newParams = [];
        $types = "";
        foreach ($params as $param) {
            if(!isset($param))continue;
            if(is_bool($param)){
                $param = intval($param);
            }
            if(is_int($param)){
                array_push($newParams,$param);
                $types .= "i";
            }else if(is_string($param)){
                array_push($newParams,$param);
                $types .= "s";
            }else if(is_float($param)){
                array_push($newParams,$param);
                $types .= "d";
            }
        }
        $params = $newParams;
        return $types;
    }

    private function initialize(){
        $this->createDB();
        $this->createTables();
        $this->finally();
    }
    private function connect(){
        $this->conn = new mysqli($this->config["host"], $this->config["username"], $this->config["password"], $this->config["database"]);
        $this->conn->set_charset("utf8");
    }
    private function createDB(){
        $conn = new mysqli($this->config["host"], $this->config["username"], $this->config["password"]);
        $conn->set_charset("utf8");
        $dbname = $this->config["database"];
        $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
        $conn->close();
        $this->connect();
    }
    private function createTables(){
        foreach ($this->config["structure"] as $table => $value) {
            try{
                $this->conn->query("CREATE TABLE IF NOT EXISTS $table (".join(", ",$value).")");
                $this->error = false;
            }catch(mysqli_sql_exception $e){
                $this->showException($e,"Ha ocurrido un error creando la tabla \"$table\" automaticamente");
            }
        }
    }
    private function finally(){
        foreach ($this->config["finally"] as $value){
            try{
                $this->conn->query($value);
                $this->error = false;
            }catch(mysqli_sql_exception $e){
                $this->showException($e,"Ha ocurrido un error ejecutando el bloque finally",$value);
            }
        }
    }
    public function close(){
        $this->conn->close();
    }
    public function fetch($htmlspecialchars = null){
        if($htmlspecialchars === null) $htmlspecialchars = false;
        if($this->result instanceof mysqli_stmt)$this->result = $this->result->get_result();
        if($this->result instanceof mysqli_result){
            $data = $this->result->fetch_assoc();
            if($htmlspecialchars && $data != null){
                foreach ($data as $key => $value) {
                    $data[$key] = htmlspecialchars($value);
                }
            }
            return $data;
        }
    }
    public function fetchAll($htmlspecialchars = null){
        $result = [];
        $idx = 0;
        while ($row = $this->fetch($htmlspecialchars)){
            $result[$idx] = $row;
            $idx++;
        }
        return $result;
    }
    public function rowCount(){
        if($this->result === null || !isset($this->result->affected_rows)) return;
        return $this->result->affected_rows;
    }
    public function execute($sql,$arg=null){
        try{
            if($arg == null){
                $this->result = $this->conn->query($sql);
            }else{
                $type = $this->getBindStr($arg);
                $prepared = $this->conn->prepare($sql);
                $ref = [];
                for($i = 0; $i <= sizeof($arg) ;$i++){
                    if(!$i){
                        $ref[$i] = &$type;
                    }else{
                        $ref[$i] = &$arg[$i-1];
                    }
                }
                call_user_func_array([$prepared,"bind_param"],$ref);
                $prepared->execute();
                $this->result = $prepared;
            }
            $this->error = false;
        }catch(mysqli_sql_exception $e){
            $this->showException($e,"Ha ocurrido un error ejecutando SQL",$sql,$arg);
        }
    }
    public function beginTransaction(){
        $this->conn->autocommit(false);
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
