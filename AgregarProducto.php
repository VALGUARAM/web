<?php
require_once "./CONEXION/conexion.php"; // Incluir el archivo de conexión
session_start();

$categorias = [];

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
    <link rel="stylesheet" href="CSS/StyleAgregarProducto2.css">

</head>

<body>
 <!--Narbar-->
 <div id="encabezado">
        <?php require 'partials/navbar.php'; ?>
    </div>

    <br>

<!--AGREGAR PRODUCTO-->
<form  onsubmit="validarFormulario(event);" class="form" id="form"  method="POST" action="#"  enctype="multipart/form-data">
    <h3 class="card-title">Agregar Producto</h3>
    <div class="form_container">
        <div class="row">
            <div class="col">
                <div class="form_group" id="grupo_nombre">
                    <label for="name" class="form_label"> Nombre del producto: </label>
                    <input type="text" id="name" class="form_input"name="txt_nomP">               
                </div>  

                <div class="form_group " id="grupo_descripcion">
                    <label for="DescProducto" class="form_label"> Descripcion del producto: </label>
                    <input type="text" id="DescProd" class="form_input"name="txt_dP">                   
                </div>   


                <div class="form-group">
                    <label for="cat-grupo" class="form_label">Categoria</label>
                    <select name="categoria" id="CatProd" class="form-control select-box" >
                        <option value="">Seleccione una categoria</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria['Id_Categoria']; ?>"><?php echo $categoria['Nombre_Categoria']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>  

                <div class="form_group" id="cotizable">
                    <label for="cotizable-grupo" class="form_label">Producto Cotizable</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radioOPSI" value="1" onchange="habilitarPrecio()">
                        <label class="form-check-label" for="radioOPSI">SI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radioOPNO" value="0" checked>
                        <label class="form-check-label" for="radioOPNO">NO</label>
                    </div>
                </div>

                <div class="form_group " id="grupo_precio">
                    <label for="precioProd" class="form_label">Precio: </label>
                    <input type="text" id="precio" class="form_input" name="txt_Precio" onkeypress="validarPrecio()" disabled>
                </div>

            </div>
          
            <div class="col">
                <div class="form_group " id="grupo_img">
                    <label for="image" class="form_label" text_align: left> Fotos del producto: </label>
                    <input type="file" class="form_input" id="image" onchange="habilitarImagenes()"> 
                    <input type="file" class="form_input" id="image2" disabled onchange="habilitarImagenes2()"> 
                    <input type="file" class="form_input" id="image3" disabled>                    
                     
                </div> 
                <div class="form_group " id="grupo_video">
                    <label for="video" class="form_label"> Video: </label>
                    <input type="file" class="form_input" id="video" onchange="handleFileInputChange()">                      
                   
                </div> 
                
                <div class="form_group">
                    <label for="fecha_Exp" class="form_label"> Fecha de expiración: </label>
                    <input id="fecha_Exp" type="date">
           
                </div>  

                <div class="form_group" id="stock-grupo">
                    <label for="Stock" class="form_label"> Cantidad en stock: </label>
                    <input id="stock" class="form_input" name="txt_stock" onkeypress="validarStock()">
                    
                </div> 
    
            </div>

            
            <input type="submit" name="accion" class="form_submit" value="Registrar">
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
    <script type="text/javascript" src="JS/RegistroProducto.js"></script>
</html>