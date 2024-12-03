    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id'])) {
        require_once "../CONEXION/conexion.php";
        require_once "../MODELOS/ModeloUsuario1.php";

        $id = $_SESSION['id'];
    

        if (isset($_POST['Nombre']) && isset($_POST['Ape_Pat']) && isset($_POST['Ape_Mat'])
            && isset($_POST['Correo']) && isset($_POST['Fecha_Nac'])  && isset($_POST['Genero'])&& isset($_POST['Contrasenia'])) {

        
            $Name = $_POST['Nombre'];
            $LastName1 = $_POST['Ape_Pat'];
            $LastName2 = $_POST['Ape_Mat'];
            $Birthday = $_POST['Fecha_Nac'];
            $Email = $_POST['Correo'];
            $Pass = $_POST['Contrasenia'];
            $Genero = $_POST['Genero'];
            $Imagen = $_FILES['Imagen']['name'];

            $user = new User();
            $conexion = new dbConnection(); // Crear una instancia de la clase Conexion
            $miConexion = $conexion->connect();

            if ($Name == "" || $LastName1 == "" || $LastName2 == "" ||  $Birthday == "" || $Email == "" || $Pass == "" ) {
                // Crear la respuesta JSON con el mensaje de error y los datos faltantes
                $json_response = ["success" => false, "msg" => "Faltan campos por llenar"];
                header('Content-Type: application/json');   
                echo json_encode($json_response);
                exit();
            } else {
                if ($_FILES["Imagen"]["error"] !== UPLOAD_ERR_OK) {
                    $json_response = ["success" => false, "msg" => "Error al subir la imagen"];
                    header('Content-Type: application/json');
                    echo json_encode($json_response);
                    exit();
                }
                $targetDir = "IMAGENES1/";
                $archivoDestino = $targetDir . '\\' . basename($_FILES['Imagen']['name']);

                if (move_uploaded_file($_FILES["Imagen"]["tmp_name"], $archivoDestino)) {
                    $imagenBinaria = file_get_contents($archivoDestino); // Leer el contenido binario del archivo de imagen
                    //var_dump($imagenBinaria);
                   
                    try {
                        $result = $user->modificarUsuario($miConexion, $id, $Name, $LastName1, $LastName2,
                                                    $Birthday, $Genero, $imagenBinaria, $Email, $Pass, 1);
                        
                        if ($result !== null) {
                        //  $_SESSION['usuario'] = $Usuario;

                      
                            $json_response = ["success" => true, "msg" => "USUARIO ACTUALIZADO, ingresa con tus nuevas credenciales"];
                            header('Content-Type: application/json');
                            echo json_encode($json_response);
                            exit();
                        
                           
                        } else {
                            $json_response = ["success" => false, "msg" => "Error al actualizar el usuario"];
                            header('Content-Type: application/json');
                            echo json_encode($json_response);
                            exit();
                        }
                    } catch (Exception $e) {
                        $json_response = ["success" => false, "msg" => "Error en la base de datos: " . $e->getMessage()];
                        header('Content-Type: application/json');
                        echo json_encode($json_response);
                        exit();
                    }
                
                    
                }else{
                    $json_response = ["success" => false, "msg" => "No se pudo cargar la imagen", "data" => json_encode($nuevoUsuario)];
                    header('Content-Type: application/json');
                    echo json_encode($json_response);
                    exit();
                }



                
                    
                
            }
        } else {
            $json_response = ["success" => false, "msg" => "Faltan campos por llenar"];
        }

        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    }
    ?>
