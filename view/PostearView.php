
<?php
    ini_get('register_globals'); 
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
    <style>.navbar-brand{text-shadow:0px 0px 1px yellow}a,input{outline:0;text-decoration:none}nav a:hover{text-shadow:0px 0px 1px yellow}.todo{font-family: 'Assistant', sans-serif;overflow:hidden;}html{scrollbar-face-color: orangered}.costado {padding:10px 30px 10px 50px}h2{padding: 30px 20px 10px 20px}.todo span{width:100px}</style>
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
                    <a class="nav-link" href="<?php echo $helper->url("usuario","verMuro"); ?>">Perfil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("notificaciones","notificaciones"); ?>">Notificaciones<?php if($notis!=0) {echo '&nbsp&nbsp<span class="badge badge-danger">'.$notis.'<span>';} ?></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <a style="text-decoration: none;color:whitesmoke;padding-left:20px" href="<?php  echo $helper->url("usuario","cerrarSesion");?>">Cerrar Sesion</a>
        </div>
    </nav>

    <div class="todo">
    <h2>Nuevo Post de: <?php echo $usuario->username; ?></h2>
    <form method="POST" action="<?php echo $helper->url("post","crear"); ?>" enctype="multipart/form-data">
            <div style="margin-left:35px">
                <span style="margin-left:100px"></span>
                        <input class="col-1" type="radio" name="privacidad" value="1" checked>Público  
                        <input class="col-1" type="radio" name="privacidad" value="0"> Privado
            </div>
            <div class="row costado">
                <span>Titulo: </span><input class="col-4 form-control" type="text" name="titulo" required>
            </div>
            <div class="row costado">
                <span>Etiquetas: </span> <input class="col-4 form-control" type="text" name="palabras" placeholder="Máximo 3 hashtags">
            </div>
            <div class="row costado">
                <span>Descripción: </span> <textarea rows="3" class="col-4 form-control" name="cuerpo" lenght="5000"></textarea>
            </div>
            <div class="row costado">
                <span>Agregar fotos: </span> <input class="col-4" type="file" name="img1" accept="image/png, image/jpeg, image/gif, image/png">
            </div>
            <div class="row costado">
                <span></span> <input class="col-4" type="file" name="img2" accept="image/png, image/jpeg, image/gif, image/png">
            </div>
            <div class="row costado">
                <span></span> <input class="col-4" type="file" name="img3" accept="image/png, image/jpeg, image/gif, image/png">
            </div>
            <div class="row costado">
                <div class="offset-md-2">
                    <input style="margin-right:30px" type="reset" value="Limpiar" class="btn btn-outline-info">
                    <input type="submit" value="Publicar" name="update" class="btn btn-outline-info">
                </div>
            </div>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
