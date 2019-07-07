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
    .x,h5{text-decoration: none;color: rgb(252, 159, 84)}
    .x:hover{text-decoration: none;color: rgb(255, 128, 24);text-shadow: 1px 1px 1px rgba(65, 65, 65, 0.637) }
    .todo{
        font-family: 'Assistant', sans-serif;
    }
    </style>
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
                    <a class="nav-link" href="<?php echo $helper->url("usuario","verMuro"); ?>&id=<?php echo $usuario->id; ?>">Perfil</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <a style="text-decoration: none" href="<?php echo $helper->url("usuario","index"); ?>"><h4 style="color: whitesmoke;padding-left:20px">Ω</h4></a>
        </div>
    </nav>
<div class="row todo">
    <div class="col-lg-6">
        <div class="row justify-content-center" style="padding-top: 40px">
            <div class="card" style="width: 80%">
                <div class="card-body">
                      <a href="#" class="x"><h5 class="card-title">TITULO DE POST PUBLICO</h5></a>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
        <hr style="width: 80%;padding-left: 10%">
                <div class="card-body">
                      <a href="#" class="x"><h5 class="card-title">TITULO DE POST PUBLICO</h5></a>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
        <hr style="width: 80%;padding-left: 10%">
                <div class="card-body">
                      <a href="#" class="x"><h5 class="card-title">TITULO DE POST PUBLICO</h5></a>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row justify-content-center" style="padding-top: 40px">
            <div class="card" style="width: 80%;">
                <div class="card-body">
                      <h5 class="card-title">TITULO DE POST AMIGO <img alt="amigo" style="float: right" src="/public/img/duft1.jpg" height="30px"></h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="btn btn-info">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="padding-top: 40px">
            <div class="card" style="width: 80%;">
                <div class="card-body">
                      <h5 class="card-title">TITULO DE POST AMIGO <img alt="amigo"  style="float: right" src="/public/img/duft1.jpg" height="30px"></h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="btn btn-info">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="padding-top: 40px">
            <div class="card" style="width: 80%;">
                <div class="card-body">
                      <h5 class="card-title">TITULO DE POST AMIGO <img alt="amigo"  style="float: right" src="/public/img/duft1.jpg" height="30px"></h5>
                      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="btn btn-info">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>
    


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--<script src="/public/lib.js"></script>-->
  </body>
</html>