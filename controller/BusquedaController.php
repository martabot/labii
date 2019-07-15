<?php
session_start();
ini_get('register_globals');

class BusquedaController extends ControladorBase{
    public $conectar;
    public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

    public function buscar(){
        if (isset($_SESSION["id"])) {
            unset($_SESSION["visitante"]);
            $clave=$_POST['clave'];
            $pd=new Post($this->adapter);
            $postClaves=$pd->buscarPorclave($clave);
            $postTitulos=$pd->buscarPorclaveTitulo($clave);
            $ud=new Usuario($this->adapter);
            $personas=$ud->buscarPersonas($clave);
            $cd=new Comentario($this->adapter);
            $cant=$cd->getAllCom();
            $duenios=$cd->getPublicadores();
            if ($pd->getUnseen($_SESSION['id'])==!null) {
                $notificaciones=sizeof($pd->getUnseen($_SESSION['id']));
            } else {
                $notificaciones=0;
            }
            $allPost=array("postClaves"=>$postClaves,"postTitulos"=>$postTitulos);
            $this->view("Browser", array(
                "allPost"=>$allPost,
                "personas"=>$personas,
                "cant"=>$cant,
                "duenios"=>$duenios,
                "notis"=>$notificaciones,
                "clave"=>$clave
            ));
        }

    }



}