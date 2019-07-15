<?php ini_get('register_globals'); 
if(isset($_SESSION['moderador'])){
    $this->redirect("denuncia","moderador");
} else if(isset($_SESSION['admin'])){
    $this->redirect("admin","index");
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
    <style>.navbar-brand{text-shadow:0px 0px 1px yellow}a{outline:0;text-decoration:none}html{overflow-x: hidden;scrollbar-face-color:orangered;scrollbar-width: thin;overflow-y: scroll}nav a:hover{text-shadow:0px 0px 1px yellow}.d{color: rgb(252, 159, 84)}.x{font-size:16pt;color: rgb(252, 159, 84)}.x:hover{color:#4290e4;text-decoration:none}#nombre:hover{color:#4290e4;text-decoration:none}#aque{color:#4290e4}#nombre{color: rgb(252, 159, 84)}.todo{font-family: 'Assistant', sans-serif;}.letras{color:grey}#img{padding-left:10px}.l{margin:30px 7px 0px 60px}.r{margin:30px 50px 0px 7px}#eti{background-color: #fefbde; padding:3px;margin:5px;color:grey}.card p{padding-top:10px}.post{width:100%}.post img{width:100%;height:auto}.p {width:100%}#fecha{color:silver}

.people-nearby .google-maps{
  background: #f8f8f8;
  border-radius: 4px;
  border: 1px solid #f1f2f2;
  padding: 20px;
  margin-bottom: 20px;
}

.people-nearby .google-maps .map{
  height: 300px;
  width: 100%;
  border: none;
}

.people-nearby .nearby-user{
  padding: 20px 40px;
  border-top: 1px solid #f1f2f2;
  border-bottom: 1px solid #f1f2f2;
  margin-bottom: 20px;
  margin-top:30px
}

img.profile-photo-lg{
  height: 80px;
  width: 80px;
  border-radius: 50%;
}


    </style>
  </head>
  <body style="margin-top:30px; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;">
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
        <a class="navbar-brand" href="#"><b>StackOverPets</b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation" id="v" onClick="rotar()"style="outline: none"><</button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","index"); ?>">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","verMuro"); ?>">Perfil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("notificaciones","notificaciones"); ?>">Notificaciones<?php if($notis!=0) {echo '&nbsp&nbsp<span class="badge badge-danger">'.$notis.'<span>';} ?></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="<?php echo $helper->url("busqueda","buscar");?>">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="clave">
                <input class="btn btn-outline-light my-2 my-sm-0" type="submit" value="Buscar">
            </form>
            <a style="text-decoration: none;color:whitesmoke;padding-left:20px" href="<?php  echo $helper->url("usuario","cerrarSesion");?>">Cerrar Sesion</a>
        </div>
    </nav>
<div class="row todo">

<div class="col-lg-6">
<i class="letras row" style="margin:40px 0px -15px 60px">Post:</i>
<?php if(!isset($allPost)){
            echo '<div class="row r justify-content-center align-middle"><span class="alert alert-info">No se encontraron coincidencias</span></div>';
     }else{$a=0;}
    if (isset($allPost)) { ?>
            <div class="container" style="width:70%">
            <p class="row" style="padding-top:10px">
                    <form method="post"action="<?php $helper->url("busqueda","filtrar");?>">
                        <input type="hidden" name="clave" value="<?php echo $clave;?>">
                        <span class="row letras">Fecha inicio:<input class="form-control" type="date" name="fecha1" id="fecha1" required></span>
                        <span class="row letras">Fecha fin:<input class="form-control" type="date" name="fecha2" id="fecha2" required></span>
                        <span class="row justify-content-center"><input style="margin-top:5px" type="submit" name="filtrado" value="Filtrar" class="btn btn-sm btn-outline-info">
                    </form>
            </p>
            </div>
        <?php foreach ($allPost as $post) {
                        if (isset($cant)) {
                            foreach ($cant as $c) {
                                if ($c['id']==$post->id) {
                                    $t=$c['cant'];
                                }
                            }
                        }
                        if (isset($duenios)) {
                            foreach ($duenios as $you) {
                                if ($you['id']==$post->id) {
                                    $name=$you['username'];
                                }
                            }
                        }
                        $a++;
                        $den="denuncia".$a; ?>
                <div class="row post">
                        <div class="l card shadow-sm p-1 mb-3 bg-white rounded p">
                            <div class="card-body">
                            <span class="d" style="float: right;margin-bottom:5px">
                                <a id="nombre" style="padding-right:10px" href="<?php echo $helper->url('usuario', 'verMuro') ?>&id=<?php echo $post->user; ?>" height="30px">
                                    @<?php echo $name; ?></a>
                                    <button class="btn btn-outline-danger btn-sm" onClick="denunciar('<?php echo $den; ?>')"><b>x</b></button>
                                </span>
                        <form id="<?php echo $den; ?>" class="d-none" method="POST" action="<?php echo $helper->url("denuncia", "denunciarPost"); ?>&id=<?php echo $post->id; ?>">
                            <textarea class="form-control" style="margin-bottom:5px" name="motivo" rows="3" placeholder="Indique el motivo de su denuncia" required></textarea>     
                            <input class="btn btn-outline-info" style="float: right" type="submit" value="Enviar" name="submit">
                            </form>
                            <a class="x" href="<?php echo $helper->url('usuario', 'verPost') ?>&id=<?php echo $post->user; ?>&unico=<?php echo $post->id; ?>"><b><?php echo $post->titulo; ?></b></a><br>
                            <span id="fecha"><?php echo $post->fecha; ?></span>
                                <hr>
                                <?php
                                for ($i = 1; $i < 4; ++$i) {
                                    $each="palabra".$i;
                                    if ($post->$each) {
                                        echo '<span id="eti">'.$post->$each.'</span>';
                                    }
                                }
                        echo '<p class="card-text" style="margin-left:5px">'.$post->cuerpo.'</p>';
                        for ($i = 1; $i < 4; ++$i) {
                            $each="img".$i;
                            if ($post->$each) {
                                echo '<img src="'.$post->$each.'" alt="Imagen de post">';
                            }
                        }
                        echo '<hr>';
                        $t=isset($t)?$t:0;
                        $link=$helper->url('usuario', 'verPost')."&id=".$post->user."&unico=".$post->id;
                        if ($t>1||$t==0) {
                            echo'<a href="'.$link.'">'.$t.' Comentarios</a>';
                        } else {
                            echo'<a href="'.$link.'">'.$t.' Comentario</a>';
                        }
                        $t=0;
                        echo' </div>
                            </div>
                        </div>';
                    }
                }?>
        </div>   
        
          <!-------------------------------COL DOS---------------------->

    <div class="col-lg-6">
    <i class="letras row" style="margin:40px 0px -15px 10px">Personas:</i>
    <?php 
     if(!isset($personas)){
            echo '<div class="row r justify-content-center align-middle"><span class="alert alert-info">No se encontraron personas</span></div>';
     }else{$a=0;}
        if (isset($personas)) {
            foreach ($personas as $persona) {
                $link=$helper->url("usuario", "verMuro")."&id=".$persona->id; ?>
                    <div class="row post">
                        <div class="col">
                            <div class="people-nearby">
                                <div class="nearby-user">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <img src="<?php echo $persona->profilePic; ?>" alt="user" class="profile-photo-lg">
                                        </div>
                                        <div class="col-md-5 col-sm-5">
                                            <h5><b id="aque"><?php echo $persona->nombre." ".$persona->apellido; ?></b></h5>
                                            <p class="text-muted">@<?php echo $persona->username; ?></p>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <a href="<?php echo $link; ?>" class="btn btn-outline-warning btn-sm"><i class="">VER PERFIL</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                      </div>
              <?php
            }
        } ?>
                   </div>   
           </div>
    </div>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script language="javascript">
            function rotar(){
                if(document.getElementById("v").textContent=="<"){
                    document.getElementById("v").textContent="v";
            }else{document.getElementById("v").textContent="<";}
        }

            function denunciar(par){
                var x = document.getElementById(par);
                x.classList.toggle("d-none");
            }

            fecha1.max = new Date().toISOString().split("T")[0];
            fecha2.max = new Date().toISOString().split("T")[0];
    </script>
  </body>
</html>