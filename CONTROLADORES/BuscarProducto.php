<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['nombreProd'])) {
        require_once "../CONEXION/conexion.php";
        require_once "../MODELOS/ModeloProducto.php";

        $product = new Product();
        $result = $product->buscarProducto($_POST['nombreProd']);
        echo json_encode($result);
    }
}

?>