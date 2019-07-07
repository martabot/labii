<?php
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset;
  
    public function __construct() {
        $db_cfg = include 'config/database.php';
        $this->driver=$db_cfg["driver"];
        $this->host=$db_cfg["host"];
        $this->user=$db_cfg["user"];
        $this->pass=$db_cfg["pass"];
        $this->database=$db_cfg["database"];
        $this->charset=$db_cfg["charset"];
    }
    
    public function conexion(){
        
        if($this->driver=="mysql" || $this->driver==null){
            $con=new mysqli($this->host, $this->user, $this->pass, $this->database);
            //Es necesario para enviar datos al servidor que no pueden ser representados en ASCII puro, como 'ñ' o 'á'.
            $con->query("SET NAMES '".$this->charset."'");
            
            //implementar los controles necesarios para comprobar la conexión exitosa
        }
        
        return $con;
    }
	//implementar cerrar la conexión
}
?>
