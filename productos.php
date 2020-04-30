<?php
session_start();

$mensaje="";

if(isset($_POST['logout'])){
    session_destroy();
    header("Refresh:0");
}

if(isset($_POST['registro'])){
    $resultado=$pdo->prepare('INSERT INTO usuarios (nombre,email,pass,rol) values (:name,:email,:pass,"registrado")');
	$resultado->bindValue("name", $_POST['name']);
	$resultado->bindValue("email", $_POST['email']);
    $resultado->bindValue("pass", $_POST['pass']);
	$resultado->execute();
    $_SESSION["nombre"]=$_POST["name"];
    $_SESSION["rol"]="registrado";
}

if(isset($_POST['login'])){
    $resultado=$pdo->prepare('SELECT * from usuarios where email= :email and pass= :pass');
	$resultado->bindValue(":email", $_POST['email']);
	$resultado->bindValue(":pass", $_POST['pass']);
	$resultado->execute();
	$numero_registro=$resultado->rowCount();
	if($numero_registro!=0){
        foreach($resultado->fetchAll() as $usuario){
            $_SESSION["rol"]=$usuario['rol'];
            $_SESSION["nombre"]=$usuario["nombre"];
        }
    }else{
        echo "<script>alert('No hay ningún usuario con esos datos...');</script>";   
    }
}

if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){
        case 'Agregar':
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                $mensaje.="Ok ID correcto".$ID;
            }else{
                $mensaje.="Upss... ID incorrecto".$ID;
            }
            if(is_string(openssl_decrypt($_POST['precio'],COD,KEY))){
                $precio=openssl_decrypt($_POST['precio'],COD,KEY);
                $mensaje.="Ok precio".$precio;
            }else{
                $mensaje.="Upss... precio incorrecto";
            }
            if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                $nombre=openssl_decrypt($_POST['nombre'],COD,KEY);
                $mensaje.="Ok nombre".$nombre;
            }else{
                $mensaje.="Upss... nombre incorrecto";
            }
            if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
                $cantidad=openssl_decrypt($_POST['cantidad'],COD,KEY);
                $mensaje.="Ok cantidad".$cantidad;
            }else{
                $mensaje.="Upss... cantidad incorrecto";
            }

            if(!isset($_SESSION['CARRITO'])){
                $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$nombre,
                    'PRECIO'=>$precio,
                    'CANTIDAD'=>$cantidad,
                );
                $_SESSION['CARRITO'][0]=$producto;
                $mensaje="Producto agregado al carrito";
            }else{
                $idProductos=array_column($_SESSION['CARRITO'],"ID");
                if(in_array($ID,$idProductos)){
                    echo "<script>alert('El producto ya ha sido seleccionado...');</script>";
                    $mensaje="";
                }else {
                    $NumeroProductos=count($_SESSION['CARRITO']);
                    $producto=array(
                        'ID'=>$ID,
                        'NOMBRE'=>$nombre,
                        'PRECIO'=>$precio,
                        'CANTIDAD'=>$cantidad,
                    );
                    $_SESSION['CARRITO'][$NumeroProductos]=$producto;
                    $mensaje="Producto agregado al carrito";
                }
            }
            //$mensaje=print_r($_SESSION,true);
        break;
        case "Eliminar":
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                foreach($_SESSION['CARRITO']as $indice=>$producto){
                    if($producto['ID']==$ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado...');</script>";
                    }
                }
            }else{
                $mensaje.="Upss... ID incorrecto".$ID;
            }
        break;

        $iUltimaPos = count($aCarrito);
        $aCarrito[$iUltimaPos]['nombre']=$nombre;
        $aCarrito[$iUltimaPos]['precio']=$precio;
        $aCarrito[$iUltimaPos]['id']=$ID;
        $aCarrito[$iUltimaPos]['cantidad']=$cantidad;
        $iTemCad = time() + (60 * 60);
        setcookie('carrito', serialize($aCarrito), $iTemCad);
    }

}

if(isset($_POST['borrar'])){
    $resultado=$pdo->prepare("DELETE from productos where id_pro= :id");
    $resultado->bindValue("id", $_POST['id']);
	$resultado->execute();
}

if(isset($_POST['agregar'])){
    $resultado=$pdo->prepare("INSERT INTO productos (nombre,precio,plataforma,imagen) values (:nombre,:precio,:plataforma,:imagen)");
    $resultado->bindValue(":nombre", $_POST['nombre']);
    $resultado->bindValue(":precio", $_POST['precio']);
    $resultado->bindValue(":plataforma", $_POST['plataforma']);
    $resultado->bindValue(":imagen", $_POST['imagen']);
	$resultado->execute();
}

if(isset($_POST['modificar'])){
    $resultado=$pdo->prepare("UPDATE productos set nombre=:nombre, precio=:precio, plataforma=:plataforma, imagen=:imagen where id_pro=:id");
    $resultado->bindValue(":id", $_POST['id']);
    $resultado->bindValue(":nombre", $_POST['nombre']);
    $resultado->bindValue(":precio", $_POST['precio']);
    $resultado->bindValue(":plataforma", $_POST['plataforma']);
    $resultado->bindValue(":imagen", $_POST['imagen']);
	$resultado->execute();
}

?>