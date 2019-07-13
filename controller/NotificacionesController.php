<?php
session_start();
ini_get('register_globals');

class NotificacionesController extends ControladorBase{
    public $conectar;
    public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

    public function crear(){
        $notificacion=new Notificacion($this->adapter);
        $usuario=new usuario($this->adapter);
        $post=new Post($this->adapter);
        $com=new Comentario($this->adapter);
        $usuario=$usuario->__set("id",$_SESSION['id']);
        $notificacion->__set("user1",$usuario);
        $u2=new usuario($this->adapter);
        if(isset($_SESSION['nCom'])){
            $idP=$post->getById((int)$_SESSION['unico']);
            $_SESSION['visitante']=$idP->user;
        }
        $u2=$u2->__set("id",$_SESSION['visitante']);
        $notificacion->__set("user2",$u2);
        if (isset($_SESSION['nCom'])){
            $com->__set("id",$_SESSION['nCom']);
            $notificacion->__set("comentario",$com);
            if($_SESSION['id']!=$_SESSION['visitante']){
                $notificacion->__set("descripcion","@".$_SESSION['username']." ha comentado tu post");
                unset($_SESSION['nCom']);
                $saveNot=$notificacion->save();
            }
        }else if(isset($_SESSION['nAmigo'])){
            $notificacion->__set("amigo",1);
            $notificacion->__set("descripcion","@".$_SESSION['username'].$_SESSION['nAmigo']);
            unset($_SESSION['nAmigo']);
            $saveNot=$notificacion->save();
        }
        $this->redirect("usuario","verPost");
    }

    public function actualizar(){
        $notificacion=new Notificacion($this->adapter);
        $n1=new Notificacion($this->adapter);
        $id=$notificacion->getOneBy("id",$_GET['id']);
        $_SESSION['visitante']=$id['user2'];
        $n1->__set("id",$id['id']);
        $n1->__set("status",1);
        $save=$n1->save();
        if($id['comentario']){
            $cd=new Comentario($this->adapter);
            $comentario=$cd->getById($id['comentario']);
            $pd=new Post($this->adapter);
            $post=$pd->getById($comentario->post);
            $_SESSION['unico']=$post->id;
            $this->redirect("usuario","verPost");
        } if($id['amigo']){
            $this->redirect("usuario","verMuro");
        }
    }

    public function notificaciones(){
        $notificacion=new Notificacion($this->adapter);
        $ns=$notificacion->getAllFrom($_SESSION['id']);
        $usuario=new usuario($this->adapter);
        $u1=$usuario->getById($_SESSION['id']);
        if($usuario->getUnseen($_SESSION['id'])==!NULL){
        $n=sizeof($usuario->getUnseen($_SESSION["id"]));}else{$n=0;}
        $this->view("Notificaciones",array(
            "notis"=>$n,
            "ns"=>$ns,
            "usuario"=>$u1
        ));
    }
}