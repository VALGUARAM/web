<?php
session_start();

  if(empty($_SESSION['usuario']) and empty($_SESSION['nombre'])){
    header('location: InicioSesion.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/StyleCompra.css">
</head>
<body>

<div id="encabezado">
        <?php
        //navbar
        require 'PARTIALS/Navbar.php';
        ?>
    </div>
    
     <!--CODIGO DE PRODUCTOS - API-->
 <div class="container-fluid" id="ProductoSeleccionado">
        <div class="row">
            <div class="card" id="cardArticulo">
                <!-- Contenido del carrito de compras existente -->
                <h2>Articulo Seleccionado</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Producto 1</td>
                            <td>$20.00</td>
                            <td>2</td>
                            <td>$40.00</td>
                            <td>
                                
                            </td>
                        </tr>
                        

                    </tbody>
                </table>

                <div class="text-right">
                    <h4>Total: $100.00</h4>
                </div>
            </div>
        </div></br>

        <div class="card " id="map">
            <h3>Direccion de Envio</h3>
            <?php
                require 'Maps.php';
            ?>
        </div>
        <div class="card col-md-6" >   
            <h3>Metodo de Pago</h3>
            <?php
                require 'Paypal.php';
            ?>      
        </div><br><br>

    </div>

 
    <a class="btn btn-warning" href="SeguimientoCompra.php">Comprar</a>
    <a class="btn btn-secundary" href="Carrito.php">Cancelar</a><br><br>
    <!--Pie de pagina-->
    <?php
    require 'PARTIALS/Footer.php';
    ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>