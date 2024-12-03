<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../CONEXION/conexion.php";
    require_once "../MODELOS/ModeloCategoria.php";
    session_start();

    if (isset($_POST['nombre']) && isset($_POST['descripcion']) ){

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $categoria = new Categoria();
        $conexion = new dbConnection(); // Crear una instancia de la clase Conexion
        $miConexion = $conexion->connect();

        if($nombre == "" || $descripcion == ""  ){
            $json_response = ["success" => false, "msg" => "Faltan campos por llenar"];
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit();

        }else {
            $result = $categoria->verificarCategoria($miConexion, $nombre);
            
            if($result !== null){
                if($result['response'] === 'NoExiste'){
                    $nuevaCategoria = $categoria->agregarCategoria($miConexion, $nombre, $descripcion, $_SESSION['id']);
        
                        if ($nuevaCategoria != null) {
                            
                            $json_response = ["success" => true, "msg" => "Se agrego categoria correctamente", "data" => json_encode($nuevaCategoria)];
                            header('Content-Type: application/json');
                            echo json_encode($json_response);
                            exit();
                            
                        }else{
                            $json_response = ["success" => false, "msg" => "Error: No se pudo agregar categoria"];
                            header('Content-Type: application/json');
                            echo json_encode($json_response);
                            exit();
                        }         
                }else{
                    $json_response = ["success" => false, "msg" => "Error: Categoria ya existe"];
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
    
        }

    }else{
        $json_response = ["success" => false, "msg" => "Error: No se recibieron los datos correctamente"];
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit();
    }

}
?>