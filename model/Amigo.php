<?php
class Amigo extends EntidadBase{
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
        $us1=$this->user1->__get('id');
        $us2=$this->user2->__get('id');
        
		if($this->status!=0){
            //0 = pendiente (se inserta)
            //1 = aceptado (se actualiza)
            //2 = rechazado (se actualiza)
			
			$query= "UPDATE 'amigo' set 
                        'status'=$this->status, 
                    WHERE user1=$us1 and user2=$us2";
			
			$save=$this->db()->query($query);
            //$this->db()->error;
            
			return $save;
			
		}
		else{
			$query= "INSERT INTO amigo (`user1`, `user2`, `fecha`) VALUES (
                $us1,$us2,'$this->fecha');";

			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
		}	
    }
	

}
?>