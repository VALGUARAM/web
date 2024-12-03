<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../CONEXION/conexion.php";
    require_once "../MODELOS/ModeloUsuario.php";

    if (isset($_POST['usuario']) && isset($_POST['nombre']) && isset($_POST['apePaterno']) && isset($_POST['apeMaterno']) 
        && isset($_POST['correo']) && isset($_POST['fechaNac']) && isset($_POST['genero']) && isset($_POST['rol'])
        && isset($_POST['contrasenia']) ){

        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $apellidoPat = $_POST['apePaterno'];
        $apellidoMat = $_POST['apeMaterno'];
        $correo = $_POST['correo'];
        $fechaNac = $_POST['fechaNac'];
        $genero = $_POST['genero'];
        $rol = $_POST['rol'];    
        $contrasenia = $_POST['contrasenia'];
        $imagen = $_FILES['imagen']['name'];

        $user = new User();
        $conexion = new dbConnection(); // Crear una instancia de la clase Conexion
        $miConexion = $conexion->connect();

        if($usuario == "" || $nombre == "" || $apellidoPat == "" || $apellidoMat == "" || $correo == "" || $fechaNac == ""
            || $genero == "" || $rol == "" || $contrasenia == "" ){
            $json_response = ["success" => false, "msg" => "Faltan campos por llenar"];
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit();

        }else {
            if ($_FILES["imagen"]["error"] !== UPLOAD_ERR_OK) {
                $json_response = ["success" => false, "msg" => "Error al subir la imagen"];
                header('Content-Type: application/json');
                echo json_encode($json_response);
                exit();
            }

            // Carpeta donde se guardarán las imágenes
            $targetDir = "IMAGENES1/";
            $archivoDestino = $targetDir . '\\' . basename($_FILES['imagen']['name']);
            // Se asegura que la carpeta exista
           // if (!is_dir($targetDir)) {
               // mkdir($targetDir, 0777, true);
            //}
            //$targerCarpet ="CONTROLADORES/IMAGENES1/";
            // Ruta completa del archivo de destino
            //$targetFilePath = $targetDir . basename($imagen);

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivoDestino)) {
                //$targerCarpet ="CONTROLADORES/IMAGENES1/";
                //$targetFilePath = $targerCarpet . basename($imagen);
                $imagenBinaria = file_get_contents($archivoDestino); // Leer el contenido binario del archivo de imagen
                
                $result = $user->existeUsuario($miConexion, $usuario);
                
                if($result !== null){
                    if($result['response'] === 'NoExiste'){
                            $nuevoUsuario = $user->agregarUsuario($miConexion, $nombre, $apellidoPat, $apellidoMat, 
                            $usuario, $correo, $fechaNac, $contrasenia, $imagenBinaria, $genero, $rol, 1);
    
                            if ($nuevoUsuario != null) {
                                session_start();
                                $json_response = ["success" => true, "msg" => "Se agrego usuario correctamente", "data" => json_encode($nuevoUsuario)];
                                header('Content-Type: application/json');
                                echo json_encode($json_response);
                                exit();
                        
                            }else{
                                $json_response = ["success" => false, "msg" => "Error: No se pudo agregar usuario"];
                                header('Content-Type: application/json');
                                echo json_encode($json_response);
                                exit();
                            }                
                                            
                    }else{
                        $json_response = ["success" => false, "msg" => "Error: Usuario ya existe"];
                        header('Content-Type: application/json');
                        echo json_encode($json_response);
                        exit();
                    }
    
                }else{
                    $json_response = ["success" => false, "msg" => "Error: En consulta de sql"];
                    header('Content-Type: application/json');
                    echo json_encode($json_response);
                    exit();
                    
                }
            }else{
                $json_response = ["success" => false, "msg" => "Error: No se pudo cargar correctamente la imagen"];
                header('Content-Type: application/json');
                echo json_encode($json_response);
                exit();
            }
     
        }

    }else{
        $json_response = ["success" => false, "msg" => "Error: No se recibieron los datos correctamente"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    }

}
?>