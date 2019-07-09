<?php
class Notificacion extends EntidadBase{
    private $id;
    private $user1;
    private $user2;
    private $status;
    private $descripcion;
    private $fecha;
    private $post;
    private $comentario;
    private $amigo;

    public function __construct($adapter) {
        $table="notificacion";
        parent::__construct($table, $adapter);
    }
    
    public function __get($property) { 
        if (property_exists($this, $property)) { 
        return $this->$property; } 
    }

    public function __set($property, $value) { 
        if (property_exists($this, $property)) { 
        $this->$property = $value; } 
        return $this; 
    } 

    public function save(){
        
        
		if($this->post){
            $us1=$this->user1->__get('id');
            $us2=$this->user2->__get('id');
            $post=$this->post->__get('id');

            $query= "INSERT INTO notificacion (`user1`, `user2`, `fecha`,`descripcion`,`post`) VALUES (
                $us1,$us2,NOW(),'$this->descripcion',$post);";

			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;

        } else if ($this->comentario){
            $us1=$this->user1->__get('id');
            $us2=$this->user2->__get('id');
            $com=$this->comentario->__get('id');

            $query= "INSERT INTO notificacion (`user1`, `user2`, `fecha`,`descripcion`,`comentario`) VALUES (
                $us1,$us2,NOW(),'$this->descripcion',$com);";

			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;

        } else if($this->amigo){
            $us1=$this->user1->__get('id');
            $us2=$this->user2->__get('id');
            $query= "INSERT INTO notificacion (`user1`, `user2`, `fecha`,`descripcion`,`amigo`) VALUES (
                $us1,$us2,NOW(),'$this->descripcion',1);";

			$save=$this->db()->query($query);
            //$this->db()->error;
			return $save;
            

        } else if($this->status){
            $query= "UPDATE 'notificacion' set 
                        'status'=$this->status 
                    WHERE id=$this->id";
			
			$save=$this->db()->query($query);
            //$this->db()->error;
            
			return $save;
        }
    }
}


?>