<?php
session_start();
ini_get('register_globals');

class AdminController extends ControladorBase{
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
            $ud=new Usuario($this->adapter);
            $allUsers=$ud->getAll();
            $mod=$ud->getMod();
            $this->view("Admin",array(
                "delUsuario"=>$delUsuario,
                "mod"=>$mod,
                "allUsers"=>$allUsers
            ));
        }else{
            $this->view("Bienvenida","");
        }
    }

    public function otro(){
        if(isset($_POST['mod'])&&isset($_POST['id'])){
            $this->hacerModerador();
        }else if(isset($_POST['hab'])&&isset($_POST['id'])){
            $this->habilitar();
        } else {$this->index();}
    }

    public function hacerModerador(){
        //insertar un moderador
        $ad=new Admin($this->adapter);
        $ud=new Usuario($this->adapter);
        $mod=new Moderador($this->adapter);
        
        //hacer cartelito
        if($ud->getById($_POST['id'])==!NULL){
            if(!$mod->yaExiste($_POST['id'])){
                $usuario=$ud->getById($_POST['id']);
                $obj=$ad->__set("id",$_SESSION['id']);
                $md=new Moderador($this->adapter);
                $md->__set("username",$usuario->mail);
                $md->__set("salt",NULL);
                $md->__set("pass","12345");
                $md->__set("adminUltMod",$obj);
                $md->__set("mail",$usuario->mail);
                $save=$md->save();
            } else {
                $moderador=$mod->getModByUser($_POST['id']);
                $ad->__set("id",$_SESSION['id']);
                if($moderador->status==1){
                    $mod->__set("id",$moderador->id);
                    $mod->__set("adminUltMod",$ad);
                    $mod->__set("status",0);
                    $mod->save();
                } else {
                    $mod->__set("id",$moderador->id);
                    $mod->__set("adminUltMod",$ad);
                    $mod->__set("status",1);
                    $mod->save();
                }
            }
        }
        $this->index();
    }

    public function habilitar(){
        //actualizar estado de usuario 1
        $ud=new Usuario($this->adapter);
        $usu=$ud->getById($_POST['id']);
        $ad=new Admin($this->adapter);
        $obj=$ad->__set("id",$_SESSION['id']);
        $usuario=new Usuario($this->adapter);
        $usuario->__set("id",$_POST['id']);
        if($usu->status==0){
            $usuario->__set("status",1);
            $usuario->save();
        } else {
            $usuario->__set("status",0);
            $usuario->save();
        }
        $this->index();
    }

    public function todo(){
        $this->view("Full","");
    }


}