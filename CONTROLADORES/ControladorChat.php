<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['ChatEnviar'])) {
        require_once "../CONEXION/conexion.php";
        require_once "../MODELOS/ModeloChat.php";

        $chat = new Chat();
       $chat->EnviarChat($_POST['ChatEnviar']);
        
    }
}


?>