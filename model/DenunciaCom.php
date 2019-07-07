<?php
class DenunciaCom extends EntidadBase{
    private $comentario;
    private $user;
    private $fecha;
    private $moderador;
    private $motivo;
    private $fechaMod;
    
    public function __construct($adapter) {
        $table="denuncia_com";
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
        $us=$this->user->__get('id');
        $com=$this->post->__get('id');
        $mod=$this->moderador->__get('id');
        
		if(!$this->fechaMod){
			
			$query= "UPDATE `denuncia_com` SET 
                            `idModerador`=$mod,
						    `fechaMod`='$this->fechaMod',
					where 'idCom' = $com 
                            and 'idUsuario'=$us 
                            and 'fecha'='$this->fecha';";
					
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
		}
		else{
            $query= "INSERT INTO `denuncia_com`(`idCom`, `idUsuario`, `fecha`, `motivo`) VALUES (
                 $com,$us,
                '$this->fecha',
                '$this->motivo');";
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
		}	
    }
}
?>