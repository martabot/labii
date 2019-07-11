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
            $ad=new Admin($this->adapter);
            $id=$_SESSION["id"];
            $obj=$ad->getById($id);
            $ud=new Usuario($this->adapter);
            $allUsers=$ud->getAll();
            //if($ud->getUnseen($_SESSION['id'])){
            //    $notificaciones=sizeof($ud->getUnseen($_SESSION['id']));}else{$notificaciones=0;}
            $mod=$ad->getMod();
            $this->view("Admin",array(
                //"notis"=>$notificaciones,
                "mod"=>$mod,
                "usuario"=>$obj,
                "allUsers"=>$allUsers
            ));
        }else{
            $this->view("Bienvenida","");
        }
    }

    public function otro(){
        if(isset($_POST['mod'])){
            $this->hacerModerador();
        }else if(isset($_POST['hab'])){
            $this->habilitar();
        }
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
                $md->__set("username","moderador");
                $salt = bin2hex(random_bytes(32));
                $password="12345".$salt;
                $md->__set("salt",$salt);
                $md->__set("pass",$password);
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
        $usuario=$ud->getById($_POST['id']);
        if($usuario->status==0){
            $ad=new Admin($this->adapter);
            $obj=$ad->__set("id",$_SESSION['id']);
            $usuario=new Usuario($this->adapter);
            $usuario->__set("id",$_POST['id']);
            $usuario->__set("status",1);
            $usuario->save();
        } else {
            $ad=new Admin($this->adapter);
            $obj=$ad->__set("id",$_SESSION['id']);
            $usuario=new Usuario($this->adapter);
            $usuario->__set("id",$_POST['id']);
            $usuario->__set("status",0);
            $usuario->save();
        }
        $this->index();
    }
}