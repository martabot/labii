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

    </script>
    <style>a{outline:0;text-decoration:none}html{overflow-x: hidden}nav a:hover{text-shadow:0px 0px 1px yellow}.d{color: rgb(252, 159, 84)}.x{font-size:16pt;color: rgb(252, 159, 84)}#nombre{color: rgb(252, 159, 84)}.todo{font-family: 'Assistant', sans-serif;}#img{padding-left:10px}.l{margin:30px 7px 0px 60px}.r{margin:30px 50px 0px 7px}#eti{background-color: #fefbde; padding:3px;margin:5px;color:grey}.card p{padding-top:10px}.post{width:100%}.post img{width:100%;height:auto}.p {width:100%}#fecha{color:silver}</style>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
        <a class="navbar-brand" href="#"><b>StackOverPets</b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation" id="v" onClick="rotar()"style="outline: none"><</button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","verMuro"); ?>">Perfil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("notificaciones","notificaciones"); ?>">Notificaciones<?php if($notis!=0) {echo "(".$notis.")";} ?></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <a style="text-decoration: none;color:whitesmoke;padding-left:20px" href="<?php  echo $helper->url("usuario","cerrarSesion");?>">Cerrar Sesion</a>
        </div>
    </nav>
<div class="row todo">
    
<div class="col-lg-6">
<?php  $i=0; 
    if(isset($allPost)){
        foreach($allPost as $post){
            if(isset($cant)){
                foreach($cant as $c){
                    if($c['id']==$post->id){
                    $t=$c['cant'];
                    }
                }
            }
            if(isset($duenios)){
            foreach($duenios as $you){
                if($you['id']==$post->id){
                $name=$you['username'];
                }
            }} $i++; $den="denuncia".$i;
               ?>
            <div class="row post">
                    <div class="l card shadow-sm p-1 mb-3 bg-white rounded p">
                        <div class="card-body">
                        <span class="d" style="float: right;margin-bottom:5px">
                            <a style="padding-right:10px" href="<?php echo $helper->url('usuario','verPost') ?>&id=<?php echo $post->user;?>&unico=<?php echo $post->id;?>" height="30px">
                                <span id="nombre">@<?php echo $name; ?></span></a>
                                <button class="btn btn-outline-danger btn-sm" onClick="denunciar('<?php echo $den; ?>')"><b>x</b></button>
                            </span>
                    <form id="<?php echo $den; ?>" class="d-none" method="POST" action="<?php echo $helper->url("denuncia","denunciarPost"); ?>&id=<?php echo $post->id; ?>">
                        <textarea class="form-control" style="margin-bottom:5px" name="motivo" rows="3" placeholder="Indique el motivo de su denuncia" required></textarea>     
                          <input class="btn btn-outline-info" style="float: right" type="submit" value="Enviar" name="submit">
                        </form>
                        <span class="x" class="card-title"><b><?php echo $post->titulo;?></b></span><br>
                        <span id="fecha"><?php echo $post->fecha; ?></span>
                            <hr>
                            <?php
                            for($i = 1; $i < 4; ++$i) {
                                $each="palabra".$i;
                                if($post->$each){
                                    echo '<span id="eti">'.$post->$each.'</span>';
                                }
                            }
                            echo '<p class="card-text">'.$post->cuerpo.'</p>';
                            for($i = 1; $i < 4; ++$i) {
                                $each="img".$i;
                                if($post->$each){
                                    echo '<img src="'.$post->$each.'" alt="Imagen de post">';
                                }
                            }
                                echo '<hr>';
                                $t=isset($t)?$t:0;
                                $link=$helper->url('usuario','verPost')."&id=".$post->user."&unico=".$post->id;
                                echo'<a href="'.$link.'">'.$t.' Comentarios</a>';
                                $t=0;
                           echo' </div>
                        </div>
                    </div>';
        }}?>
        </div>
    <div class="col-lg-6">
    <?php 
     if(!isset($amiguis)){
            echo '<div class="row r justify-content-center align-middle"><span class="alert alert-info">Los post de tus amigos aparecerán en esta seccion.</span></div>';
     }else{$i=0;}
        if(isset($amiguis)){
           foreach($amiguis as $post){
                if(isset($cant)){
                foreach($cant as $c){
                    if($c['id']==$post->id){
                    $t=$c['cant'];
                    }
                }
            }
            if(isset($duenios)){
            foreach($duenios as $you){
                if($you['id']==$post->id){
                $name=$you['username'];
                }
            }}$i++; $den="denu".$i;
               ?>
            <div class="row post">
                    <div class="r card shadow-sm p-1 mb-3 bg-white rounded p">
                        <div class="card-body">
                        <span class="d" style="float: right;margin-bottom:5px">
                            <a style="padding-right:10px" href="<?php echo $helper->url('usuario','verPost') ?>&id=<?php echo $post->user;?>&unico=<?php echo $post->id;?>" height="30px">
                                <span id="nombre">@<?php echo $name; ?></span></a>
                                <button class="btn btn-outline-danger btn-sm" onClick="denunciar('<?php echo $den; ?>')"><b>x</b></button>
                            </span>
                    <form id="<?php echo $den; ?>" class="d-none" method="POST" action="<?php echo $helper->url("denuncia","denunciarPost"); ?>&id=<?php echo $post->id; ?>">
                        <textarea class="form-control" style="margin-bottom:5px" name="motivo" rows="3" placeholder="Indique el motivo de su denuncia" required></textarea>     
                          <input class="btn btn-outline-info" style="float: right" type="submit" value="Enviar" name="submit">
                        </form>
                        <span class="x" class="card-title"><b><?php echo $post->titulo;?></b></span><br>
                        <span id="fecha"><?php echo $post->fecha; ?></span>
                            <hr>
                            <?php
                            for($i = 1; $i < 4; ++$i) {
                                $each="palabra".$i;
                                if($post->$each){
                                    echo '<span id="eti">'.$post->$each.'</span>';
                                }
                            }
                            echo '<p class="card-text">'.$post->cuerpo.'</p>';
                            for($i = 1; $i < 4; ++$i) {
                                $each="img".$i;
                                if($post->$each){
                                    echo '<img src="'.$post->$each.'" alt="Imagen de post">';
                                }
                            }
                                echo '<hr>';
                                $t=isset($t)?$t:0;
                                $link=$helper->url('usuario','verPost')."&id=".$post->user."&unico=".$post->id;
                                echo'<a href="'.$link.'">'.$t.' Comentarios</a>';
                                $t=0;
                           echo' </div>
                        </div>
                    </div>';
        }}?>
           </div>
    </div>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>