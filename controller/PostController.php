<?php
session_start();
ini_get('register_globals');

class PostController extends ControladorBase{
    public $conectar;
    public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

    public function index(){
        $ud=new Usuario($this->adapter);
        $obj=$ud->getById($_SESSION["id"]);
        if($ud->getUnseen($_SESSION['id'])==!NULL){
        $notificaciones=sizeof($ud->getUnseen($_SESSION["id"]));}else{$notificaciones=0;}
		$this->view("Postear",array(
            "notis"=>$notificaciones,
			"usuario"=>$obj
		));
    }

    public function crear(){
        if(isset($_SESSION['id'])){
            $post=new Post($this->adapter);
            $user=new Usuario($this->adapter);
            $user->__set("id",$_SESSION['id']);
            $privacidad=(int)$_POST["privacidad"]==0||(int)$_POST["privacidad"]==0?(int)$_POST["privacidad"]:1;
            $titulo=isset($_POST["titulo"])?$_POST['titulo']:NULL;
            $cuerpo=isset($_POST["cuerpo"])?$_POST['cuerpo']:NULL;
            $palabras=isset($_POST["palabras"])?$_POST["palabras"]:NULL;
            $palabras=substr($palabras,1);
            $si=explode("#",$palabras);
            $fotos=array($_FILES['img1'],$_FILES['img2'],$_FILES['img3']);
            if(!$titulo||!$cuerpo){
                $_SESSION['error']="El post debe tener al menos un titulo y una descripción";
                $this->redirect("post","");
            }else{
                    $post->__set('user',$user);
                    $post->__set('privacidad',$privacidad);
                    $post->__set('cuerpo',$cuerpo);
                    $post->__set("titulo",$titulo);
                    $i=1;
                    foreach($si as $palabra){
                        
                        $post->__set("palabra".$i,$palabra);
                        $i++;
                    }
                    $i=1;
                    foreach($fotos as $foto){
                        
                        $rec="img".$i;
                        $fileName=$foto['name'];
                        $tmpName=$foto['tmp_name'];
                        $fileSize=$foto['size'];
                        $fileType=$foto['type'];
                        if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif")
                            {
                                $imagenes=$_SERVER['DOCUMENT_ROOT']."/LABII/public/img/post/";
                                $extension=explode("/",$fileType);
                                $fileName=bin2hex(random_bytes(8)).'.'.$extension[1];
                                $filePath=$imagenes.$fileName;
                                $serverName="http://localhost/LABII/public/img/post/".$fileName;
                                if($result=move_uploaded_file($tmpName, $filePath)){
                                    $post->__set($rec,$serverName);
                                }else{
                                    $_SESSION['error']="No se pudo cargar la imagen ".$fileName;
                                    $this->redirect("post","");
                                }}
                        $i++;
                    }
                $save=$post->save();
                $this->redirect("usuario","verMuro");
            }
        }
    }

    public function actualizar(){
        $pd=new Post($this->adapter);
        $post=$pd->getById($_GET['id']);
        $ud=new Usuario($this->adapter);
        $usuario=$ud->getById($_SESSION['id']);
        if($ud->getUnseen($_SESSION['id'])==!NULL){
            $notificaciones=sizeof($ud->getUnseen($_SESSION["id"]));}else{$notificaciones=0;}
        $this->view("EditarPost",array(
            "notis"=>$notificaciones,
            "post"=>$post,
            "usuario"=>$usuario
        ));

    }

    public function enviar(){
        $post=new Post($this->adapter);
        $user=new Usuario($this->adapter);
        $user->__set("id",$_SESSION['id']);
        $id=$_POST['id'];
        $post->__set("id",$id);
        if(isset($_POST['eliminar'])){
            $post->__set("status",0);
            $post->__set("porMi","si");
            $post->save();
            $this->redirect("usuario","verMuro");
        } else {
            $privacidad=(int)$_POST["privacidad"]==1||(int)$_POST["privacidad"]==0?(int)$_POST["privacidad"]:1;
            $titulo=isset($_POST["titulo"])?$_POST['titulo']:NULL;
            $cuerpo=isset($_POST["cuerpo"])?$_POST['cuerpo']:NULL;
            $palabra1=isset($_POST["palabra1"])?substr($_POST["palabra1"],1):NULL;
            $palabra2=isset($_POST["palabra2"])?substr($_POST["palabra2"],1):NULL;
            $palabra3=isset($_POST["palabra3"])?substr($_POST["palabra3"],1):NULL;
            for($i=1;$i<4;$i++){
                $img="img".$i;
                if(isset($_POST["imagenes"][$i-1])){
                    $post->__set($img," ");
                } else{
                    $post->__set($img,(String)$_POST[$img]);
                }
            }
            if(!$cuerpo||!$titulo){
                $_SESSION['error']="No se pudo actualizar el post";
                $this->redirect("usuario","verMuro");
            } else {
            $post->__set("user",$user);
            $post->__set("privacidad",$privacidad);
            $post->__set("titulo",$titulo);
            $post->__set("palabra1",$palabra1);
            $post->__set("palabra2",$palabra2);
            $post->__set("palabra3",$palabra3);
            $post->__set("cuerpo",$cuerpo);
            $save=$post->save();
            $this->redirect("usuario","verMuro");
            }
        }
    }

    public function comentar(){
        $com=new Comentario($this->adapter);
        $usuario=new Usuario($this->adapter);
        $post=new Post($this->adapter);
        $cuerpo=isset($_POST['txt'])?$_POST['txt']:"";
        $usuario->__set("id",$_SESSION['id']);
        $com->__set("user",$usuario);
        $com->__set("cuerpo",$cuerpo);
        $post->__set("id",$_GET['idPost']);
        $com->__set("post",$post);
        $save=$com->save();
        $allComentarios=$com->getComentarios($_GET['idPost']);
        $_SESSION['unico']=$_GET['idPost'];
        $_SESSION['nCom']=$save;
        $this->redirect('notificaciones','crear');
    }
}
?>
