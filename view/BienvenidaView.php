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
    <link href="https://fonts.googleapis.com/css?family=Kalam&display=swap" rel="stylesheet"> 
    <style>a{outline:0;text-decoration:none}nav a:hover{text-shadow:0px 0px 1px yellow}.col-2{text-align: center;padding: 40px 20px 20px 20px}h2{padding-top: 50px}h2, h4{color: rgb(63, 63, 63); font-family: 'Kalam', cursive;}</style>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
        <a class="navbar-brand" href="#"><b>StackOverPets</b></a>
    </nav>

    <div class="container-fluid">
            <div class="row justify-content-center">
                <H2>¡BIENVENIDO!</H2>
            </div>
            <div class="row justify-content-center">
                <h4>Unite a nuestra red para amantes de mascotas</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <a href="<?php echo $helper->url("usuario","iniciar"); ?>" role="button" class="btn btn-lg btn-outline-info">Iniciar Sesión</a>
                </div>
                <div class="col-2">
                    <a href="<?php echo $helper->url("usuario","registrarse"); ?>" role="button" class="btn btn-lg btn-outline-info">Registrarse</a>
                </div>
            </div>
    </div>

    <center><div><img src="https://media.tenor.com/images/156d67035ed705631771dde7e0b1358a/tenor.gif"></div></center>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>