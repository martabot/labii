<!doctype html>
<html lang="es">
  <head>
    <title>StackOverPets</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Kalam&display=swap" rel="stylesheet"> 
    <style>
        .col-2{text-align: center;padding: 26px 20px 18px 20px}
        h2{padding-top: 50px;font-family: 'Kalam', cursive;}
        .col-4{margin: 4px}
        .form-control{border: 1px solid  #ffb617 }
    </style>
  </head>
  <body>
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
            <a class="navbar-brand" href="<?php echo $helper->url("usuario","index"); ?>"><b>StackOverPets</b></a>
    </nav>
    <div class="container-fluid">
            <div class="row justify-content-center">
                <H2>¡BIENVENIDO!</H2>
            </div>
            <form method="POST" style="padding-top: 20px" action="<?php echo $helper->url("usuario","ingresar"); ?>">
            <div class="row justify-content-center">
                <input class="col-4 form-control" type="text" name="username" placeholder="Username">
            </div>
            <div class="row justify-content-center">
                <input class="col-4 form-control" type="password" name="pass" placeholder="Password">
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <input type="submit" value="Iniciar Sesión" name="login" class="btn btn-outline-info">
                </div>
            </div>
        </form>
        
        <div class="row justify-content-center">
            <img src="https://media.tenor.com/images/156d67035ed705631771dde7e0b1358a/tenor.gif">
        </div>
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>