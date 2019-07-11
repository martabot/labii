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
            $ad=new Moderador($this->adapter);
            $posts=$ad->getPostsDenunciados();
            $coms=$ad->getComDenunciados();
            $ud=new Usuario($this->adapter);
            $usuarios=$ud->getAll();
            $cant=0;$t=0;
            if(isset($coms)){
                $cant+=sizeof($coms);
            }
            if(isset($posts)){
                $t+=sizeof($posts);
            }
            $this->view("Moderar",array(
                "usuarios"=>$usuarios,
                "cant"=>$cant,
                "t"=>$t,
                "posts"=>$posts,
                "coms"=>$coms
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

        $dd=new DenunciaPost($this->adapter);
        $moderador=new Moderador($this->adapter);
        $moderador->__set("id",$_SESSION['id']);
        $us=new Usuario($this->adapter);
        $us->__set("id",$_POST['idD']);
        $pd=new Post($this->adapter);
        $pd->__set("id",$_POST['idP']);
        $dd->__set("post",$pd);
        $dd->__set("user",$us);
        $dd->__set("dFecha",$_POST['fecha']);
        $dd->__set("moderador",$moderador);
        $dd->save();
        $this->moderador();
    }

    public function denegarP(){
        //save post con status 0
        //actualizar denuncia con id moderador
        $pd=new Post($this->adapter);
        $pd->__set("id",$_POST['idP']);
        $pd->__set("status",0);
        $pd->save();
        $this->permitirP();
    }

    public function permitirC(){
        $dd=new DenunciaCom($this->adapter);
        $moderador=new Moderador($this->adapter);
        $moderador->__set("id",$_SESSION['id']);
        $us=new Usuario($this->adapter);
        $us->__set("id",$_POST['idDen']);
        $pd=new Comentario($this->adapter);
        $pd->__set("id",$_POST['idC']);
        $dd->__set("comentario",$pd);
        $dd->__set("user",$us);
        $dd->__set("dFecha",$_POST['fechax']);
        $dd->__set("moderador",$moderador);
        $save=$dd->save();
        $_SESSION['aca']="vengo de comentario, habilitame el js";
        $this->moderador();
    }

    public function denegarC(){
        //save com con status 0
        //actualizar denuncia con id moderador

        $cd=new Comentario($this->adapter);
        $cd->__set("id",$_POST['idC']);
        $cd->__set("status",0);
        $cd->save();
        $this->permitirC();
    }

}
?>