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
			if($_SESSION["id"]){
				unset($_SESSION["visitante"]);
				$ud=new Usuario($this->adapter);
				$obj=$ud->getById($_SESSION["id"]);
				$publicos=$ud->getPublicos();
				$this->view("Index",array(
					"usuario"=>$obj,
					"publicos"=>$publicos
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
			if(isset($_POST["username"])){
				$pass1=isset($_POST['pass'])?$_POST['pass']:"";
				$pass2=isset($_POST['pass1'])?$_POST['pass1']:"";
				if($pass1!=$pass2){
					$strError="Las contraseñas no coinciden";
					echo $strError;
				}else{            
				//Creamos un usuario
				$usuario=new Usuario($this->adapter);
				$val=$usuario->getOneBy("username",$_POST['username']);
				if($val){
					$strError="Nombre de usuario no disponible.";
					echo $strError;
				}else{
				$nom=isset($_POST["nombre"])?$_POST['nombre']:NULL;
				$ap=isset($_POST["apellido"])?$_POST['apellido']:NULL;
				$mail=isset($_POST["mail"])?$_POST["mail"]:NULL;
				$si=filter_var($mail, FILTER_VALIDATE_EMAIL);
				if(!$nom||!$ap||!$si){
					$strError="Datos faltantes";
					echo $strError;
				}else{
								$usuario->__set('username',$_POST['username']);
								$salt = bin2hex(random_bytes(32));
								$usuario->__set("salt",$salt);
								$password=$_POST['pass'].$salt;
                $usuario->__set('pass',hash('sha256', $password));
								$hoy=strftime( "%Y-%m-%d-%H-%M-%S", time() );
                $usuario->__set('fechaAlta',$hoy);
                $usuario->__set('fechaUltMod',$hoy);
								$usuario->__set("nombre",$nom);
								$usuario->__set("apellido",$ap);
								$usuario->__set("mail",$mail);
								$usuario->__set("profilePic","https://data.whicdn.com/images/332357097/large.jpg");
								$usuario->__set("bday",$_POST["bd"]);
								$pais = new Pais($this->adapter);
								$pais->__set("id",$_POST["country"]);
								$usuario->__set("pais",$pais);
					$save=$usuario->save();
					$this->redirect("Usuario", "index");
			}}}}
		}

		public function ingresar(){
			if(isset($_POST['username'])&&isset($_POST['pass'])){
				
				$user=$_POST['username'];
				$pw=$_POST['pass'];

				$ud=new Usuario($this->adapter);
				$usuario=$ud->getOneBy("username",$user);
				$salt = $usuario['salt'];
				$saltedPass = $pw.$salt;
				$hashedPass = hash('sha256', $saltedPass);
				$obj=$ud->getByID($usuario['id']);
				$publicos=$ud->getPublicos();
				session_start();
				$_SESSION["id"]=$obj->id;
				if($usuario['pass']==$hashedPass){
					$this->view("Index",array(
						"usuario"=>$obj,
						"publicos"=>$publicos
					));
				}else{echo 'Contraseña o nombre incorrecto!';}
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
					$amigo=$post->getAmigos($_SESSION["id"],$_SESSION["visitante"]);
				} else {$amigo=NULL;}
				$this->view("Perfil",array(
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

    public function verPost(){
			if(isset($_GET["unico"])){ 
				$id=(int)$_GET["id"];
				$unico=$_GET["unico"];
				$usuario = new Usuario($this->adapter);
				$usuario = $usuario->getById($id);
				$pd=new Pais($this->adapter);
				$pais=$pd->getById($usuario->pais);
				$post=new Post($this->adapter);
				$post=$post->getById($unico);
				$com=new Comentario($this->adapter);
				$allComentarios=$com->getComentarios($unico);
				$cant=sizeof($allComentarios);
				$this->view("Post",array(
					"usuario"=>$usuario,
					"pais"=>$pais,
					"post"=>$post,
					"cant"=>$cant,
					"com"=>$allComentarios
				));
			}
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
				$save=$amigo->save();
				$this->verMuro();
		}
   
     
		//Muestra el formulario de Actualizacion
		public function editar(){
				$id=(int)$_SESSION["id"];
				$usuario = new Usuario($this->adapter);
				$usuario = $usuario->getById($id);
				$pd=new Pais($this->adapter);
				$paises=$pd->getAll();
				$this->view("EditarPerfil",array(
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
									}else{
									$fileName=$_FILES['profilePic']['name'];
									$tmpName=$_FILES['profilePic']['tmp_name'];
									$fileSize=$_FILES['profilePic']['size'];
									$fileType=$_FILES['profilePic']['type'];
          				if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){$imagenes=$_SERVER['DOCUMENT_ROOT']."/LABII/public/img/profile/"; $extension=explode("/",$fileType);$fileName=$ud['username'].'.'.$extension[1];$filePath=$imagenes.$fileName;$serverName="http://localhost/LABII/public/img/profile/".$fileName;if($result=move_uploaded_file($tmpName, $filePath)){$usuario->__set("profilePic",$serverName);}else{echo "no se subio";exit;}}}
							
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
