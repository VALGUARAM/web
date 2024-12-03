<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['fechaPedido'])) {
        require_once "../CONEXION/conexion.php";
        require_once "../MODELOS/ModeloProducto.php";

        $product = new Product();
        $result = $product->ConsultaPedido($_POST['fechaPedido']);
        echo json_encode($result);
    }
}


?>