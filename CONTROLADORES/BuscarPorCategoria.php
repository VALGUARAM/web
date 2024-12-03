<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['idCategoria'])) {
        require_once "../CONEXION/conexion.php";
        require_once "../MODELOS/ModeloProducto.php";

        $product = new Product();
        $result = $product->buscarProductoCategoria($_POST['idCategoria']);
        echo json_encode($result);
    }
}


?>