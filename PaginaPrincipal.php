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


<!doctype html>
<html lang="en">
  <head>
  <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=devide-width,  initial-scale=1.0">

        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
        <link rel="stylesheet" href="CSS/stylePaginaPrincipa.css">
        <title> ENTREGA</title>
    </head>
    <body>
    
    <title>SHOP</title>
  </head>
  <body>
    <div id="encab//navbar">

      <?php 
    //navbar
        require 'partials/navbar.php';
      ?>

      <!--CARRUCEL DE FOTOS-->
      <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselIndicators" data-slide-to="1"></li>
              <li data-target="#carouselIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="RECURSOS/IMAGENES/1.png" alt="First slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
</br>

                 <!--SECCIONES-->
         <section class="section-masvendidos" >
            <div class="container" >
                <h4> Más vendidos </h4>
                <div class="row">        
                    <div class="card  col" id="cardProducto">
                        <img class="card-img-top" style="width: 10rem;" src="RECURSOS/IMAGENES/MOCHILA.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">Mochila Transparente Casual Impermeable Para Mujer</h5><h6> $153.00</h6>
                          <p class="card-text">Ropa, Bolsas y Calzado/Equipaje y Bolsas/Mochilas</p>
                          <a href="producto.php" class="btn btn-outline-secondary">Ver producto</a>
                          <a class="btn btn-primary" href="Carrito.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                              </svg>
                            Agregar al carrito</a>
                        </div>
                      </div>

                      <div class="card col" id="cardProducto">
                        <img class="card-img-top" style="width: 10rem;"src="RECURSOS/IMAGENES/TOLDO.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">Carpa Toldo 3x3 Reforzado Plegable</h5><h6> $980.00</h6>
                          <p class="card-text">Hogar, Muebles y Jardín/Jardín y Aire Libre/Toldos y Cerramientos/Toldos</p>
                          <a href="producto.php" class="btn btn-outline-secondary">Ver producto</a>
                          <a class="btn btn-primary" href="Carrito.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                              </svg>
                            Agregar al carrito</a>
                        </div>
                      </div>    
                     
                      
                      <div class="card col" id="cardProducto">
                        <img class="card-img-top" style="width: 10rem;" src="RECURSOS/IMAGENES/BOCINA.png" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">Bocina  Steren Boc-832 Portatil Mini </h5><h6> $560.00</h6>
                          <p class="card-text">Electrónica, Audio y Video/Audio/Audio Portátil y Accesorios</p>
                          <a href="producto.php" class="btn btn-outline-secondary">Ver producto</a>
                          <a class="btn btn-primary" href="Carrito.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                              </svg>
                            Agregar al carrito</a>
                        </div>
                      </div>    
                     
               
            </div>
         </section> 



         <section class="section-recomendaciones">
            <div class="container">
                <h4> Básado en tus ultimos guardados </h4>
                <div class="row">         
                    <div class="card col-lg-4">
                        <img class="card-img-top" style="width: 10rem;" src="RECURSOS/IMAGENES/MOCHILA.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">Mochila Transparente Casual Impermeable Para Mujer</h5><h6> $153.00</h6>
                          <p class="card-text">Ropa, Bolsas y Calzado/Equipaje y Bolsas/Mochilas</p>
                          <a href="producto.php" class="btn btn-outline-secondary">Ver producto</a>
                          <a class="btn btn-primary" href="Carrito.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                              </svg>
                            Agregar al carrito</a>
                        </div>
                      </div>

                      <div class="card col-lg-4">
                        <img class="card-img-top" style="width: 10rem;"src="RECURSOS/IMAGENES/TOLDO.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">Carpa Toldo 3x3 Reforzado Plegable</h5><h6> $980.00</h6>
                          <p class="card-text">Hogar, Muebles y Jardín/Jardín y Aire Libre/Toldos y Cerramientos/Toldos</p>
                          <a href="producto.php" class="btn btn-outline-secondary">Ver producto</a>
                          <a class="btn btn-primary" href="Carrito.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                              </svg>
                            Agregar al carrito</a>
                        </div>
                      </div>    
                     
                      
                      <div class="card col-lg-4">
                        <img class="card-img-top" style="width: 10rem;" src="RECURSOS/IMAGENES/BOCINA.png" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">Bocina  Steren Boc-832 Portatil Mini </h5><h6> $560.00</h6>
                          <p class="card-text">Electrónica, Audio y Video/Audio/Audio Portátil y Accesorios</p>
                          <a href="producto.php" class="btn btn-outline-secondary">Ver producto</a>
                          <a class="btn btn-primary" href="Carrito.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                              </svg>
                            Agregar al carrito</a>
                        </div>
                      </div>    
                     
               
            </div>
         </section> 



         <br><br><br>
   <?php 
        require 'PARTIALS/Footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="JS/Busqueda.js"></script>

    </body>
</html>