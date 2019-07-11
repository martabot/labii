<?php
class Usuario extends EntidadBase{
    private $id; //Ai
    private $username;
    private $pass;
    private $salt;
	private $fechaAlta;
	private $adminUltMod; //NULL
	private $fechaUltMod;
	private $status; //1
    private $mail;
    private $nombre;
    private $apellido;
    private $bday;
    private $profilePic; //GENERIC
    private $pais;
    
    public function __construct($adapter) {
        $table="usuario";
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
			$query= "UPDATE usuario set status=$this->status WHERE id = $this->id;";

			$save=$this->db()->query($query);
            //return $this->db()->error;
            return $save;
			
			
		}
		else{
            $num=$this->pais->__get('id');
			$query= "INSERT INTO `usuario`(`username`, `pass`, `salt`, `fechaAlta`, `fechaUltMod`, `nombre`, `apellido`, `bday`, `mail`, `profilePic`, `pais`) VALUES (
						   '".$this->username."',
						   '".$this->pass."',
                           '".$this->salt."',
                           '".$this->fechaAlta."',
						   '".$this->fechaUltMod."',
						   '".$this->nombre."',
						   '".$this->apellido."',
						   '".$this->bday."',
                           '".$this->mail."',
						   '".$this->profilePic."',
                           $num);";
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
		}	
    }
	

}
?>