<?php
  require_once("functions.php");
  if(empty($_SESSION["username"])){
    header('Location: index.php');
  }
?>
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
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">Men&uacute;</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="movies.php">Pel&iacute;culas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Usuarios</a>
                </li>
                </ul>
            </div>

            <form class="form-inline">
              <button class="btn btn-light my-2 my-sm-0 btn-logout" type="submit" onclick='logout(); return false;'>Salir</button>
            </form>

        </nav>

        <h2>Usuarios&nbsp;
          <img id='img_add' class='img_button' src='images/plus-square-fill.svg' alt='' width='28' height='28' title='Agregar Registro' onclick='editBean("users")'>
          <img id='img_close' style='display:none;' class='img_button' src='images/x-square-fill.svg' alt='' width='28' height='28' title='Cerrar' onclick='closeTable()'>
        </h2>
        <div id='table_add'></div>
        <div id='table_users'></div>
    </div>

  <script src="js/jquery-3.5.1.min.js?<?php echo uniqid();?>"></script>
    <script src="js/bootstrap.bundle.min.js?<?php echo uniqid();?>"></script>
    <script src="js/functions.js?<?php echo uniqid();?>"></script>
  </body>
</html>

<script language="javascript">
  $(document).ready(function(){
    loadTable("users");
  });
</script>