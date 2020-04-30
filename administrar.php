<?php
include 'global/config.php';
include 'global/conexion.php';
include 'productos.php';
include 'templates/cabecera.php';
?>

<br/>
<?php if($mensaje!=""){ ?>
    <div class="alert alert-success">
        <?php echo ($mensaje);?>
        <a href="mostrarCarrito.php" class="badge badge-success">Ver Carrito</a>
    </div>
<?php }?>
    <div class="row">
        <?php
            $sentencia=$pdo->prepare("SELECT * from productos");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listaProductos);
        ?>
        <?php foreach($listaProductos as $producto){ ?>
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" height="350px" src="<?php echo $producto['imagen'];?>" alt="">
                    <div class="card-body">
                        <span><?php echo $producto['nombre'];?></span>
                        <h5 class="card-title"><?php echo $producto['precio'];?>€</h5>
                        <p class="card-text"><?php echo $producto['plataforma'];?></p>
                        <p class="card-text">ID: <?php echo $producto['id_pro'];?></p>
                        <form action="administrar.php" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $producto['id_pro'];?>">
                            <button class="btn btn-primary" name="borrar" value="Borrar" type="submit">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>    
        </div>
    </div>
<div class="modi">
    <h3>Añadir Videojuego</h3>
    <form class="form-horizontal" action="administrar.php" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre del nuevo videojuego">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="precio">Precio:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="precio" placeholder="Precio del nuevo videjuego">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Plataforma:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="plataforma" placeholder="Plataforma del nuevo videojuego">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Imágen (previamente subida a img/):</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="imagen" placeholder="Imágen del nuevo videojuego">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="agregar">Agregar</button>
            </div>
        </div>
    </form>
</div>
<div class="modi">
    <h3>Modificar Videojuego</h3>
    <form class="form-horizontal" action="administrar.php" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="id">ID actual:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="id" placeholder="ID actual del videojuego">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nombre" placeholder="Nuevo nombre del videojuego">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="precio">Precio:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="precio" placeholder="Nuevo precio del videjuego">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Plataforma:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="plataforma" placeholder="Nueva plataforma del videojuego">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Imágen (previamente subida a img/):</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="imagen" placeholder="Nueva imágen del videojuego">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="modificar">Modificar</button>
            </div>
        </div>
    </form>
</div>
<?php
include 'templates/pie.php';
?>