<?php
class Admin extends EntidadBase{
    private $id;
    private $username;
	private $pass;
	private $fechaAlta;
	private $adminUltMod;
	private $fechaUltMod;
	private $status;
    private $mail;
    
    public function __construct($adapter) {
        $table="admin";
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
			$query= "UPDATE 'admin' set 
						`username`='$this->username',
						`pass`='$this->pass',
						`fechaAlta`='$this->fechaAlta',
						`adminUltMod`=".$this->admin->__get('id').",
						`fechaUltMod`='$this->fechaUltMod',
						`mail`='$this->mail',
						`status`='$this->status'
					where 'id' = $this->id";
			
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
		}
		else{
            $ad=$this->admin->__get('id');
			$query= "INSERT INTO `admin`(`username`, `pass`, `fechaAlta`, `adminUltMod`, `fechaUltMod`, `mail`) VALUES (
						   '$this->username',
						   '$this->pass',
						   '$this->fechaAlta',
						    ".$this->admin->__get('id').",
						   '$this->fechaUltMod',
						   '$this->mail');";
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
		}	
    }
	
}
?>