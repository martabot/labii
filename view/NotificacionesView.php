<?php 
ini_get('register_globals'); 
unset($_SESSION['visitante']);
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
    <style>
    .todo{font-family: 'Assistant', sans-serif;overflow:hidden;}
    html{scrollbar-face-color: orangered}
    h2{padding: 30px 20px 10px 20px}
    #noti{width:100%}
}
    </style>
  </head>
  <body>
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
            <a class="navbar-brand" href="<?php echo $helper->url("usuario","index"); ?>"><b>StackOverPets</b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation" id="v" onClick="rotar()" style="outline: none"><</button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","index"); ?>">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","verMuro"); ?>">Perfil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Notificaciones(<?php echo (int)$notis; ?>)</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <a style="text-decoration: none;color:whitesmoke;padding-left:20px" href="<?php  echo $helper->url("usuario","cerrarSesion"); ?>">Cerrar Sesion</a>
        </div>
    </nav>

    <div class="todo">
    
    <h2>Notificaciones: <?php echo $usuario->username; ?></h2>
    <div class="col-lg-1"></div>
    <div class="col-lg-6">
    <?php 
    if(isset($ns)){
    foreach($ns as $notificacion){
        if($notificacion->status==0){
            $link=$helper->url("notificaciones","actualizar")."&id=".$notificacion->id."&vis=".$notificacion->user1; ?>
            <div class="row">
                <a href="<?php echo $link; ?>">
                    <span id="noti" class="alert alert-warning"><?php echo $notificacion->descripcion;?></span>
                    </a>
                </div><br>
            

            <?php } else { 
                $link=$helper->url("notificaciones","actualizar")."&id=".$notificacion->id."&vis=".$notificacion->user1; ?>
                <div class="row">
                    <a href="<?php echo $link; ?>">
                        <span id="noti" class="alert alert-light"><?php echo $notificacion->descripcion;?></span>
                        </a>
                    </div><br>
        <?php }
            }
        }
    ?>          </div>
            <div class="col-lg-5">
            </div>
        </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>