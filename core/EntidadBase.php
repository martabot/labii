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
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id;");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    /*
     * Aqui podemos agregar otros métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     * 
     * ok, GRACIAS!
     */
    

    public function getAllPost($persona){
        $query=$this->db->query("SELECT * from post where user=$persona and status=1 ORDER BY fecha DESC;");

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getMod(){
        $query=$this->db->query("SELECT u.id,m.status from usuario u JOIN moderador m on(u.mail=m.mail);");
        while ($row = $query->fetch_assoc()) {
            $resultSet[]=$row;
         }
         
         $resultSet=isset($resultSet)?$resultSet:NULL;
         return $resultSet;

    }

    public function listarAmigos($id){
        $query=$this->db->query("SELECT u.id,u.username,DATE(a.fecha) as fecha ,u.profilePic as foto FROM amigo a, usuario u WHERE (a.user1=$id and a.user2=u.id and u.status=1 and a.status=1) or (a.user2=$id and a.user1=u.id and u.status=1 and a.status=1);");
        
        while ($row = $query->fetch_assoc()) {
            $resultSet[]=$row;
         }
         
         $resultSet=isset($resultSet)?$resultSet:NULL;
         return $resultSet;
    }

    public function getModByUser($id){
        $query=$this->db->query("SELECT m.* from usuario u JOIN moderador m on(u.mail=m.mail) where u.id=$id;");
        if ($row = $query->fetch_object()) {
            $resultSet=$row;
         }
         
         $resultSet=isset($resultSet)?$resultSet:NULL;
         return $resultSet;

    }

    public function yaExiste($id){
        $query=$this->db->query("SELECT count(m.mail) as c FROM moderador m,usuario u where u.mail=m.mail and u.id=$id;");
        if($row=$query->fetch_assoc()){
            $resultSet=$row;
        }
        return $resultSet['c']>0?true:false;
    }

    public function getBanned($id){
        $query=$this->db->query("SELECT * from usuario where status=0 and id=$id;");

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getCountCom($id){
        $query=$this->db->query("SELECT p.id,count(c.id) as cant,u.username as username FROM post p,comentario c,usuario u WHERE p.user=$id and p.id=c.post and c.status=1 and p.user=u.id and c.id not in (SELECT c.id FROM comentario c JOIN denunciaCom ON(c.id=idCom and fechaMod is null)) GROUP by p.id ORDER BY p.fecha DESC;");

        while($row = $query->fetch_assoc()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function maxId(){
        $query=$this->db->query("SELECT MAX(id) as 'top' FROM $this->table;");

        if($row = $query->fetch_assoc()) {
           $resultSet=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getAllCom(){
        $query=$this->db->query("SELECT p.id,count(c.id) as cant FROM post p,comentario c WHERE p.id=c.post AND c.id and c.status=1 not in (SELECT c.id FROM denunciaCom d, comentario c WHERE d.idCom=c.id and d.fechaMod is null) GROUP by p.id ORDER BY p.fecha DESC;");

        while($row = $query->fetch_assoc()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
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
        $query=$this->db->query("SELECT * FROM notificacion WHERE user2=$id and `status`=0 ORDER BY fecha DESC;");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getPublicadores(){
        $query=$this->db->query("SELECT p.id,u.username FROM post p,usuario u WHERE p.user=u.id ORDER BY p.fecha DESC;");

        while($row = $query->fetch_assoc()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getComentarios($id){
        $query=$this->db->query("SELECT c.id,u.username,c.cuerpo,c.post,u.id as user FROM comentario c, usuario u WHERE c.post=$id and c.user=u.id and c.status=1 AND c.id not in (SELECT c.id FROM denunciaCom d, comentario c WHERE d.idCom=c.id and d.fechaMod IS NULL) ORDER BY c.fecha DESC;");

        while($row = $query->fetch_assoc()) {
           $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getOneBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value';");

        if($row = $query->fetch_assoc()) {
           $resultSet=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
    
    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column=$value");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getTodos($id){
        $query=$this->db->query("SELECT a.* FROM amigo a, usuario u WHERE (a.user1=$id and a.user2=u.id and u.status=1 and a.status=1) or (a.user2=$id and a.user1=u.id and u.status=1 and a.status=1);");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getByFecha($id){
        $query=$this->db->query("SELECT p.* FROM post p,usuario u WHERE p.user<>$id and p.user=u.id and u.status=1 and p.status=1 and p.privacidad=1 and p.id not in (SELECT d.idPost FROM denunciaPost d WHERE d.idUsuario=$id) and p.user not in (SELECT u.id FROM amigo a JOIN usuario u ON(u.id=a.user1 OR u.id=a.user2) WHERE (a.user1=$id or a.user2=$id) and a.status=1) ORDER BY fecha DESC;");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
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

    public function getAmistad($id,$id2,$s){
        $query=$this->db->query("SELECT * FROM amigo WHERE (user1=$id and user2=$id2) or(user2=$id and user1=$id2) and status=$s ORDER BY fecha DESC LIMIT 1;");

        if($row=$query->fetch_object()){
            $resultSet=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getPostsDenunciados(){
        $query=$this->db->query("SELECT * FROM post p join denunciaPost d on(p.id=d.idPost) where d.fechaMod is NULL order by d.dFecha DESC;");
        while($row=$query->fetch_assoc()){
            $resultSet[]=$row;
        }
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getComDenunciados(){
        $query=$this->db->query("SELECT c.*,d.*,p.user as posteador FROM post p, comentario c join denunciaCom d on(c.id=d.idCom) where c.post=p.id and d.fechaMod is NULL order by d.dFecha DESC;");
        while($row=$query->fetch_assoc()){
            $resultSet[]=$row;
        }
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getPostDeAmigos($id){
        $query=$this->db->query("SELECT p.* FROM post p WHERE p.status=1 and p.id not in (SELECT d.idPost FROM denunciaPost d WHERE d.idUsuario=$id) and p.user IN (SELECT u.id FROM usuario u,amigo a WHERE ((a.user1=$id and a.user2=u.id) or (a.user2=$id and a.user1=u.id)) and a.status=1 and u.status=1) ORDER BY p.fecha DESC;");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getAmigos($id1,$id2){
        $query=$this->db->query("SELECT * FROM amigo WHERE (user1=$id1 and user2=$id2) or (user2=$id1 and user1=$id2) ORDER BY fecha DESC LIMIT 1;");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function buscarPorclave($clave){
        $query=$this->db()->query("SELECT * FROM post WHERE MATCH (palabra1, palabra2, palabra3) AGAINST ('$clave' IN BOOLEAN MODE);");
       
        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }
         
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function buscarPorclaveTitulo($clave){
        $query=$this->db()->query("SELECT * FROM post WHERE MATCH (titulo, cuerpo) AGAINST ('$clave' IN BOOLEAN MODE);");

        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }
         
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function buscarPersonas($persona){
        $query=$this->db()->query("SELECT * FROM usuario WHERE MATCH (username, nombre, apellido) AGAINST ('$clave' IN BOOLEAN MODE);");

        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }
         
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
}

?>






