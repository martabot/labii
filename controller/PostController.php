<?php
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
		$obj=$ud->getById($_GET['id']);
		$this->view("Postear",array(
			"usuario"=>$obj
		));
    }

    public function crear(){
        if(isset($_GET['id'])){
            $post=new Post($this->adapter);
            $user=new Usuario($this->adapter);
            $user->__set("id",$_GET['id']);
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
                        if($tmpName==""){echo "esta vacio";}if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){$imagenes=$_SERVER['DOCUMENT_ROOT']."/LABII/public/img/post/";$extension=explode("/",$fileType);$fileName=bin2hex(random_bytes(8)).'.'.$extension[1];$filePath=$imagenes.$fileName;$serverName="http://localhost/LABII/public/img/post/".$fileName;if($result=move_uploaded_file($tmpName, $filePath)){$post->__set($rec,$serverName);}else{echo "no se subio";exit;}}else{echo "debe subir imagen con extension .jpg .jpeg .gif o .png";}
                        $i++;
                    }
                $save=$post->save();
                $this->redirect();
        }}
    }
}
?>
