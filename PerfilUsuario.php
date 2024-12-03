<?php
  session_start();
  require 'CONEXION/conexion.php';
  require 'MODELOS/ModeloUsuario1.php';

  if(empty($_SESSION['usuario']) and empty($_SESSION['nombre'])){
    header('location: InicioSesion.php');
  }else{
    $userModel = new User();
    $mysqli = dbConnection::connect();

    $userlogged = $userModel->identificarUsuario($mysqli, $_SESSION['usuario']);


    // Si la imagen no es null, la codificamos en base64 para poder utilizarla en HTML
    if ($userlogged['Foto_Perfil'] != null) {
        $_SESSION['IMAGEN'] = 'data:image/jpeg;base64,' . base64_encode($userlogged['Foto_Perfil']);
    } else {
        $_SESSION['IMAGEN'] = null; // O asigna una imagen por defecto
    }

    $sql = "CALL MOSTRAR_CATEGORIAS()";
    $stmt = $mysqli->prepare($sql);   
         

    if ($stmt->execute()) {
        $result = $stmt->get_result();    

        while ($row = $result->fetch_assoc()) {
            $categorias[] = $row;  // Add each user to the array
        }
    } else {
        $categorias = []; // Si hay un error en la consulta, asigna un array vacío
    }


   }
 
   $mysqli = null;
?>

<!DOCTYPE html>
<html ñamg ="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=devide-width,  initial-scale=1.0">    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
        <link rel="stylesheet" href="CSS/StylePerfilUsuario.css">
        <title> Perfil Usuario</title>

    </head>

  <body>

    <!--NAVBAR-->
    <div id="encabezado">
        <?php 
            require 'PARTIALS/Navbar.php';
        ?>
    </div>

    <!--DATOS PERSONALES-->  
    <form class = "form list_datosPersonales"  action="#" onsubmit="validarFormulario(event);"  id="form_ModificarUsuario" method="POST" enctype="multipart/form-data">
        <div class="card">
            <div class="secundario">
                <h3 class="title">Datos Personales</h3>
          
                <div id="DatosPersonales">
                    <label for="image" class="form_label" text_align: left> Foto perfil: </label><br>
                    <img id="imagenPerfil" name="image" style="width:150px" src="<?php echo $_SESSION['IMAGEN'] ?>" alt="Imagen de usuario"></br></br>
                    <input type="file" id="imagenInput" class="input_datosPersonales btn-image">
                </div>

                <div class="row">
                    <div class="col-md-6" id="DatosPersonales">
                        <div class="input_Datos_Personales" >
                            <label for="user" class="form_label"> Usuario: </label>
                            <input type = "text" id = "user" class ="input_datosPersonales" value = "<?php echo  $userlogged['Usuario']?>" unable>
                        </div>

                        <div class="input_Datos_Personales" >
                            <label for="name" class="form_label"> Nombre: </label>
                            <input type = "text" id = "name"class ="input_datosPersonales" value = "<?php echo  $userlogged['Nombre']?>">
                        </div>

                        <div class="input_Datos_Personales" >
                            <label for="lastName" class="form_label"> Apellido Paterno: </label>
                            <input type = "text" id = "lastName" class ="input_datosPersonales" value = "<?php echo  $userlogged['Apellido_Paterno']?>">
                        </div>

                        <div class="input_Datos_Personales" >
                            <label for="lastName2" class="form_label"> Apellido Materno: </label>
                            <input type = "text" id = "lastName2" class ="input_datosPersonales" value = "<?php echo  $userlogged['Apellido_Materno']?>">
                        </div>   
                                      
                        <div class="input_Datos_Personales">
                            <label for="fechaNacimiento" class="form_label"> Fecha Nacimiento:</label>
                            <input type="date" class ="input_datosPersonales"  id="Fecha_Nac" value = "<?php echo  $userlogged['Fecha_Nacimiento']?>">
                        </div>
                    </div>

                    <div class="col-md-6" id="DatosPersonales">
                        <div class="input_Datos_Personales">
                            <label for="mail" class="form_label"> Correo electrónico: </label>
                            <input type="text" class ="input_datosPersonales" id="Email" value = "<?php echo  $userlogged['Correo']?>">     
                        </div>
            
                        <div class="input_Datos_Personales">
                            <label class="form_label">Genero:</label></br>                           
                            <div class="input-box">
                            <div class="input-field">
                                <div class="select-container">
                                    <select id="genero" class="select-box">
                                        <option value="">Genero</option>
                                        <?php
                                            if ($userlogged["Genero"]==1){
                                        ?>
                                        <option value="1" selected>Mujer</option>
                                        <option value="2" >Hombre</option>
                                        <option value="3">Otro</option>
                                        <?php
                                           } else if ($userlogged["Genero"]==2){
                                        ?> 
                                        <option value="1" >Mujer</option>
                                        <option value="2" selected>Hombre</option>
                                        <option value="3">Otro</option>
                                        <?php
                                            }else if($userlogged["Genero"]==3){
                                        ?>
                                        <option value="1" >Mujer</option>
                                        <option value="2" >Hombre</option>
                                        <option value="3" selected>Otro</option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                
                                </div>
                            </div>
                            </div>                
                        </div>


                        <div class="input_Datos_Personales">
                            <label for="password" class="form_label">Contraseña:</label>
                            <input type="text" class ="input_datosPersonales" id="txt_Pass" value = "<?php echo  $userlogged['Contrasenia']?>">     
                        </div>
                        
                        <div class="input_Datos_Personales">
                            <label for="password2" class="form_label">Confirma contraseña: </label>
                            <input type="text"  class ="input_datosPersonales" id="txt_Pass2" value = "">       
                        </div>

                    </div>
                </div>
                      
            </div> 
        
            <div  class="btn_actDatos">
                <button type="submit" id="btn_ActualizarUsuario" class="btn">ACTUALIZAR USUARIO</button>
            </div>      
        </div>
   
    </form>


    <!--Footer-->
   <br><br><br>
   <?php 
        require 'PARTIALS/footer.php';
    ?>

    <script src="https://kit.fontawesome.com/3b5032f2e6.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js" integrity="sha512-kwtW9vT4XIHyDa+WPb1m64Gpe1jCeLQLorYW1tzT5OL2l/5Q7N0hBib/UNH+HFVjWgGzEIfLJt0d8sZTNZYY6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="JS/PerfilUsuario1.js"></script>

  </body>
</html>