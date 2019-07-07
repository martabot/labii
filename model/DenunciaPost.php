<?php
class DenunciaPost extends EntidadBase{
    private $post;
    private $user;
    private $moderador;
    private $fecha;
    private $motivo;
    private $fechaMod;
    
    public function __construct($adapter) {
        $table="denuncia_post";
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
        $poo=$this->post->__get('id');
        $mod=$this->moderador->__get('id');
        
		if(!$this->fechaMod){
			
			$query= "UPDATE `denuncia_post` SET 
                            `idModerador`=$mod,
						    `fechaMod`='$this->fechaMod',
					where 'idPost' = $poo 
                            and 'idUsuario'=$us 
                            and 'fecha'='$this->fecha';";
					
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
			
		}
		else{
            $query= "INSERT INTO `denuncia_post`(`idPost`, `idUsuario`, `fecha`, `motivo`) VALUES (
                 $poo,$us,
                '$this->fecha',
                '$this->motivo');";
			$save=$this->db()->query($query);
			//$this->db()->error;
			return $save;
		}	
    }
}
?>