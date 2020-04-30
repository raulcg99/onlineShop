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
                        <form action="" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id_pro'],COD,KEY);?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'],COD,KEY);?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'],COD,KEY);?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
            
        </div>
    </div>
<?php
include 'templates/pie.php';
?>
