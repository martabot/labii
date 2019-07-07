<?php 
class Moderador extends EntidadBase{
    private $id;
    private $username;
	private $pass;
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
		require_once "Admin.php";
		$ad=$this->admin->__get('id');
		
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
			$query= "INSERT INTO `moderador`(`username`, `pass`, `fechaAlta`, `adminUltMod`, `fechaUltMod`, `mail`) VALUES (
						   '$this->username',
						   '$this->pass',
						   '$this->fechaAlta',
						    $ad,
						   '$this->fechaUltMod',
						   '$this->mail');";
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
		}	
    }
}
?>