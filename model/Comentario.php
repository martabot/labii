<?php
class Comentario extends EntidadBase{
    private $id;
    private $user;
    private $post;
    private $cuerpo;
    private $fecha;
    private $votos;
    private $status;

    public function __construct($adapter) {
        $table="comentario";
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
        

		if($this->id){
            $query= "UPDATE `comentario` SET 
                `status`= '$this->status' 
                WHERE `id`=$this->id;";
			
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
		}
        else{
            $poo=$this->post->__get('id');
            $us=$this->user->__get('id');
            $query= "INSERT INTO `comentario`(`user`, `post`, `cuerpo`, `fecha`) VALUES (
                 $us,
                 $poo,
                '$this->cuerpo',
                 NOW());";
			$save=$this->db()->query($query);
			if(!$save){
                return $this->db()->error;
            }else{
			return $save;}
		}	
    }
}
?>