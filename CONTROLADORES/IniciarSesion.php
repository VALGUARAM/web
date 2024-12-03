<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../CONEXION/conexion.php";
    require_once "../MODELOS/ModeloUsuario1.php";

    if (isset($_POST['usuario']) && isset($_POST['contrasenia'])) {
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $user = new User();
        $mysqli = dbConnection::connect();

        if($usuario == "" || $contrasenia == ""){
            $json_response = ["success" => false, "msg" => "Faltan campos por llenar"];
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit();

        }else {
            $result = $user->existeUsuario($mysqli, $usuario);
            if ($result !== null) {
                if ($result['response'] === 'Existe') {
    
                    $userlogged = $user->identificarUsuario($mysqli, $usuario);
                    
                    if ($userlogged != null) {
            
                        if ($contrasenia == $userlogged['Contrasenia']) {
                            session_start();
                            $_SESSION['usuario'] = $usuario;//CUAL ES EL USUARIO LOGUEADO, GUARDA INFO
                            $_SESSION['id'] = $userlogged['ID_Usuario'];
                            $_SESSION['Rol'] = $userlogged['Rol'];
                            $json_response = ["success" => true, "msg" => "Se ha iniciado sesión", "data" => json_encode($userlogged)];
                            header('Content-Type: application/json');
                            echo json_encode($json_response);
                            exit();
        
                        } else {
                            $json_response = ["success" => false, "msg" => "Contraseña incorrecta"];
                            header('Content-Type: application/json');
                            echo json_encode($json_response);
                          
                            exit();
                        }
        
                    } else {
                        $json_response = ["success" => false, "msg" => "Error en buscar usuario", "data" => json_encode($userlogged)];
                        header('Content-Type: application/json');
                        echo json_encode($json_response);
                        exit();
                    }
                } else {
                    $json_response = ["success" => false, "msg" => "Usuario no existe" , "data" => json_encode($result)];
                    header('Content-Type: application/json');
                    echo json_encode($json_response);
                    exit();
                }
            } else {
                $result = "No existe Usuario";
                $json_response = ["success" => false, "msg" => "Error en identificar usuario", "data" => json_encode($result)];
                header('Content-Type: application/json');
                echo json_encode($json_response);
                exit();
            }	
    

        }


    } else {
        $json_response = ["success" => false, "msg" => "Verifique sus datos, están corruptos"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    }
}
?>