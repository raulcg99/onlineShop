<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <title>Tienda</title> 
  <style>
    .modal-backdrop {
        z-index: -1;
    }
    li {
        margin: 2px;
    }
    div.container {
        margin-top: 15px;
    }
    div.modi{
        margin:20px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php">Videojuegos</a>
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
            <a class="nav-link" href="mostrarCarrito.php" tabindex="-1" aria-disabled="true">Carrito(<?php
                echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
            ?>)</a>
            </li>
            <?php if(isset($_SESSION["rol"])){ 
                if($_SESSION['rol']=="admin"){ ?>
                <li class="nav-item active">
                    <a class="nav-link" href="administrar.php">Administrar</a>
                </li>
                <?php }
            }?>
        </ul>
    <?php if(isset($_SESSION["rol"])){
        echo "Está conectado con el usuario ". $_SESSION["nombre"]; ?>
        <form action="index.php" method="post">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="logout">Log out</button>
            </div>
        </form>
    <?php }else{ ?>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">Login</button>
      <div class="modal" id="login">
        <div class="modal-dialog">
          <div class="modal-content">        
            <div class="modal-header">
              <h4 class="modal-title">Login de usuario</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="index.php" method="post">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Introduzca tu correo electrónico" name="email">
                </div>
                <div class="form-group">
                  <label for="pwd">Contraseña:</label>
                  <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </li>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registro">Registro</button>
      <div class="modal" id="registro">
        <div class="modal-dialog">
          <div class="modal-content">        
            <div class="modal-header">
              <h4 class="modal-title">Registro de usuario</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="index.php" method="post">
                <div class="form-group">
                  <label for="text">Nombre y Apellidos:</label>
                  <input type="text" class="form-control" required id="nombre" placeholder="Introduzca tu nombre" name="name">
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" required id="email" placeholder="Introduzca tu correo electrónico" name="email">
                </div>
                <div class="form-group">
                  <label for="pwd">Contraseña:</label>
                  <input type="password" class="form-control" required name="pass">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="registro">Registrarse</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </li>
    <?php }?>
  </ul>
</div>
</nav>
<br/>
<br/>
<div class="container">