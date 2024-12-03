<?php
define('MAX_VIDEO_SIZE', 16 * 1024 * 1024); // 16 MB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../CONEXION/conexion.php";
    require_once "../MODELOS/ModeloProducto.php";
    session_start();
    if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['categoria']) && isset($_POST['cotizable']) 
        && isset($_POST['precio'])  && isset($_POST['stock']) && isset($_POST['fechaExp']) && isset($_FILES['imagen'])){


        $nombre_prod = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];  
        $categoria = $_POST['categoria'];  
        $cotizable =$_POST['cotizable']; 
        $precio = $_POST['precio'];
        $imagen = $_FILES['imagen']['name'];
        $imagen2 = isset($_FILES['imagen2']) ? $_FILES['imagen2']['name'] : null;
        $imagen3 = isset($_FILES['imagen3']) ? $_FILES['imagen3']['name'] : null;
        $video = isset($_FILES['video']) ? $_FILES['video']['name'] : null;
        $stock = $_POST['stock'];
        $fecha_expi = $_POST['fechaExp'];
        $usuario_vend = $_SESSION['id'];

        $producto = new Product();
        $mysqli = dbConnection::connect();

        if($nombre_prod == "" || $descripcion == "" || $categoria =="" || $cotizable ==""|| $fecha_expi == "" || $precio == "" 
            || $stock == "" || $usuario_vend == "" || $imagen == ""){
            $json_response = ["success" => false, "msg" => "Faltan campos por llenar"];
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit();

        }else {
             // Carpeta donde se guardarán las imágenes
            $targetDir = "IMAGENES1/";
           // Función para mover archivo a la carpeta de destino y obtener su contenido binario
            function moveAndGetBinary($fileKey, $targetDir){
                $file = $_FILES[$fileKey];
                $archivoDestino = $targetDir . '/' . basename($file['name']);

                if ($file['error'] === UPLOAD_ERR_OK && move_uploaded_file($file['tmp_name'], $archivoDestino)) {
                    return file_get_contents($archivoDestino);
                }

                return null;
            }

                // Obtener contenido binario de los archivos
            $imagenBinaria1 = moveAndGetBinary('imagen', $targetDir);
            $imagenBinaria2 = $imagen2 ? moveAndGetBinary('imagen2', $targetDir) : null;
            $imagenBinaria3 = $imagen3 ? moveAndGetBinary('imagen3', $targetDir) : null;
            $videoBinario = null;

            // Validar tamaño del video
            if ($video && $_FILES['video']['size'] > MAX_VIDEO_SIZE) {
                    $json_response = ["success" => false, "msg" => "El video es demasiado grande"];
                    header('Content-Type: application/json');
                    echo json_encode($json_response);
                exit();
            }

            // Obtener contenido binario del video
            if ($video) {
                $videoBinario = moveAndGetBinary('video', $targetDir);
            }

        
            $nuevoProducto = $producto->agregarProducto($mysqli, $nombre_prod, $descripcion, $imagenBinaria1, $imagenBinaria2,
                                 $imagenBinaria3, $videoBinario, $fecha_expi, $cotizable, $precio, $stock, $categoria, $usuario_vend);
    
            if ($nuevoProducto != null) {                 
                    $json_response = ["success" => true, "msg" => "Se agrego producto correctamente", "data" => json_encode($nuevoProducto)];
                    header('Content-Type: application/json');
                    echo json_encode($json_response);
                    exit();                       
            }else{
                    $json_response = ["success" => false, "msg" => "Error: No se pudo agregar producto"];
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