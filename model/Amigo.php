<?php
class Amigo extends EntidadBase{
    private $id;
    private $user1;
    private $user2;
    private $status;
    private $fecha;
    
    public function __construct($adapter) {
        $table="amigo";
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
        
		if($this->status!=0){
            //0 = pendiente (se inserta)
            //1 = aceptado (se actualiza)
            //2 = rechazado (se actualiza)
			
			$query= "UPDATE `amigo` SET `status`= $this->status WHERE id=$this->id ;";
			
			$save=$this->db()->query($query);
            //$this->db()->error;
			return $save;
			
		}
		else{
            $us1=$this->user1->__get('id');
            $us2=$this->user2->__get('id');
			$query= "INSERT INTO amigo (`user1`, `user2`, `fecha`) VALUES (
                $us1,$us2,NOW());";

			$save=$this->db()->query($query);
			/*if($this->db()->error){
                $save=$this->db()->error;
            }*/
			return $save;
		}	
    }
	

}
?>