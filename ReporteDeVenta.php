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
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/StyleReporteVenta.css">

    </head>

<body>
    <!--Narbar-->
    <div id="encabezado">
        <?php require 'partials/navbar.php'; ?>
    </div>
    <br>

    <div class="container">
        
        <h3 >Reporte de venta mensual</h3>
        <br><br>
        <div class= " col-3">
        
        <img  name="image" style="width:150px" id="previewImage" src="RECURSOS/IMAGENES/image_user.png"></br></br>
        <h4>Nombre Usuario</h4>
        </div><br>

        <div class= "col-8">
            <p>Mas vendidos</p>
            <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad Vendida</th>
                            <th>Periodo</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Producto 1</td>
                            <td>$20.00</td>
                            <td>152</td>
                            <td>Enero-Febrero</td>
                            <td>
                                
                            </td>
                        </tr>

                        <tbody>
</table>
        </div><br>

        <div class= "col-8">
            <p>Mejeron ranqueados</p>
            <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad Vendida</th>
                            <th>Periodo</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Toldo</td>
                            <td>$32.00</td>
                            <td>80</td>
                            <td>Enero-Febrero</td>
                            <td>
                                
                            </td>
                        </tr>

                        <tbody>
</table>
        </div>

    </div>

    <!--Footer-->
    <br><br><br>
    <?php require 'partials/footer.php'; ?>


</body>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>