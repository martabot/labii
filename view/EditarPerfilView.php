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
    .costado {padding:10px 30px 10px 50px}
    h2{padding: 30px 20px 10px 20px}
    .todo span{width:100px}
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
                    <a class="nav-link" href="<?php echo $helper->url("notificaciones","notificaciones"); ?>">Notificaciones(<?php echo (int)$notis; ?>)</a>
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
    <h2>Editar perfil: <?php echo $usuario->username; ?></h2>
    <form method="POST" action="<?php echo $helper->url("usuario","actualizar"); ?>" enctype="multipart/form-data">
            <div class="row costado">
                <span>Nombre: </span><input class="col-4 form-control" type="text" name="nombre" value="<?php echo $usuario->nombre; ?>">
            </div>
            <div class="row costado">
                <span>Apellido: </span> <input class="col-4 form-control" type="text" name="apellido" value="<?php echo $usuario->apellido; ?>">
            </div>
            <div class="row costado">
                <span>e-mail: </span> <input class="col-4 form-control" type="text" name="mail" value="<?php echo $usuario->mail; ?>">
            </div>
            <div class="row costado">
                <span>Cumpleaños: </span> <input class="form-control col-4" type="date" name="bd" value="<?php echo date("Y-m-d");?>">
            </div>
            <div class="row costado">
                <span>Nacionalidad: </span> <select class="col-4 form-control" name="country" size=1>
                <?php foreach($paises as $pais) {
                    if($usuario->pais==$pais->id){
                        echo "<option value=".$pais->id." selected>".$pais->nombre."</option>";
                     }
                     else{
                        echo "<option value=".$pais->id.">".$pais->nombre."</option>";}
                     }?>
                </select>
            </div>
            <input type="hidden" value="<?php echo $usuario->profilePic; ?>" name="actual">
            <div class="row costado">
                <span>Foto de perfil: </span> <input class="col-4 form-control" type="file" name="profilePic" accept="image/png, image/jpeg, image/gif, image/png">
            </div>
            <div class="row costado">
                <span>Confirmar: </span> <input class="col-4 form-control" type="password" name="pass" placeholder="Password to confirm">
            </div>
            <div class="row costado">
                <div class="offset-md-2">
                    <button style="margin-right:10px" type="submit" formaction="<?php echo $helper->url("usuario","verMuro"); ?>" class="btn btn-outline-info">Cancelar</button>
                    <input type="submit" value="Actualizar" name="update" class="btn btn-outline-info">
                </div>
            </div>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
