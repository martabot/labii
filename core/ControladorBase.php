<?php
class ControladorBase{

    public function __construct() {
		require_once 'Conectar.php';
        require_once 'EntidadBase.php';
        require_once 'ModeloBase.php';
        
        //Incluir todos los modelos
        foreach(glob("model/*.php") as $file){
            include $file;
        }
    }
    
    //funcionalidades comunes a todos los controladores
    
    public function view($vista,$datos){
        if($datos){
         foreach ($datos as $id_assoc => $valor) {
            //define y setea todas las variables que se usarán en la vista
            ${$id_assoc}=$valor; 
        }   
        }
        
        
        //crea una instancia con funciones ùtiles para las vistas
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
    
        require_once 'view/'.$vista.'View.php';
    }
    
    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location:index.php?controller=".$controlador."&action=".$accion);
    }
    
    //Métodos para los controladores

}
?>
