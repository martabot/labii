<?php
class Comentario extends EntidadBase{
    private $id;
    private $user;
    private $post;
    private $cuerpo;
    private $fecha;
    private $pic;
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
        $poo=$this->post->__get('id');
        $us=$this->user->__get('id');

		if($this->id){
            $query= "UPDATE `comentario` SET 
                `user`= $us,
                `post`= $poo,
                `cuerpo`= '$this->cuerpo',
                `fecha`= '$this->fecha',
                `pic`= '$this->pic',
                `votos`= '$this->votos',
                `status`= '$this->status' 
                WHERE `id`=$this->id;";
			
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
		}
		else{
            $query= "INSERT INTO `comentario`(`user`, `post`, `cuerpo`, `fecha`, `pic`, `votos`, `status`) VALUES (
                 $us,
                 $poo,
                '$this->cuerpo',
                '$this->fecha',
                '$this->pic',
                '$this->votos',
                '$this->status');";
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
		}	
    }
}
?>