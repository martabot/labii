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
        if(isset($_SESSION['c'])){
            $c=(int)$_SESSION['c'];
            for($i=1;$i<=$c;$i++){
                $si="s".$i; $no="x".$i;
                $idCom="n".$i;$denCom="d".$i;$fecCom="f".$i;
                if(isset($_POST["$si"])){
                    $this->denegarC($_POST["$idCom"],$_POST["$denCom"],$_POST["$fecCom"],1);
                }
                if(isset($_POST["$no"])){
                    $this->denegarC($_POST["$idCom"],$_POST["$denCom"],$_POST["$fecCom"],0);
                }
            }
        }
        if(isset($_SESSION['t'])){
            $t=(int)$_SESSION['t'];
            for($i=1;$i<=$t;$i++){
                $este="si".$i; $otro="nono".$i;
                $idPos="p".$i;$denPos="r".$i;$fecPos="fec".$i;
                if(isset($_POST["$este"])){
                    $this->permitirP($_POST["$idPos"],$_POST["$denPos"],$_POST["$fecPos"]);
                }
                if(isset($_POST["$otro"])){
                    $this->denegarP($_POST["$idPos"],$_POST["$denPos"],$_POST["$fecPos"],$_POST["$idPos"]);
                }
            }
        }
    }

    public function permitirP($idP,$denP,$fecP){
        //actualizar denuncia con idModerador y dFecha
        unset($_SESSION['t']);
        $dd=new DenunciaPost($this->adapter);
        $moderador=new Moderador($this->adapter);
        $moderador->__set("id",$_SESSION['id']);
        $us=new Usuario($this->adapter);
        $us->__set("id",$denP);
        $pd=new Post($this->adapter);
        $pd->__set("id",$idP);
        $dd->__set("post",$pd);
        $dd->__set("user",$us);
        $dd->__set("dFecha",$fecP);
        $dd->__set("moderador",$moderador);
        $dd->save();
        $this->moderador();
    }

    public function denegarP($idP,$denP,$fecP){
        //save post con status 0
        //actualizar denuncia con id moderador
        unset($_SESSION['t']);
        $pd=new Post($this->adapter);
        $pd->__set("id",$idP);
        $pd->__set("status",0);
        $pd->save();
        $this->permitirP($idP,$denP,$fecP);
    }

    public function actualizar($idC,$denC,$fecC){
        $dd=new DenunciaCom($this->adapter);
        $moderador=new Moderador($this->adapter);
        $moderador->__set("id",$_SESSION['id']);
        $us=new Usuario($this->adapter);
        $us->__set("id",$denC);
        $pd=new Comentario($this->adapter);
        $pd->__set("id",$idC);
        $dd->__set("comentario",$pd);
        $dd->__set("user",$us);
        $dd->__set("dFecha",$fecC);
        $dd->__set("moderador",$moderador);
        $save=$dd->save();
        $_SESSION['aca']="vengo de comentario, habilitame el js";
        $this->moderador();
    }

    public function denegarC($idC,$denC,$fecC,$x){
        unset($_SESSION['c']);
        $cd=new Comentario($this->adapter);
        $cd->__set("id",$idC);
        $cd->__set("status",$x);
        $cd->save();
        $this->actualizar($idC,$denC,$fecC);
    }

}
?>