<?php
session_start();
ini_get('register_globals');

class UsuarioController extends ControladorBase{
    public $conectar;
		public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

		//Listar todos los Usuarios	
		public function index(){
			if(isset($_SESSION["id"])){
				unset($_SESSION["visitante"]);
				$ud=new Usuario($this->adapter);
				$id=$_SESSION["id"];
				$obj=$ud->getById($id);
				$post=new Post($this->adapter);
				
				$allPosts=$post->getByFecha($id);
				$amiguis=$post->getPostDeAmigos($id);
				$cant=$post->getAllCom();
				$duenios=$post->getPublicadores();
				if($post->getUnseen($_SESSION['id'])==!NULL){
				$notificaciones=sizeof($post->getUnseen($_SESSION['id']));}else{$notificaciones=0;}
				$this->view("Index",array(
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

		public function cerrarSesion(){
			unset($_SESSION["id"]);
			session_destroy();
			$this->index();
		}

		public function iniciar(){
			$this->view("Login","");
		}

		public function registrarse(){
			$pais=new Pais($this->adapter);
			$allPais=$pais->getAll();

			$this->view("Registrar",array(
				"allPais"=>$allPais
			));
		}

		//Muestra el formulario de inserción
		public function insertar(){
        
			//Conseguimos todos los usuarios
			$provincia=new Provincia($this->adapter);
			$allProvincias= $provincia->getAll();
			
			//Cargamos la vista para mostrar formulario de insert
			$this->view("insertar",array(
				"allProvincias"=>$allProvincias
			));
		
		}

		//Procesa los datos del formulario de inserción
		public function crear(){
			if(isset($_POST["username"])&&trim($_POST['username'])!=""){
				$pass1=isset($_POST['pass'])?$_POST['pass']:"";
				$pass2=isset($_POST['pass1'])?$_POST['pass1']:"";
				if($pass1!=$pass2){
					$_SESSION['error']="Las contraseñas no coinciden.";
					$this->registrarse();
				}else{            
				//Creamos un usuario
				$usuario=new Usuario($this->adapter);
				$val=$usuario->getOneBy("username",$_POST['username']);
				$valMail=$usuario->getOneBy("mail",$_POST['mail']);
				if($val){
					$_SESSION['error']="Nombre de usuario no disponible.";
					$this->registrarse();
				}else if (substr_count($_POST['username']," ")>0){
					$_SESSION['error']="El nombre de usuario no debe contener espacios";
					$this->registrarse();
				}else if($valMail){
					$_SESSION['error']="El mail ya se encuntra registrado";
					$this->registrarse();
				}else{
				$nom=NULL!=trim($_POST["nombre"])?$_POST['nombre']:NULL;
				$ap=NULL!=trim($_POST["apellido"])?$_POST['apellido']:NULL;
				$bd=NULL!=$_POST['bd']?$_POST['bd']:NULL;
				$mail=isset($_POST["mail"])?$_POST["mail"]:NULL;
				$si=filter_var($mail, FILTER_VALIDATE_EMAIL);
				if(!$nom||!$ap||!$si){
					$_SESSION['error']="Datos personales incorrectos.";
					$this->registrarse();
				}else{
								$usuario->__set('username',$_POST['username']);
								$salt = bin2hex(random_bytes(32));
								$usuario->__set("salt",$salt);
								$password=$_POST['pass'].$salt;
                $usuario->__set('pass',hash('sha256', $password));
								$usuario->__set("nombre",$nom);
								$usuario->__set("apellido",$ap);
								$usuario->__set("mail",$mail);
								$usuario->__set("profilePic","https://data.whicdn.com/images/325337009/large.jpg");
								$usuario->__set("bday",$bd);
								$pais = new Pais($this->adapter);
								$pais->__set("id",$_POST["country"]);
								$usuario->__set("pais",$pais);
					$save=$usuario->save();
					$_SESSION['error']="Usuario registrado con exito";
					$this->redirect("Usuario", "index");
			}}}}
		}

		public function ingresar(){
			if(isset($_SESSION['id'])){
				$this->index();
			}else {
			if(isset($_POST['username'])&&isset($_POST['pass'])){
				
					$un=$_POST['username'];
					$pw=$_POST['pass'];
				if(trim($un)==""||trim($pw)==""){
					$_SESSION['error']="Los campos deben contener caracteres.";
					$this->view("Login","");
				}else{
					$ud=new Usuario($this->adapter);
					if(!NULL==$ud->getOneBy("username", $un)){
					$usuario=$ud->getOneBy("username", $un);
					$salt = $usuario['salt'];
					$saltedPass = $pw.$salt;
					$hashedPass = hash('sha256', $saltedPass);	
					if($usuario['pass']==$hashedPass){
						if($ud->getBanned($usuario['id'])==NULL){
							$_SESSION["id"]=$usuario['id'];
							$_SESSION['username']=$un;
							$this->index();
						}else{
							$_SESSION['error']="La cuenta de usuario ha sido cancelada por un administrador.";
							$this->view("Login","");
						}}
					}else{
						$ad=new Admin($this->adapter);
						if(!NULL==$ad->getOneBy("username", $un)){
						$usuario=$ad->getOneBy("username", $un);
						$salt = $usuario['salt'];
						$saltedPass = $pw.$salt;
						$hashedPass = hash('sha256', $saltedPass);
						
								$_SESSION["id"]=$usuario['id'];
								$_SESSION['username']=$un;
								$_SESSION['admin']="si";
								$this->index();
					} else {
						$md=new Moderador($this->adapter);
						if(!NULL==$md->getOneBy("username", $un)){
						$usuario=$md->getOneBy("username", $un);
						$salt = $usuario['salt'];
						$saltedPass = $pw.$salt;
						$hashedPass = hash('sha256', $saltedPass);	
						if($usuario['pass']==$hashedPass||$usuario['pass']=="12345"){
							if($usuario['satatus']==0){
								$_SESSION['error']="La cuenta moderadora ha sido cancelada por un administrador.";
								$this->view("Login","");
							} else{
								$_SESSION["id"]=$usuario['id'];
								$_SESSION['username']=$usuario['username'];
								$_SESSION['moderador']="si";
								$this->redirect("denuncia","moderador");}
							}
						}else{
							$_SESSION['error']="Nombre de usuario o contraseña incorrecto";
							$this->view("Login","");
					}
				}
			}
			}
			}
		}
		}

		public function verMuro(){
			if(isset($_SESSION["visitante"])){ 
				$id=(int)$_SESSION["visitante"];}
				else{$id=(int)$_SESSION["id"];}
				$usuario = new Usuario($this->adapter);
				$usuario = $usuario->getById($id);
				$pd=new Pais($this->adapter);
				$pais=$pd->getById($usuario->pais);
				$post=new Post($this->adapter);
				$allPosts=$post->getAllPost($id);
				$cant=$post->getCountCom($id);
				if(isset($_SESSION["visitante"])){
					$amigo=$post->getAmigos($_SESSION["visitante"],$_SESSION["id"]);
					$postsVisitante=$post->getBy("privacidad",1);
				} else {$amigo=NULL;$postsVisitante=NULL;}
				if($post->getUnseen($_SESSION['id'])==!NULL){
				$notificaciones=sizeof($post->getUnseen($_SESSION['id']));}else{$notificaciones=0;}
				$asa=new Amigo($this->adapter);
				if($asa->getTodos($id)==!NULL){
					$todos=sizeof($asa->getTodos($id));}else{$todos=0;}
				$this->view("Perfil",array(
					"postsVisitante"=>$postsVisitante,
					"todos"=>$todos,
					"notis"=>$notificaciones,
					"amigo"=>$amigo,
					"usuario"=>$usuario,
					"pais"=>$pais,
					"allPost"=>$allPosts,
					"cant"=>$cant
				));
		}

		public function mine(){
			unset($_SESSION["visitante"]);
			$this->verMuro();
		}

		public function aceptarSolicitud(){
			$amigo=new Amigo($this->adapter);
			$ad=new Amigo($this->adapter);
			$ad=$ad->getAmistad($_SESSION["visitante"],$_SESSION["id"],0);
			$amigo->__set("id",$ad->id);
			$amigo->__set("status",1);
			$_SESSION['nAmigo']=" aceptó tu solicitud de amistad";
			$save=$amigo->save();
			$this->redirect("notificaciones","crear");
		}

		public function eliminarAmigo(){
			$amigo=new Amigo($this->adapter);
			$ad=new Amigo($this->adapter);
			$ad=$ad->getAmistad($_SESSION["visitante"],$_SESSION["id"],1);
			$amigo->__set("id",$ad->id);
			$amigo->__set("status",2);
			$_SESSION['nAmigo']=" te elimino como amigo";
			$save=$amigo->save();
			$this->redirect("notificaciones","crear");
		}

		public function cancelarSolicitud(){
			$amigo=new Amigo($this->adapter);
			$ad=new Amigo($this->adapter);
			$ad=$ad->getAmistad($_SESSION["visitante"],$_SESSION["id"],0);
			$amigo->__set("id",$ad->id);
			$amigo->__set("status",2);
			$_SESSION['nAmigo']=" rechazó tu solicitud de amistad";
			$save=$amigo->save();
			$this->redirect("notificaciones","crear");
		}

    public function verPost(){
			if(isset($_GET["unico"])&&isset($_GET["id"])){ 
				$id=(int)$_GET["id"];
				$unico=$_GET["unico"];
			}else if(isset($_SESSION['unico'])&&isset($_SESSION['visitante'])){
				$id=$_SESSION['visitante'];
				$unico=$_SESSION['unico'];
			} else if (isset($_SESSION['unico'])&&isset($_SESSION['id'])){
				$id=$_SESSION['id'];
				$unico=$_SESSION['unico'];
			}
				$usuario = new Usuario($this->adapter);
				$usuario = $usuario->getById($id);
				$pd=new Pais($this->adapter);
				$pais=$pd->getById($usuario->pais);
				$post=new Post($this->adapter);
				$post=$post->getById($unico);
				$com=new Comentario($this->adapter);
				$allComentarios=$com->getComentarios($unico);
				if($allComentarios==!NULL){
					$cant=sizeof($allComentarios);}else{$cant=0;}
				if($com->getUnseen($_SESSION['id'])==!NULL){
					$notificaciones=sizeof($com->getUnseen($_SESSION['id']));}else{$notificaciones=0;}
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

		//turning . 


		//Procesa el borrado de unUsuario
		public function borrar(){
			if(isset($_GET["id"])){ 
				$id=(int)$_GET["id"];
				
				$usuario=new Usuario($this->adapter);
				$usuario->deleteById($id); 
			}
			$this->redirect();
		}

		public function agregarAmigo(){
				$amigo=new Amigo($this->adapter);
				$user=new Usuario($this->adapter);
				$u1=$user->__set("id",$_SESSION["id"]);
				$usuario=new Usuario($this->adapter);
				$u2=$usuario->__set("id",$_SESSION["visitante"]);
				$amigo->__set("user1",$u1);
				$amigo->__set("user2",$u2);
				$_SESSION['nAmigo']=" te ha enviado una solicitud de amistad";
				$save=$amigo->save();
				$this->redirect("notificaciones","crear");
		}
   
     
		//Muestra el formulario de Actualizacion
		public function editar(){
				$id=(int)$_SESSION["id"];
				$usuario = new Usuario($this->adapter);
				$usuario = $usuario->getById($id);
				$pd=new Pais($this->adapter);
				$paises=$pd->getAll();
				$notificaciones=sizeof($pd->getUnseen($id));
				$this->view("EditarPerfil",array(
					"notis"=>$notificaciones,
					"paises"=>$paises,
					"usuario"=>$usuario
				));
		}
		//Procesa los datos del formulario de edición
		public function actualizar(){
				$id=$_SESSION["id"];
				$usuario=new Usuario($this->adapter);
				$ud=$usuario->getOneBy("id",$id);
				$salt = $ud['salt'];
				$pw = $ud['pass'];
				$pass=isset($_POST['pass'])?$_POST['pass'].$salt:"";
				$hashedTry=hash('sha256',$pass);
				if($hashedTry!=$pw){
					$strError="Contraseña incorrecta";
					echo $strError;
				}else{            
					$nom=isset($_POST["nombre"])?$_POST['nombre']:NULL;
					$ap=isset($_POST["apellido"])?$_POST['apellido']:NULL;
					$mail=isset($_POST["mail"])?$_POST["mail"]:NULL;
					$profilePic=isset($_POST["actual"])?$_POST["actual"]:NULL;
					if(!$nom||!$ap||!$mail){
						$strError="Datos faltantes";
						echo $strError;
					}else{
									$usuario->__set("id",$id);
									$hoy=strftime( "%Y-%m-%d-%H-%M-%S", time() );
									$usuario->__set('fechaUltMod',$hoy);
									$usuario->__set("nombre",$nom);
									$usuario->__set("apellido",$ap);
									$usuario->__set("mail",$mail);
									if($profilePic){
										$usuario->__set("profilePic",$profilePic);
									}
									$fileName=$_FILES['profilePic']['name'];
									$tmpName=$_FILES['profilePic']['tmp_name'];
									$fileSize=$_FILES['profilePic']['size'];
									$fileType=$_FILES['profilePic']['type'];
          				if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){$imagenes=$_SERVER['DOCUMENT_ROOT']."/LABII/public/img/profile/"; $extension=explode("/",$fileType);$fileName=$ud['username'].'.'.$extension[1];$filePath=$imagenes.$fileName;$serverName="http://localhost/LABII/public/img/profile/".$fileName;if($result=move_uploaded_file($tmpName, $filePath)){$usuario->__set("profilePic",$serverName);}else{echo "no se subio";exit;}}
							
						 $usuario->__set("bday",$_POST["bd"]);
						 $pais = new Pais($this->adapter);
						 $pais->__set("id",$_POST["country"]);
						 $usuario->__set("pais",$pais);
						 $save=$usuario->save();
			 	$this->verMuro();
	 			}
			
		}
	}
}
?>
