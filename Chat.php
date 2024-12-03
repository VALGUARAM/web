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
    <title>CHAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/StyleCarrito.css">

    <style>
        .chat{
            margin: 50px;
        }
        .message {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        .user-message {
            background-color: #d4edda;
        }
        .partner-message {
            background-color: #cce5ff;
        }
        .card input{
            background-color: #f0f0f0;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        .card-chat{
            padding: 10px   ;
        }
    </style>

</head>

<body>
<!--NARBAR-->
    <div id="encabezado">

        <nav class="navbar navbar-expand-lg ">
            <h5 class="navbar-brand" href="#">Sharp</h5 >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                  </svg>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorías
                    </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="CatTecnologia.html">Tecnología</a>
                    <a class="dropdown-item" href="CatEstilodeVida.html">Cocina y Hogar</a>
                  </div>
                </li>
               
                
                <li class="nav-item active">
                    <a class="nav-link" href="#">Nuevos productos<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="#">Mis compras<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="#">Ayuda<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item Usuario dropdown">
                   
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>  Usuario
                        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="Perfil de usuario.html">Perfil</a>
                        <a class="dropdown-item" href="#">Listas</a>
                        <a class="dropdown-item" href="HistorialComp.html">Historial de compras</a>
                    </div>
                </li>

                <li class="nav-item active">
                    <a class="nav-link carrito" href="Carrito.html"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                         <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg> <span class="sr-only">(current)</span>
                    </a>
                </li>

              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg></button>
              </form>
            </div>
          </nav>
          
</div>

<!--CHAT-->

<div class="chat">
    <div class="row">
        <div class="col-sm-6 chat-container">
            <div class="card card-chat">
                <h2>Chat Venta</h2>
                <div class="message user-message">
                    <strong>Tú:</strong> ¡Hola! ¿Me podría dar información del producto?
                </div>
                <div class="message partner-message">
                    <strong>Vendedor:</strong> ¡Hola! Claro...
                </div>
                <!-- Puedes agregar más mensajes aquí -->
                <!-- Para enviar un mensaje, puedes agregar un formulario -->
                <form action="./CONTROLADORES/ControladorChat.php" method="POST" >
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Escribe tu mensaje..." id="ChatEnviar" name="ChatEnviar">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
           
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Cotización</h3>
                  <div>
                    <label for="nombreProducto" class="form_label"> Nombre del producto: </label><br>
                    <input type="text" id="nombreProducto" class="form_input"name="txt_nomProd">
                  </div>
                  <div>
                    <label for="descripcionCotizacion" class="form_label"> Descripción del producto: </label><br>
                    <input type="text" id="DescCotizacion" placeholder="Aqui especifique medidas, material y cualquier cosa relevante respecto al producto que se esta cotizando" class="form_input"name="txt_descripcion">
                  </div>
                  <div>
                    <label for="cantidad" class="form_label"> Cantidad: </label><br>
                    <input type="text" id="CantidadProducto" class="form_input"name="txt_cantidad">
                  </div>
                  <div>
                    <label for="Precio" class="form_label"> Precio final: </label><br>
                    <input type="text" id="PrecioProducto" class="form_input"name="txt_precio">
                  </div><br>

                  <button type="submit" class="btn btn-primary">Generar Link </button>
                </div>
              </div>
        </div>
    </div>
</div>


    <!--Pie de pagina-->
  <footer class="footer container-fluid">
    <div class="row row-footer">
        
        <div class="col-lg-3">
            <ol>
                <h6>Conócenos</h6>
            </ol>
            <ol>
                Informacion corporativa
            </ol>
            <ol>
                Programas de apoyo para emprendedores
            </ol>
        </div>
           
   
        <div class="col-lg-3">
            <ol>
                <h6>Gana dinero con nosotros</h6>
            </ol>
            <ol>
                Vender en Sharp
            </ol>
            <ol>
                Programa de afiliados
            </ol>
            <ol>
                Anuncia tus productos
            </ol>
        </div>

        <div class="col-lg-3">
            <ol>
                <h6>Terminos y condiciones</h6>
            </ol>
            <ol>
                Politicas de devolución
            </ol>
            <ol>
                Politicas de garantias
            </ol>
        </div>

    </div>
</footer>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>