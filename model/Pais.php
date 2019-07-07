<?php
class Pais extends EntidadBase{
    private $id;
    private $isoCode;
    private $nombre;
    
    public function __construct($adapter) {
        $table="pais";
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
	
}
?>