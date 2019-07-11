<?php ini_get('register_globals'); 
if(isset($_SESSION['moderador'])){
    $helper->url("denuncia","moderar");
} else if(isset($_SESSION['admin'])){
    $helper->url("admin","index");
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
    <style>a{outline:0;text-decoration:none}html{overflow-x: hidden}li a:hover{text-shadow:0px 0px 1px black;font-weight:bold}.x,.d,h5{text-decoration-color:rgb(252, 159, 84);color: rgb(252, 159, 84)}#nombre{color: rgb(252, 159, 84)}.x:hover{text-decoration: none;color: rgb(255, 128, 24);text-shadow: 1px 1px 1px rgba(65, 65, 65, 0.637) }.todo{font-family: 'Assistant', sans-serif;}#img{padding-left:10px}.l{margin:30px 7px 0px 60px}.r{margin:30px 50px 0px 7px}#eti{background-color: #fefbde; padding:3px;margin:5px;color:grey}.card p{padding-top:10px}.post{width:100%}.post img{width:100%;height:auto}.p {width:100%}.space{justify-content:space-around}#f{width:200px;margin:40px 15px 0px 15px}#mod{background-color: #fcfbbe}</style>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
        <a class="navbar-brand" href="#"><b>StackOverPets</b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation" id="v" onClick="rotar()"style="outline: none"><</button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("admin","index"); ?>">Usuarios</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("admin","moderadores"); ?>">Moderadores</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("admin","denunciados"); ?>">Denunciados</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("admin","todo"); ?>">Todo el contenido</a>
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
    <div class="col-lg-12">
        <div class="row op">
        <form method="POST" action="<?php echo $helper->url("admin","otro"); ?>">
            <center>
            <b><input id="f" type="submit" name="mod" class="btn btn-outline-dark" value="Hacer moderador"></b>
            <b><input id="f" type="submit" name="hab" class="btn btn-outline-dark" value="Habilitar"></b>
            <b><input id="f" type="submit" name="des" class="btn btn-outline-dark" value="Deshabilitar"></b>

        <div class="row post">
            <div class="l card shadow-sm p-1 mb-3 bg-white rounded p"> 
                <div class="card-body space ">
                    <table cellpadding="15px" border="1" bordercolor="grey">
                    <tr align="center"><td><input type="reset" class="btn btn-dark" value="Clear">
                    </td><th>USERNAME</th><th>NOMBRE Y APELLIDO</th><th>MAIL</th><th>NACIMIENTO</th><th>INGRESA</th><th>ULTIMA MODIFICACION</th><th>ESTADO DE CUENTA</th></tr>
                    <?php 
                    if(isset($allUsers)){
                    foreach($allUsers as $user){ 
                        $flag=false;
                        if(isset($mod)){
                            foreach($mod as $m){
                                if($user->id==$m['id']){
                                    $flag=true;
                                }
                            }
                        }
                        if($flag){
            echo "<tr id='mod'><td align='center'><input type='radio' name='id' value='$user->id'>
                </td><td>$user->username</td><td>$user->nombre $user->apellido</td><td>$user->mail</td><td>$user->bday</td><td>$user->fechaAlta</td><td>$user->fechaUltMod</td><td align='center'>$user->status</td></tr>";
                            }else{
            echo "<tr><td align='center'><input type='radio' name='id' value='$user->id'>
                </td><td>$user->username</td><td>$user->nombre $user->apellido</td><td>$user->mail</td><td>$user->bday</td><td>$user->fechaAlta</td><td>$user->fechaUltMod</td><td align='center'>$user->status</td></tr>";                        
                            }
                        }}?></table>
                </div>
            </div>
        </div>
        </center></form>
    </div>
    </div>
</div>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>