<?php
class DenunciaCom extends EntidadBase{
    private $comentario;
    private $user;
    private $dFecha;
    private $moderador;
    private $motivo;
    private $fechaMod;
    
    public function __construct($adapter) {
        $table="denunciaCom";
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
        
		if($this->moderador){
            $mod=$this->moderador->__get('id');
            $us=$this->user->__get('id');
            $com=$this->comentario->__get('id');

			$query= "UPDATE `denunciaCom` SET `idModerador`=$mod,`fechaMod`=NOW() WHERE `idCom`= $com and `idUsuario`= $us and `dFecha`= '$this->dFecha';";
					
            $save=$this->db()->query($query);
            return $save;
            
		}else{
        $us=$this->user->__get('id');
        $com=$this->comentario->__get('id');
            $query= "INSERT INTO `denunciaCom`(`idCom`, `idUsuario`, `dFecha`, `motivo`) VALUES (
                 $com,$us,NOW(),'Hay un motivo para todo');";
			$save=$this->db()->query($query);
            
            //$this->db()->error;
            
			return $save;
		}	
    }
}
?>