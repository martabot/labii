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
    .todo{font-family: 'Assistant', sans-serif;}
        html{scrollbar-face-color: orangered}
    .b{margin: 10px 10px 10px 10px}
    .ult{padding-top:30px;padding-bottom:30px}
    img{height: 220px; width: 60%; overflow: hidden;padding-top: 20px}
    .x{padding-left: 10px}
    section div.t{margin-top: 7px}
    .t,.t a{color: orangered}
    .t span, .x a{color: grey}
    .card{margin-top:15px }
    .post span{
        background-color: #fefbde; padding:3px;margin:5px;color:grey
    }
    .card p{
        padding-top:10px
    }
    .post{
        width:auto
    }
    .post img{
        width:100%;
        height:auto
    }
}
    </style>
  </head>
  <body>
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
            <a class="navbar-brand" href="<?php echo $helper->url("usuario","index"); ?>&id=<?php echo $usuario->id; ?>"><b>StackOverPets</b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation" id="v" onClick="rotar()" style="outline: none"><</button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $helper->url("usuario","index"); ?>&id=<?php echo $usuario->id; ?>">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Perfil</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <a style="text-decoration: none" href="<?php echo $helper->url("usuario","index"); ?>"><h4 style="color: whitesmoke;padding-left:20px">Ω</h4></a>
        </div>
    </nav>

    <div class="todo container-fluid">
        <div class="row">
            <div class="col-lg-3" style="position:fixed">
                <div class="row justify-content-center" style="padding-top: 10px">
                   <img src='<?php echo $usuario->profilePic; ?>' alt="foto de perfil"> 
                </div>
                <div class="row justify-content-center" style="padding-top: 23px">
                    <p><h2 class="card-header-title text-center"><?php echo strtoupper($usuario->nombre." ".$usuario->apellido); ?></h2></p>
                    <p><h4 class="mb-1 pb-4 pt-0 text-center"><?php echo $pais->nombre; ?></h4></p>
                </div>
                
                <!-- Card -->
                <div class="b card card-cascade shadow-sm p-1 mb-3 bg-white rounded">

                    <!-- Card content -->
                    <div class="ult card-body card-body-cascade text-center">
            
                                <section class="container-fluid">
                                <div class="row t">
                                        <a href="<?php echo $helper->url("usuario","editar") ?>&id=<?php echo $usuario->id; ?>">EDITAR PERFIL</a>
                                    </div>
                                    <div class="row t">
                                    <a href="<?php echo $helper->url("usuario","editar") ?>&id=<?php echo $usuario->id; ?>">INTERESES<span>&nbsp(30)</span></a>
                                    </div>
                                    <div class="row t">
                                        <a href="#">AMIGOS <span>&nbsp(2089)</span></a>
                                    </div>
                                    <div class="row t">
                                    <a href="<?php echo $helper->url("usuario","editar") ?>&id=<?php echo $usuario->id; ?>">ORDENAR POR DESTACADOS</a>
                                    </div>
                                </section>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 offset-md-3" style="padding-top: 15px">
                <div class="row">
                    <div class="col-lg-1">
                    
                    </div>
                    <div class="col-lg-7">
                    <div class="row" style="margin:30px 0px 30px -10px">
                    <a class="btn btn-outline-info my-2 my-sm-0" href="<?php echo $helper->url("post","index"); ?>&id=<?php echo $usuario->id; ?>">Agregar Post</a>
                    </div>
                        <div class="row">
                            <!-- Card Light -->
                            <div class="card post shadow-sm p-1 mb-3 bg-white rounded">

                                <!-- Card content -->
                                <div class="card-body">
                                
                                    <!-- Title -->
                                    <h4 class="card-title">UN REMEDIO NOVEDOSO CURA A UN GATO NEGRO</h4>
                                    <hr>
                                    <!-- Text -->
                                    <span>Gatito</span><span>Remedio</span><br>
                                    <p class="card-text">Noticia sobre la cura y recuperación de un bonito gato negro, llamado Mojito.</p>
                                    <!-- Link -->
                                    
                                    <hr>
                                    <a href="#!">253 Votos</a>&nbsp&nbsp&nbsp&nbsp<a href="#!">13 Comentarios</a>
                                </div>
                            
                            </div>
                            <!-- Card Light -->
                        </div>
                        <div class="row">
                            <!-- Card Light -->
                            <div class="card shadow-sm p-1 mb-3 bg-white rounded post">

                                <!-- Card content -->
                                <div class="card-body">
                                
                                    <!-- Title -->
                                    <h4 class="card-title">COMO BAÑAR A UN PERRO EN 6 PASOS</h4>
                                    <hr>
                                    <!-- Text -->
                                    <span>Perrito</span><span>Baño</span><span>Divertido</span><br>
                                    <p class="card-text">Te cuento como bañar a tu perro sin mojar toda la casa para que puedan compartir un buen momento con tu mejor amigo</p>
                                    <!-- Link -->
                                    <img src="https://data.whicdn.com/images/332384439/large.jpg" alt="La imagen puede contener animales en la playa, tomando sol, con protector uv factor 15">
                                    <hr>
                                    <a href="#!">253 Votos</a>&nbsp&nbsp&nbsp&nbsp<a href="#!">13 Comentarios</a>
                                </div>
                            
                            </div>
                            <!-- Card Light -->
                        </div>
                        <div class="row">
                            <!-- Card Light -->
                            
                            <div class="card post shadow-sm p-1 mb-3 bg-white rounded">

                                <!-- Card content -->
                                <div class="card-body">
                                
                                <!-- Title -->
                                <h4 class="card-title">UN REMEDIO NOVEDOSO CURA A UN GATO NEGRO</h4>
                                <hr>
                                <!-- Text -->
                                <p class="card-text">Noticia sobre la cura y recuperación de un bonito gato negro, llamado Mojito.</p>
                                <!-- Link -->
                                
                                <hr>
                                <a href="#!">253 Votos</a>&nbsp&nbsp&nbsp&nbsp<a href="#!">13 Comentarios</a>
                                </div>
                            
                            </div>
                            <!-- Card Light -->
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
