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

    public function verPost($id,$unico){
            $usuario = new Usuario($this->adapter);
            $usuario = $usuario->getById($id);
            $pd=new Pais($this->adapter);
            $pais=$pd->getById($usuario->pais);
            $post=new Post($this->adapter);
            $post=$post->getById($unico);
            $com=new Comentario($this->adapter);
            $allComentarios=$com->getComentarios($unico);
            $cant=sizeof($allComentarios);
            if($pd->getUnseen($_SESSION['id'])==!NULL){
            $notificaciones=sizeof($pd->getUnseen($_SESSION['id']));}else{$notificaciones=0;}
            $asa=new Amigo($this->adapter);
            if($asa->getTodos($id)==!NULL){
			$todos=sizeof($asa->getTodos($id));}else{$todos=0;}
            $this->view("Post",array(
                "todos"=>$todos,
                "notis"=>$notificaciones,
                "usuario"=>$usuario,
                "pais"=>$pais,
                "post"=>$post,
                "cant"=>$cant,
                "com"=>$allComentarios
            ));
        }



    public function crear(){
        if(isset($_SESSION['id'])){
            $post=new Post($this->adapter);
            $user=new Usuario($this->adapter);
            $user->__set("id",$_SESSION['id']);
            $privacidad=(int)$_POST["privacidad"];
            $titulo=isset($_POST["titulo"])?$_POST['titulo']:NULL;
            $cuerpo=isset($_POST["cuerpo"])?$_POST['cuerpo']:NULL;
            $palabras=isset($_POST["palabras"])?$_POST["palabras"]:NULL;
            $si=explode("#",$palabras);
            $fotos=array($_FILES['img1'],$_FILES['img2'],$_FILES['img3']);
            if(!$titulo||!$cuerpo){
                $strError="Datos faltantes";
                echo $strError;
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
                                    echo "no se subio";exit;
                                }}
                        $i++;
                    }
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
        $this->verPost($_GET['idUser'],$_GET['idPost']);
    }
}
?>
