
<?php

Class Chat {

public function EnviarChat($_Mensaje) {

$conexion = new dbConnection(); // Crear una instancia de la clase Conexion
$miConexion = $conexion->connect();

$query = "CALL ENVIAR_CHAT(?)";

$stmt = $miConexion->prepare($query);   
$stmt->bind_param("s", $_Mensaje);

$stmt->execute();


}




} 
?>
