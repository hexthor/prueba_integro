<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css?<?php echo uniqid();?>" rel="stylesheet">
    <link href="css/style.css?<?php echo uniqid();?>" rel="stylesheet">

    <title>Prueba T&eacute;cnica</title>
  </head>
  <body>

    <main class="form-signin">
        <form>
            <div class="text-center">
                <img src="images/logo.png" class="rounded">
            </div>
            <br>
            <label for="inputUser" class="visually-hidden">Usuario</label>
            <input type="text" id="inputUser" class="form-control" placeholder="Usuario" autofocus>

            <label for="inputPassword" class="visually-hidden">Contrase&ntilde;a</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Contrase&ntilde;a">

            <button class="w-100 btn btn-lg btn-primary" type="button" onclick="userValidation()">Ingresar</button>
        </form>
    </main>
    <script src="js/jquery-3.5.1.min.js?<?php echo uniqid();?>"></script>
    <script src="js/bootstrap.bundle.min.js?<?php echo uniqid();?>"></script>
    <script src="js/functions.js?<?php echo uniqid();?>"></script>
  </body>
</html>