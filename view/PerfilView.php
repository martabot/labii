<?php ini_get('register_globals');

if(isset($_SESSION['error'])){
    echo '<script language="javascript">';
    $error=$_SESSION['error'];
    echo "alert('$error');";
    echo '</script>';
    unset($_SESSION['error']);
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
    <style>.navbar-brand{text-shadow:0px 0px 1px yellow}.datos a:hover{color:#4290e4;text-decoration:none}a{outline:0;text-decoration:none}nav a:hover{text-shadow:0px 0px 1px yellow}.todo{font-family: 'Assistant', sans-serif;}html{overflow-x:hidden;scrollbar-face-color: orangered}.b{margin: -5px 10px 10px 10px}.ult{padding-top:30px;padding-bottom:30px}#this{width:60%;padding-top: 20px}.x{font-size:16pt;color: rgb(252, 159, 84)}section div.t{margin-top: 7px}.t,.t a{color: orangered}.t span, .x a{color: grey}.card{margin-top:15px }#bordeau{background-color: #fefbde; padding:3px;margin:5px;color:grey}#img{padding-left:10px}.card p{padding-top:10px}.post{width:100%}.post img{width:100%;height:auto}.p {width:100%}#fecha{color:silver}.card-text{margin-left:5px}</style>
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
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","mine"); ?>">Perfil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("notificaciones","notificaciones"); ?>">Notificaciones<?php if($notis!=0) {echo '&nbsp&nbsp<span class="badge badge-danger">'.$notis.'<span>';} ?></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <a style="text-decoration: none;color:whitesmoke;padding-left:20px" href="<?php echo $helper->url("usuario","cerrarSesion"); ?>">Cerrar Sesion</a>
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
                <div class="row justify-content-center" style="padding:15px 0px 15px 0px">
                    <?php if($usuario->id!=$_SESSION["id"]) { 
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
                                    } else 
                                { ?> 
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
                    <div class="col-lg-1"></div>
                    <div class="col-lg-7">
                        <div class="row" style="margin:30px 0px 30px -10px">
                    <?php if($usuario->id==$_SESSION["id"]){ ?>
                            <a class="btn btn-outline-info my-2 my-sm-0" href="<?php echo $helper->url("post","index"); ?>">Agregar Post</a>
                            <?php }
                            if(isset($allPost)){
                            foreach($allPost as $post){
                                $pregunta=isset($amigo)?$amigo->status==1:false;
                                if(($post->privacidad==1||$pregunta)||!isset($_SESSION['visitante'])||$usuario->id==$_SESSION["id"]){?>
                                    <div class="row post datos">
                                        <div class="card shadow-sm p-1 mb-3 bg-white rounded p">
                                            <div class="card-body">
                                            <?php if($_SESSION['id']==$post->user){?>
                                                <span style="float: right;margin-bottom:5px">
                                                    <a class="btn btn-outline-danger btn-sm" href="<?php echo $helper->url("post","actualizar")."&id=".$post->id; ?>">Editar</a>
                                                </span>
                                            <?php } echo '<b class="card-title x">'.$post->titulo.'</b><br>
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
                                                    if(isset($cant)){
                                                    foreach($cant as $c){
                                                        if($c['id']==$post->id){
                                                        $t=$c['cant'];
                                                        }
                                                    }}
                                                    $t=isset($t)?$t:0;
                                                    $link=$helper->url('usuario','verPost')."&id=".$usuario->id."&unico=".$post->id; 
                                                    if($t>1||$t==0){
                                                        echo'<a href="'.$link.'">'.$t.' Comentarios</a>';
                                                    } else {
                                                        echo'<a href="'.$link.'">'.$t.' Comentario</a>';
                                                    }
                                                    $t=0;
                                               echo' </div>
                                            </div>
                                        </div>';
                            }}}
                            ?>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
