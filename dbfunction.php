<?php

date_default_timezone_set("Asia/Taipei");

class dbfunction
{

    private $db_host="localhost";
    private $db_name = "ciras"; 
    private $db_user = "root"; 
    private $db_pass = '';
    private $db ; 
    public static $stmt;
    public static $debug = false;
    


    public function __construct(){
        $this->connect();
    }


    function connect()
    {
        try
        {
            $this->db=new PDO("mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8",$this->db_user,$this->db_pass);
            $this->db->exec("set names utf8");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOEXCEPTION $e)
        {
            $e->getMessage();
        }
    }

    public function close_connection(){
        if(isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }



    /*public function execute($sql) {
        //self::getPDOError($sql);
        return $this->db->exec($sql);
    }*/

    public function insert($table,$set, $args) {
        $sql = "INSERT INTO `$table` $set";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($args); 
        //return self::execute($sql);
    }

    public function update($table, $set,$where,$args ) {
        $sql = "UPDATE $table  SET $set";
        //$code = self::getCode($table, $args);
        //$sql .= $code;
        $sql .= " Where $where";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($args); 
        //return $stmt->fetch(PDO::FETCH_ASSOC);
        //return self::execute($sql);
    }

    public function delete($table, $where,$args) {
        $sql = "DELETE FROM $table Where $where";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($args);
        //return self::execute($sql);
    }

    public function fetOne($table,$field, $where,$args) {
        $sql = "SELECT $field FROM $table";
        if(is_null($where)){
            $stmt = $this->db->prepare($sql);
            $stmt->execute(); 
            return $stmt->fetchAll();
        }
        else{
            $sql .= ($where) ? " WHERE $where" :'';
            $stmt = $this->db->prepare($sql);
            $stmt->execute($args); 
            return $stmt->fetchAll();
        
        }
    
    }

    public function getOne($table,$field,$orderby) {
        $sql="SELECT $field FROM $table  ORDER BY $orderby DESC LIMIT 0 , 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    

    
    /*private $db_host="localhost";
    private $db_name = "ciras"; 
    private $db_user = "root"; 
    private $db_pass = ''; 
    private $db;

    function connect()
    {
        try
        {
            $this->db=new PDO("mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8",$this->db_user,$this->db_pass);
            $this->db->exec("set names utf8");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOEXCEPTION $e)
        {
            $e->getMessage();
        }
    }

    function db(){
        return $this->db;
     }

    function insert5($table, $column1,$column2,$column3,$column4, $column5,$value1,$value2,$value3,$value4,$value5)
    {
        $sql = "INSERT INTO $table ($column1, $column2, $column3,$column4,$column5) VALUES (?,?,?,?,?)";
        $this->db->prepare($sql)->execute([$value1,$value2,$value3,$value4,$value5]);
        //$condition = "INSERT INTO $table ($column) VALUES ($value)";
        //$query = $this->db->query($condition);
        //return $query;
    }

    function insert3($table, $column1,$column2,$column3,$value1,$value2,$value3)
    {
        $sql = "INSERT INTO $table ($column1, $column2, $column3) VALUES (?,?,?)";
        $this->db->prepare($sql)->execute([$value1,$value2,$value3]);
       
    }

    function insert2($table, $column1,$column2,$value1,$value2)
    {
        $sql = "INSERT INTO $table ($column1, $column2) VALUES (?,?)";
        $this->db->prepare($sql)->execute([$value1,$value2]);
    }

    function delete($table,$column,$value)
    {
        $sql = "DELETE FROM $table WHERE $column = ?";
        $this->db->prepare($sql)->execute(array($value));
    }

    function update($table,$column1,$colume2,$value1,$value2)
    {
        $sql = "UPDATE $table SET $column1=? WHERE $colume2=?";
        $this->db->prepare($sql)->execute(array($value1,$value2)); 
    }

    function select2($table,$column1,$column2,$value1,$value2)
    {
        $sth=$this->db() -> prepare("SELECT * FROM $table where $column1 LIKE ? AND $column2 LIKE ?");
        $sth -> execute(array($value1,$value2));
        $result = $sth -> fetch(PDO::FETCH_ASSOC) ;
        return $result;
    }

    function select1($table,$column1,$value1,$value2)
    {
        $sql= "SELECT $value1 FROM $table WHERE $column1 = $value2";
        $stmt = $this->db->query($sql); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        //$folder_id= $row['folder_id'];
    }

    function select0($table)
    {
        $sql= "SELECT * FROM $table";
        $stmt = $this->db->query($sql); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        //$folder_id= $row['folder_id'];
    
    }*/
}

?>