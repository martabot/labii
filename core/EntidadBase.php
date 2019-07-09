<?php
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
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getCountCom($id){
        $query=$this->db->query("SELECT p.id,count(c.id) as cant,u.username as username FROM post p,comentario c,usuario u WHERE p.user=$id and p.id=c.post and p.user=u.id GROUP by p.id ORDER BY p.fecha DESC;");

        while($row = $query->fetch_assoc()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getAllCom(){
        $query=$this->db->query("SELECT p.id,count(c.id) as cant FROM post p,comentario c WHERE p.id=c.post GROUP by p.id ORDER BY p.fecha DESC;");

        while($row = $query->fetch_assoc()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }
    public function getAllFrom($id){
        $query=$this->db->query("SELECT * FROM notificacion WHERE user2=$id ORDER BY fecha DESC;");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
    public function getUnseen($id){
        $query=$this->db->query("SELECT * FROM notificacion WHERE user2=$id and 'status'=0 ORDER BY fecha DESC;");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getPublicadores(){
        $query=$this->db->query("SELECT p.id,u.username FROM post p,usuario u WHERE p.user=u.id GROUP by p.id ORDER BY p.fecha DESC;");

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
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
    
    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
    
    public function getOneBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");

        if($row = $query->fetch_assoc()) {
           $resultSet=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
    
    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }

    public function getByFecha($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value' ORDER BY fecha DESC;");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }

    public function getByUsers($u1,$u2){
        $query=$this->db->query("SELECT * FROM notificacion WHERE user1=$u1 and user2=$u2");

        if($row=$query->fetch_object()){
            $resultSet=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getAmistad($id,$id2){
        $query=$this->db->query("SELECT * FROM amigo WHERE (user1=$id and user2=$id2) or(user2=$id and user1=$id2) and status=0;");

        if($row=$query->fetch_object()){
            $resultSet=$row;
        }

        return $resultSet;
    }


    public function getPostDeAmigos($id){
        $query=$this->db->query("SELECT p.* FROM post p WHERE p.user IN (
            SELECT u.id FROM usuario u,amigo a WHERE ((a.user1=$id and a.user2=u.id) or (a.user2=$id and a.user1=u.id)) and a.status=1) ORDER BY p.fecha DESC;");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getAmigos($id1,$id2){
        $query=$this->db->query("SELECT * FROM amigo WHERE (user1=$id1 and user2=$id2) or (user2=$id1 and user1=$id2);");

        while($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getPostDelComentario($id){
        $query=$this->db->query("SELECT p.id from post p,comentario c where p.id=c.post;");
        if($row=$query->fetch_assoc()){
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
