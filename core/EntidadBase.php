<?php
session_start();
ini_get('register_globals');

class EntidadBase{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table, $adapter) {
        $this->table=(string) $table;
        
        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();
		 
		$this->conectar = null;
		$this->db = $adapter;
    }
    
    public function getConetar(){
        return $this->conectar;
    }
    
    public function db(){
        return $this->db;
    }
    
    public function getAll(){
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY id ASC");

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }

    public function getAllPost($persona){
        $query=$this->db->query("SELECT * from post where user=$persona and status=1 ORDER BY fecha DESC;");

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }

    public function getCountCom($id){
        $query=$this->db->query("SELECT p.id,count(c.id) as cant FROM post p,comentario c WHERE p.user=$id and p.id=c.post GROUP by p.id ORDER BY p.fecha DESC;");

        while($row = $query->fetch_assoc()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }

    public function getComentarios($id){
        $query=$this->db->query("SELECT u.username,c.cuerpo FROM usuario u, comentario c WHERE c.post=$id and c.user=u.id ORDER BY c.fecha DESC;");

        while($row = $query->fetch_assoc()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }
    
    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        return $resultSet;
    }
    
    public function getOneBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");

        if($row = $query->fetch_assoc()) {
           $resultSet=$row;
        }
        
        return $resultSet;
    }
    
    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }

    public function getPublicos(){
        $query=$this->db->query("SELECT u.username,u.id,p.id as unico,p.titulo,p.cuerpo FROM post p, usuario u WHERE p.user=u.id and p.privacidad=1 ORDER BY p.fecha DESC;");

        $i=0;
        while($i<7&&$row = $query->fetch_assoc()) {
           $resultSet[]=$row;
           $i++;
        }
        
        return $resultSet;
    }

    public function getAmigos($id1,$id2){
        $query=$this->db->query("SELECT * FROM amigo WHERE (user1=$id1 and user2=$id2) or (user2=$id1 and user1=$id2);");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        return $resultSet;
    }

    
    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id"); 
        return $query;
    }
    
    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'"); 
        return $query;
    }
    

    /*
     * Aqui podemos agregar otros métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
    
}
?>
