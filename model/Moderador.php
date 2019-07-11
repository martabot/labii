<?php 
class Moderador extends EntidadBase{
    private $id;
    private $username;
	private $pass;
	private $salt;
	private $fechaAlta;
	private $adminUltMod;
	private $fechaUltMod;
	private $status;
    private $mail;
    
    public function __construct($adapter) {
        $table="moderador";
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
			
			$query= "UPDATE 'moderador' set 
						`username`='$this->username',
						`pass`='$this->pass',
						`fechaAlta`='$this->fechaAlta',
						`adminUltMod`=$ad,
						`fechaUltMod`='$this->fechaUltMod',
						`mail`='$this->mail',
						`status`='$this->status'
					where 'id' = $this->id";
			
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
		}
		else{

			$ad=$this->adminUltMod->__get('id');
			$query= "INSERT INTO `moderador`(`username`, `pass`, `salt`, `mail`, `fechaAlta`, `adminUltMod`, `fechaUltMod`) VALUES (
				'$this->username','$this->pass','$this->salt','$this->mail',NOW(),$ad,NOW())";
			$save=$this->db()->query($query);
			if($this->db()->error){
				$save=$this->db()->error;
			}
			return $save;
		}	
    }
}
?>