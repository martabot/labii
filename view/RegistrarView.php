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
    <style>body{margin-top:35px}nav{position:fixed}.navbar-brand{text-shadow:0px 0px 1px yellow}a{outline:0;text-decoration:none}nav a:hover{text-shadow:0px 0px 1px yellow}.col-2{text-align: center;padding: 40px 20px 20px 20px}h2{padding-top: 50px}h2, h4{color: rgb(63, 63, 63); font-family: 'Kalam', cursive;}.col-4{margin: 5px}.form-control{border: 1px solid  #ffb617 }</style>
    </head>
    <body style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;">
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark" style="background-image: repeating-linear-gradient(rgb(255, 153, 0),rgb(255, 196, 0))">
        <a class="navbar-brand" href="<?php echo $helper->url("usuario","index"); ?>"><b>StackOverPets</b></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $helper->url("usuario","index"); ?>">Atras</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
            <div class="row justify-content-center">
                <H2>¡BIENVENIDO!</H2>
            </div>
            <div class="row justify-content-center">
                <h4>Unite a nuestra red para amantes de mascotas</h4>
            </div>
            <form method="POST" action="<?php echo $helper->url("usuario","crear"); ?>">
            <div class="row justify-content-center">
                <input class="col-4 form-control" type="text" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" required>
            </div>
            <div class="row justify-content-center">
                <input class="col-4 form-control" type="text" name="nombre" value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];} ?>" placeholder="Nombre" required>
            </div>
            <div class="row justify-content-center">
                <input class="col-4 form-control" type="text" name="apellido" value="<?php if(isset($_POST['apellido'])){echo $_POST['apellido'];} ?>" placeholder="Apellido" required>
            </div>
            <div class="row justify-content-center">
                <input class="col-4 form-control" type="text" name="mail" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];} ?>" placeholder="e-mail" required>
            </div>
            <div class="row justify-content-center">
                <input class="form-control col-4" type="date" name="bd" required>
            </div>
            <div class="row justify-content-center">
                <select class="col-4 form-control" name="country" size=1 required>
                <?php foreach($allPais as $pais) {
                    echo "<option value=".$pais->id.">".$pais->nombre."</option>";}?>
                </select>
            </div>
            <div class="row justify-content-center">
                <input class="col-4 form-control" type="password" name="pass1" placeholder="Enter Password" required>
            </div>
            <div class="row justify-content-center">
                <input class="col-4 form-control" type="password" name="pass" placeholder="Repeat Password" required>
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <input type="submit" value="Registrarse" name="register" class="btn btn-outline-info">
                </div>
            </div>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>