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
    <title>Agregar Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/StyleAgregarCategoria.css">

    <style>
        .categoria{
            margin: 50px;
        }
        .card input{
            background-color: #f0f0f0;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        .card-body{ 
            position: relative;
        }
    </style>

</head>

<body>

  <!--Narbar-->
  <div id="encabezado">
    <?php require 'partials/navbar.php'; ?>
  </div><br>

  <!--AGREGAR CATEGORIA-->

  <form class="categoria form" action="#" onsubmit="validarFormulario(event);" method="POST" id="form_Registro" enctype="multipart/form-data">
  
      <div class="card">
        <div class="card-body">
            <h3 class="card-title">Agregar Categoria</h3>
            <div>
              <label for="nombreCategoria" class="form_label"> Nombre de la categoria: </label><br>
              <input type="text" id="nombreCategoria" class="form_input"name="txt_nomCat">
            </div>
            <div>
              <label for="descripcionCategoria" class="form_label"> Descripción de la categoria: </label><br>
              <input type="text" id="DescCategoria" placeholder="Descricion breve de la categoria a agregar" class="form_input"name="txt_descripcionCat">
            </div>

            <button type="submit" class="btn btn-warning">Agregar  Categoria</button>
          </div>
        </div>
      </div>

  </form>


  <!--Footer-->
  <br><br><br>
    <?php require 'partials/footer.php'; ?>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="JS/AgregarCategoria.js"></script>
</html>