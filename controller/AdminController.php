<?php
session_start();
ini_get('register_globals');

class DenunciaController extends ControladorBase{
    public $conectar;
    public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

    public function index(){
        if(isset($_SESSION["id"])){
            unset($_SESSION["visitante"]);
            $ad=new Admin($this->adapter);
            $id=$_SESSION["id"];
            $obj=$ad->getById($id);
            $ud=new Usuario($this->adapter);
            $allUsers=$ud->getAll();
            $amiguis=$post->getPostDeAmigos($id);
            $cant=$post->getAllCom();
            $duenios=$post->getPublicadores();
            $notificaciones=sizeof($post->getUnseen($id));
            $this->view("ModerarView",array(
                "notis"=>$notificaciones,
                "usuario"=>$obj,
                "allUsers"=>$allPosts,
                "cant"=>$cant,
                "amiguis"=>$amiguis,
                "duenios"=>$duenios
            ));
        }else{
            $this->view("Bienvenida","");
        }
    }
}