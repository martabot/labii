<?php ini_get('register_globals');

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
            function cambiarAP(){
                document.getElementById("id2").style.display="none";
                document.getElementById("id1").style.display="block";
            }

            function cambiarAC(){
                document.getElementById("id1").style.display="none";
                document.getElementById("id2").style.display="block";
            }


    </script>
    <style>body{margin-top:35px}.navbar-brand{text-shadow:0px 0px 1px yellow}a{outline:0;text-decoration:none}html{overflow-x: hidden}.x,.d,h5{text-decoration-color:rgb(252, 159, 84);color: rgb(252, 159, 84)}#nombre{color: rgb(252, 159, 84)}.x:hover{text-decoration: none;color: rgb(255, 128, 24);text-shadow: 1px 1px 1px rgba(65, 65, 65, 0.637) }.todo{font-family: 'Assistant', sans-serif;}#img{padding-left:10px}.l{margin:30px}.r{margin:30px 50px 0px 7px}#eti{background-color: #fefbde; padding:3px;margin:5px;color:grey}.card p{padding-top:10px}.post{width:95%}.post img{width:100%;height:auto}.p {max-width:95%}.space{justify-content:space-around}#f{width:250px;margin:40px 15px 0px 15px}#mod{background-color: #fcfbbe}nav a{text-shadow:0px 0px 1px #df9e31}#nan{padding:42px 25px 10px 25px;font-weight:bold;font-size:20px}</style>
  </head>
  <body style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;">
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
        <b class="navbar-brand">StackOverPets</b>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation" id="v" onClick="rotar()"style="outline: none"><</button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                
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
        <div class="row op justify-content-center">
            <span id="nan"><?php echo $t;?></span>
            <b><button id="f" class="btn btn-outline-dark" onClick="cambiarAP()">Posts denunciados</button></b>
            <b><button id="f" class="btn btn-outline-dark" onClick="cambiarAC()">Comentarios denunciados</button></b>
            <span id="nan"><?php echo $cant;?></span>
        <form id="id1" method="POST" action="<?php echo $helper->url("denuncia","moderar"); ?>">
            <center>
        <div class="row post">
            <div class="l card shadow-sm p-1 mb-3 bg-white rounded p"> 
                <div class="card-body space ">
               <div style="float:left;color:grey">
                    <span>*Nota: Los post denunciados con adjunto se identifican por un círculo a la derecha. Al autorizar un post permanece invisible para quien lo ocultó, al denegarlo se oculta para todos.</span>
                    </div>
                    <table class="table" cellpadding="15px" bordercolor="grey">
                    <tr align="center"><tH>MODERAR
                    </tH><th>CREADOR</th><th>DENUNCIANTE</th><th>TITULO</th><th>CUERPO</th><th>FECHA CREADO</th><th>FECHA DENUNCIADO</th><th>MOTIVO</th><th>IMG</th></tr>
                    <?php $tal=0;
                    if(isset($posts)){
                    foreach($posts as $post){
                        if(isset($usuarios)){
                            $unP="";
                            $unD="";
                            foreach($usuarios as $usuario){
                                if($usuario->id==$post['user']){
                                    $unP=$usuario->username;
                                }
                                if($usuario->id==$post['idUsuario']){
                                    $unD=$usuario->username;
                                }
                            }
                        }

                        if(!NULL==$post['img1']||!NULL==$post['img2']||!NULL==$post['img3']){$x="●";}else{$x="";}
                        $tal+=1;
                        $_SESSION['t']=$t;
            echo "<tr align='center'><td>";?>

                    <input type="hidden" name="<?php echo "p".$tal; ?>" value="<?php echo $post['id']; ?>">
                    <input type="hidden" name="<?php echo "r".$tal; ?>" value="<?php echo $post['idUsuario']; ?>">
                    <input type="hidden" name="<?php echo "fec".$tal; ?>" value="<?php echo $post['dFecha']; ?>">
                    <div class="btn-group d-flex" role="group" style="width:90px"><input type="submit" name="<?php echo "si".$tal; ?>" class="btn btn-success" value="✔">
                    <span style="width:5px"></span><input type="submit" name="<?php echo "nono".$tal; ?>" class="btn btn-danger" value="✘"></div>
            <?php echo "</td><td>$unP</td><td>$unD</td><td>
            <a href='".$helper->url('usuario','verPost')."&id=".$post['user']."&unico=".$post['id']."'>".
                $post['titulo']."</a></td><td>".$post['cuerpo']."</td><td>".$post['fecha']."</td><td>".$post['dFecha']."</td><td>".$post['motivo']."</td><td>$x</td></tr>";                        
                            }
                        }?></table>
                </div>
            </div>
        </div>
        </center></form>
<form id="id2" style="display:none" method="POST" action="<?php echo $helper->url("denuncia","moderar"); ?>">
            <center>
        <div class="row post">
            <div class="l card shadow-sm p-1 mb-3 bg-white rounded p"> 
                <div class="card-body space ">
                <div style="float:left;color:grey">
                    <span>*Nota: Los comentarios no serán visibles para ningún usuario hasta obtener moderación.</span>
                    </div>
                    <table class="table" cellpadding="15px" bordercolor="grey">
                    <tr align="center"><tH>MODERAR
                    </tH><th>CREADOR</th><th>DENUNCIANTE</th><th>CUERPO</th><th>FECHA CREADO</th><th>FECHA DENUNCIADO</th><th>MOTIVO</th></tr>
            <?php 
                    $tal=0;
                    $_SESSION['c']=$cant;
                    if(isset($coms)){
                    foreach($coms as $com){
                        if(isset($usuarios)){
                            $unP="";
                            $unD="";
                            foreach($usuarios as $usuario){
                                if($usuario->id==$com['user']){
                                    $unP=$usuario->username;
                                }
                                if($usuario->id==$com['idUsuario']){
                                    $unD=$usuario->username;
                                }
                            }
                        }
                        
            echo "<tr align='center'><td>";
            $tal+=1;
            ?>
                <input type="hidden" name="<?php echo "n".$tal; ?>" value="<?php echo $com['id']; ?>">
                <input type="hidden" name="<?php echo "d".$tal; ?>" value="<?php echo $com['idUsuario']; ?>">
                <input type="hidden" name="<?php echo "f".$tal; ?>" value="<?php echo $com['dFecha']; ?>">
        <div class="btn-group d-flex" role="group"  style="width:90px">
            <input type="submit" name="<?php echo "s".$tal; ?>" class="btn btn-success" value="✔">
                <span style="width:5px"></span>
                    <input type="submit" name="<?php echo "x".$tal; ?>" class="btn btn-danger" value="✘"></div>
                         <?php echo "</td><td>$unP</td>
                                        <td>$unD</td><td>
        <a href='".$helper->url('usuario','verPost')."&id=".$com['posteador']."&unico=".$com['post']."'>".$com['cuerpo']."</a>
            </td><td>".$com['fecha']."</td><td>".$com['dFecha']."</td><td>".$com['motivo']."</td></tr>";                        
                            }
                        }?></table>
                </div>
            </div>
        </div>
        </center></form>
    </div>
    </div>
</div> 

 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    
 </script>
 <?php if(isset($_SESSION['aca'])){
    echo '<script language="javascript">';
    echo "cambiarAC();";
    echo '</script>';
    unset($_SESSION['aca']);
} ?>
  </body>
</html>