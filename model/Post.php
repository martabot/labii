<?php 
class Post extends EntidadBase{
	private $id;
	private $user;
	private $cuerpo;
	private $fecha;
	private $titulo;
	private $img1;
	private $img2;
	private $img3;
	private $adjunto;
	private $palabra1;
	private $palabra2;
	private $palabra3;
	private $status;
	private $privacidad;
	private $votos;
	private $porMi;
    
    public function __construct($adapter) {
        $table="post";
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

		if($this->id&&!$this->titulo){
			if($this->porMi){
                $query= "UPDATE `post` SET `status`=$this->status,`porMi`=1 where `id` = $this->id;";
                $save=$this->db()->query($query);
				return $save;
			}else{
				$query= "UPDATE `post` SET `status`=$this->status where `id` = $this->id;";
                $save=$this->db()->query($query);
				return $save;
			}
        } else if($this->id&&$this->titulo){
			$query= "UPDATE `post` SET `cuerpo`='$this->cuerpo',`fecha`= NOW(),`titulo`= '$this->titulo',`palabra1`= '$this->palabra1',`palabra2`= '$this->palabra2',`palabra3`= '$this->palabra3',`privacidad`= $this->privacidad where `id` = $this->id;";

			$save=$this->db()->query($query);
			if($this->db()->error){
				$save=$this->db()->error;
			}
			//$this->db()->error;
			return $save;
		}else{
			$query= "INSERT INTO `post`(`user`, `cuerpo`, `fecha`, `titulo`, `img1`, `img2`, `img3`, `adjunto`, `palabra1`, `palabra2`, `palabra3`, `privacidad`) VALUES (
				".$this->user->__get('id').",
				'$this->cuerpo',
				 NOW(),
				'$this->titulo',
				'$this->img1',
				'$this->img2',
				'$this->img3',
				'$this->adjunto',
				'$this->palabra1',
				'$this->palabra2',
				'$this->palabra3',
				$this->privacidad);";

			$save=$this->db()->query($query);
			/*if($this->db()->error){
				$save=$this->db()->error;
			}*/
			
			return $save;
		}	
    }
	

} 
?>