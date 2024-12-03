<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="CSS/StyleRegistro.css">
   
    <title>Registro</title>
</head>
<body>

    <div class="wrapper">
        <form action="#" onsubmit="validarFormulario(event);" method="POST" class="form " id="form_Registro" enctype="multipart/form-data">
            <h1>Registro Usuario</h1>
            <div class="input-box">
                <div class="input-field">
                    <input id="user"type="text" placeholder="Nombre de Usuario" >
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-field">
                    <input  id="name"type="text" placeholder="Nombre" >
                    <i class='bx bxs-user'></i>
                </div>
            </div>

            <div class="input-box">
                <div class="input-field">
                    <input id="lastname"type="text" placeholder="Apellido Paterno" >
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-field">
                    <input  id="lastname2"type="text" placeholder="Apellido Materno" >
                    <i class='bx bxs-user'></i>
                </div>
            </div>

            <div class="input-box">
                <div class="input-field">
                    <input id="mail"type="email" placeholder="Correo" >
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-field">
                    <input id="fecNacimiento" type="date" placeholder="Fecha de Nacimiento" >
                    <i class='bx bxs-cake'></i>
                </div>

            </div>

            <div class="input-box">
                <div class="input-field">
                    <div class="select-container">
                        <select id="genero" class="select-box">
                            <option value=""selected>Genero</option>
                            <option value="1">Mujer</option>
                            <option value="2">Hombre</option>
                            <option value="3">Otro</option>
                        </select>
                        <div class="icon-container">
                            <i class='bx bxs-chevron-down'></i>
                        </div>
                    </div>
            </div>

            <div class="input-field">
                    <div class="select-container">
                        <select id="rol" class="select-box">
                            <option value="">Rol Usuario</option>
                            <option value="1">Vendedor</option>
                            <option value="2">Comprador</option>
                        </select>
                        <div class="icon-container">
                            <i class='bx bxs-chevron-down'></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="input-box">
                <div class="input-field">
                    <input type="password" id="password" placeholder="Password" >
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-field">
                    <input type="file" id="imagen"class="btn-image">
                    <i class='bx bx-image-add'></i>
                </div>

            </div>

            <br>
            <button type="submit" class="btn">Register</button> <br><br>
            <div class="register-link">
                <p>¿Ya estar registrado? <a href="InicioSesion.php">Iniciar Sesion</a></p>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js" integrity="sha512-kwtW9vT4XIHyDa+WPb1m64Gpe1jCeLQLorYW1tzT5OL2l/5Q7N0hBib/UNH+HFVjWgGzEIfLJt0d8sZTNZYY6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script type="text/javascript" src="JS/RegistroUsuario.js"></script>



</body>
</html>