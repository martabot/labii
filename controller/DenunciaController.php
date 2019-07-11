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

    public function denunciarCom(){
        $dCom= new DenunciaCom($this->adapter);
        $com=new Comentario($this->adapter);
        $com->__set("id",$_GET['id']);
        $dCom->__set("comentario",$com);
        $usuario=new Usuario($this->adapter);
        $usuario->__set("id",$_SESSION['id']);
        $dCom->__set("user",$usuario);
        $save=$dCom->save();
        $_SESSION['unico']=$_GET['unico'];
        $this->redirect("usuario","verPost");
    }

    public function moderador(){
        if(isset($_SESSION["id"])){
            unset($_SESSION["visitante"]);
            $ud=new Moderador($this->adapter);
            $id=$_SESSION["id"];
            $obj=$ud->getById($id);
            $post=new Post($this->adapter);
            $allPosts=$post->getByFecha($id);
            $amiguis=$post->getPostDeAmigos($id);
            $cant=$post->getAllCom();
            $duenios=$post->getPublicadores();
            if($post->getUnseen($_SESSION['id'])==!NULL){
            $notificaciones=sizeof($post->getUnseen($_SESSION['id']));} else {$notificaciones=0;}
            $this->view("ModerarView",array(
                "notis"=>$notificaciones,
                "usuario"=>$obj,
                "allPost"=>$allPosts,
                "cant"=>$cant,
                "amiguis"=>$amiguis,
                "duenios"=>$duenios
            ));
        }else{
            $this->view("Bienvenida","");
        }
    }

    public function moderar(){
        if(isset($_POST['permitirP'])){
            $this->permitirP();
        } else if(isset($_POST['denegarP'])){
            $this->denegarP();
        } else if(isset($_POST['permitirC'])){
            $this->permitirC();
        } else if(isset($_POST['denegarC'])){
            $this->denegarC();
        }
    }

    public function permitirP(){
        //actualizar denuncia con idModerador y dFecha
        
    }

    public function denegarP(){
        //save post con status 0
        //actualizar denuncia con id moderador

    }

    public function permitirC(){
        //

    }

    public function denegarC(){
        //save com con status 0
        //actualizar denuncia con id moderador
    }

}
?>