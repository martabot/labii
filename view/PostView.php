<?php 
if($usuario->id!=$_SESSION['id']){
    $_SESSION['visitante']=$usuario->id;
}

?>
<!doctype html>
<html lang="es">
  <head>
    <title>StackOverPets</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Assistant&display=swap" rel="stylesheet"> 
    <script language="javascript">
        function rotar(){
            if(document.getElementById("v").textContent=="<"){
                document.getElementById("v").textContent="v";
        }else{document.getElementById("v").textContent="<";}
    }
    </script>
    <style>.navbar-brand{text-shadow:0px 0px 1px yellow}#datita:hover{color:#4290e4;text-decoration:none}a{outline:0;text-decoration:none}nav a:hover{text-shadow:0px 0px 1px yellow}.x{font-size:16pt;color: rgb(252, 159, 84)}.todo{font-family: 'Assistant', sans-serif;}html{overflow-x:hidden;scrollbar-face-color: orangered}.b{margin: 10px 10px 10px 10px}.ult{padding-top:30px;padding-bottom:30px}#this{width:75%;padding-top: 35px}section div.t{margin-top: 7px}.t,.t a,.user{color: orangered}.t span, .x a{color: grey}.card{margin-top:15px}.post span#eti{background-color: #fefbde; padding:3px;margin:5px;color:grey}.card p{padding-top:10px}#persona{color:orangered}.post{width:100%}.post img{width:100%;height:auto}.p {width:100%}.derecha{float:right}.no{color:grey;text-decoration:none}.no:hover{color:red;text-decoration:none;border:1px solid red;border-radius:2px}#fecha{color:silver}.card-text{margin-left:5px}#bordeau{background-color: #fefbde; padding:3px;margin:5px;color:grey}#famoso{color:#4290e4}#famoso:hover{color:#2b64a1;text-decoration:none}</style>
  </head>
  <body style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;">

        <nav class="navbar fixed-top navbar-expand-sm navbar-dark sticky-top" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
            <a class="navbar-brand" href="<?php echo $helper->url("usuario","index"); ?>"><b>StackOverPets</b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation" id="v" onClick="rotar()" style="outline: none"><</button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","index"); ?>">Inicio</a>
                </li>

            <?php if(!strpos($_SESSION['username'],"@")){  ?>              
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","mine"); ?>">Perfil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("notificaciones","notificaciones"); ?>">Notificaciones<?php if($notis!=0) {echo '&nbsp&nbsp<span class="badge badge-danger">'.$notis.'<span>';} ?></a>
                </li>
          <?php  } ?>
            
            
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="<?php echo $helper->url("busqueda","buscar");?>">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="clave">
                <input class="btn btn-outline-light my-2 my-sm-0" type="submit" value="Buscar">
            </form>
            <a style="text-decoration: none;color:whitesmoke;padding-left:20px" href="<?php  echo $helper->url("usuario","cerrarSesion"); ?>">Cerrar Sesion</a>
        </div>
    </nav>

    <div class="todo container-fluid">
        <div class="row">
            <div class="col-lg-3" style="position:fixed">
                <div class="row justify-content-center" style="padding-top: 10px">
                   <img id="this" class="fb-image-profile" src='<?php echo $usuario->profilePic; ?>' alt="foto de perfil"> 
                </div>
                <div class="row justify-content-center" style="padding-top: 23px">
                    <h2 style="width:100%" class="card-header-title text-center"><?php echo strtoupper($usuario->nombre." ".$usuario->apellido); ?></h2>
                    <h4 class="mb-1 pb-4 pt-0 text-center"><?php echo $pais->nombre; ?></h4>
                </div>
                <div class="row justify-content-center" >
                    <?php if($usuario->id!=$_SESSION["id"]&&!strpos($_SESSION['username'],"@")) { 
                            if(!isset($amigo)){ ?>
                                <a class="btn btn-outline-info my-2 my-sm-0" href="<?php echo $helper->url("usuario","agregarAmigo"); ?>">Agregar amigo</a>
                            <?php }else{
                                $estado=(int)$amigo->status;
                                if($estado==0&&$amigo->user2==$_SESSION["id"]){?>
                                    <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo $helper->url("usuario","aceptarSolicitud"); ?>">Aceptar Solicitud</a>                                
                                    <a class="btn btn-outline-danger my-2 my-sm-0" href="<?php echo $helper->url("usuario","cancelarSolicitud"); ?>">Cancelar Solicitud</a><?php 
                                 }else if ($estado==0&&$amigo->user2==$_SESSION["visitante"]){?>
                                    <a class="btn btn-outline-danger my-2 my-sm-0" href="<?php echo $helper->url("usuario","cancelarSolicitud"); ?>">Cancelar Solicitud</a><?php
                                 }else if ($estado==1){?>
                                     <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo $helper->url("usuario","eliminarAmigo"); ?>">Amigos</a><?php 
                                    } else if(!strpos($_SESSION['username'],"@")) { ?> 
                                        <a class="btn btn-outline-info my-2 my-sm-0" href="<?php echo $helper->url("usuario","agregarAmigo"); ?>">Agregar amigo</a><?php
                                    }
                                }
                            }
                                 ?>
                </div>

                <!-- Card -->
                <div class="b card card-cascade shadow-sm p-1 mb-3 bg-white rounded datos">
                    <div class="ult card-body card-body-cascade text-center">
            
                                <section class="container-fluid">
                                <?php if($_SESSION['id']==$usuario->id){ ?>
                                <div class="row t">
                                        <a href="<?php echo $helper->url("usuario","editar"); ?>">EDITAR PERFIL</a>
                                </div> <?php } ?>
                                    <!--<div class="row t">
                                    <a href="">INTERESES <span>&nbsp 0</span></a>
                                    </div> -->
                                <?php if($_SESSION['id']==$usuario->id){ ?>
                                    <div class="row t">
                                        <a href="<?php echo $helper->url("usuario","listarAmigos");?>">AMIGOS <span>&nbsp <?php echo (int)$todos; ?></span></a>
                                    </div>
                                <?php } else { ?>
                                    <div class="row t">
                                        <a>AMIGOS <span>&nbsp <?php echo (int)$todos; ?></span></a>
                                    </div>
                                <?php } ?>
                                </section>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 offset-md-3" style="padding-top: 15px">
                <div class="row">
                    <div class="col-lg-1">
                    
                    </div>
                    <div class="col-lg-7">
                        <div class="row" style="margin:20px 0px 30px -10px">
                    <?php if(!strpos($_SESSION['username'],"@")){ ?>
                        <span>
                            <a id="famoso" style="padding-right:10px;font-size:16pt" href="<?php echo $helper->url("usuario","verMuro"); ?>">
                                Ver muro de @<?php echo $usuario->username; ?>
                                </a>
                            </span>
                    <?php }?>
                            <div class="row post">
                                        <div class="card shadow-sm p-1 mb-3 bg-white rounded p">
                                            <div class="card-body">
                                
                                    <?php echo '<b class="card-title x">'.$post->titulo.'</b><br>
                                                            <span id="fecha">'.$post->fecha.'</span>
                                                            <hr>';
                                                for($i = 1; $i < 4; ++$i) {
                                                    $each="palabra".$i;
                                                    if($post->$each){
                                                        echo '<span id="bordeau">'.$post->$each.'</span>';
                                                    }
                                                }
                                                echo '<p class="card-text">'.$post->cuerpo.'</p>';
                                                for($i = 1; $i < 4; ++$i) {
                                                    $each="img".$i;
                                                    if($post->$each){
                                                        echo '<img src="'.$post->$each.'" alt="Imagen de post">';
                                                    }
                                                }   echo '<hr>';
                                                echo '<p style="color: #2f82db">'.(int)$cant.' Comentarios</p>';
                                                
                                                if(!strpos($_SESSION['username'],"@")){?>
                                                
                                                <form method="POST" action="<?php echo $helper->url("post","comentar"); ?>&idUser=<?php echo $usuario->id; ?>&idPost=<?php echo $post->id;?>">
                                                            <textarea style="width:100%;margin:7px" class="form-control" rows="3" placeholder="Deje aquí su comentario" name="txt"></textarea>
                                                            <input type="submit" value="Comentar" class="derecha btn btn-outline-info my-2 my-sm-0">
                                                        </form>
                                                <hr style="margin-top:60px">
                                                <?php }
                                                if(isset($com)){
                                                foreach($com as $comen){ 
                                                    $link=$helper->url('denuncia','denunciarCom')."&id=".$comen['id']."&unico=".$comen['post'];
                                                    $irA=$helper->url('usuario','verMuro')."&id=".$comen['user'];
                                                    ?>
                                                    <span ><a id="datita" href="<?php echo $irA; ?>"><b id="persona">@<?php echo $comen['username']; ?></b></a> <i><?php echo $comen['cuerpo']; ?></i>
                                                    <span class="derecha">
                                                        <a class="no" href="<?php echo $link;?>">&nbspx&nbsp</a>
                                                        </span> </span>
                                                    <hr class="muy">
                                                <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
