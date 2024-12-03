<?php
require_once "./CONEXION/conexion.php"; // Incluir el archivo de conexión
session_start();

  if(empty($_SESSION['usuario']) and empty($_SESSION['nombre'])){
    header('location: InicioSesion.php');
  }
  $conexion = new dbConnection(); // Crear una instancia de la clase Conexion
  $miConexion = $conexion->connect();

  $sql = "CALL MOSTRAR_CATEGORIAS()";
  $stmt = $miConexion->prepare($sql);   
         

  if ($stmt->execute()) {
    $result = $stmt->get_result();    

    while ($row = $result->fetch_assoc()) {
      $categorias[] = $row;  // Add each user to the array
    }
  } else {
    $categorias = []; // Si hay un error en la consulta, asigna un array vacío
  }

 

$miConexion = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <link rel="stylesheet" href="CSS/StyleCarrito.css">
</head>

<body>

    <!--Narbar-->
    <div id="encabezado">
        <?php require 'PARTIALS/Navbar.php'; ?>
    </div>

    <br>

    <!--carrito-->

    <div class="container" id="title">
        <h2> Mi carrito de compras</h2>
        <input id="idUsuario" style="visibility: hidden;" value="" ></input>
    </div>

    <div class="container-fluid">
        <div class="row no-gutters">

            <div class="card mb-3" style="width:100%;">
                <div class="row">

                    <div class="col-md-2">
                        <img src="RECURSOS/IMAGENES/TOLDO.jpg" class="card-img-top" style="width:150px">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Carpa Toldo 3x3 Reforzado Plegable</h5>
                            <p name="idProducto" value="">1</p>
                            <h6>$560.00</h6>
                            <a class="btn btn-secondary btn-sm btn_eliminarProdCarrito" href="PaginaPrincipal.php"
                                data-id="">Eliminar</a>
                            <a href="Compra.php" class="btn" id="btnComprar"> Comprar ahora</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>



    
    <div class="container-fluid">
        <div class="row no-gutters">

            <div class="card mb-3" style="width:100%;">
                <div class="row">

                    <div class="col-md-2">
                        <img src="RECURSOS/IMAGENES/MOCHILA.jpg" class="card-img-top" style="width:150px">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Mochila Transparente Casual Impermeable Para Mujer</h5>
                            <p name="idProducto" value="">1</p>
                            <h6>$153.00</h6>
                            <a type="button" class="btn btn-secondary btn-sm btn_eliminarProdCarrito" href="PaginaPrincipal.php"
                                data-id="">Eliminar</a>
                            <a type="button" href="Compra.php" class="btn" id="btnComprar"> Comprar ahora</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

 
    </div>
    </div>
    </div>


    <!--Footer-->
    <br><br><br>
    <?php require 'PARTIALS/Footer.php'; 
    ?>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>