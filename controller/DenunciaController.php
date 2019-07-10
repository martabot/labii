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

    public function denunciarPost(){
        $dPost= new DenunciaPost($this->adapter);
        $post=new Post($this->adapter);
        $post->__set("id",$_GET['id']);
        $dPost->__set("post",$post);
        $usuario=new Usuario($this->adapter);
        $usuario->__set("id",$_SESSION['id']);
        $dPost->__set("user",$usuario);
        $dPost->__set("motivo",$_POST['motivo']);
        $save=$dPost->save();
        $this->redirect("usuario","index");
    }

    public function denunciarComentario(){




    }

}
?>