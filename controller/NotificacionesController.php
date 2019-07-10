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
        $u2=$u2->__set("id",$_SESSION['visitante']);
        $notificacion->__set("user2",$u2);
        if(isset($_SESSION['nPost'])){
            $post=$post->getById($_SESSION['nPost']);
            $notificacion->__set("post",$post);
            $notificacion->__set("descripcion","A ".$_SESSION['username']." le ha gustado tu post ".$post->__get("titulo"));
            unset($_SESSION['nPost']);
        } else if (isset($_SESSION['nCom'])){
            $com=$com->getById($_SESSION['nCom']);
            $notificacion->__set("comentario",$com);
            $notificacion->__set("descripcion","A ".$_SESSION['username']." ha comentado tu post ".$post->__get("titulo"));
            unset($_SESSION['nCom']);
        }else if(isset($_SESSION['nAmigo'])){
            $notificacion->__set("amigo",1);
            $notificacion->__set("descripcion","@".$_SESSION['username'].$_SESSION['nAmigo']);
            unset($_SESSION['nAmigo']);
        }
        $saveNot=$notificacion->save();
        $this->redirect("usuario","verMuro");
    }

    public function actualizar(){
        $notificacion=new Notificacion($this->adapter);
        $n1=new Notificacion($this->adapter);
        $id=$notificacion->getOneBy("id",$_GET['id']);
        $_SESSION['visitante']=$id['user1'];
        $n1->__set("id",$id['id']);
        $n1->__set("status",1);
        $save=$n1->save();
        if($p=$id['post']){
            $_SESSION['unico']=$p;
            $this->redirect("usuario","verPost");
        } if($comentario=$id['comentario']){
            $p=$this->getPostDelComentario($comentario);
            $_SESSION['unico']=$p['id'];
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