<?php
//VGVR
class Product
{
    public function agregarProducto($_mysqli, $_nombreProd, $_descripcion, $_imagen, $_imagen2, $_imagen3, $_video, 
                     $_fechaExpi, $_cotizable, $_precio, $_stock, $_categoria, $_usuarioVend){
                                    
        $query = "CALL ALTA_PRODUCTO(?,?,?, ?,?,?, ?,?,?, ?,?,?)";
        try {
            $stmt = $_mysqli->prepare($query);
            // Ajusta los tipos de datos según corresponda para cada parámetro
            $null = null;
             $stmt->bind_param("sssbbbssssss", $_nombreProd, $_descripcion, $_imagen, $null, $null, $null, 
               $_fechaExpi, $_cotizable, $_precio, $_stock, $_categoria, $_usuarioVend);
            $stmt->send_long_data(3, $_imagen); 
            $stmt->send_long_data(4, $_imagen2); 
            $stmt->send_long_data(5, $_imagen3); 
            $stmt->send_long_data(6, $_video); 
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta preparada: " . $stmt->error);
            }
            
            $result = $stmt->get_result();
            
            // Verifica si la ejecución fue exitosa
            if (!$result) {
                throw new Exception("Error al obtener el resultado de la consulta: " . $_mysqli->error);
            }
            
            $stmt->close();
            
            $response = $result->fetch_assoc();
        
            return $response;
        } catch (Exception $e) {
            // Lanza una excepción en lugar de imprimir el mensaje de error
            throw new Exception("Error en la ejecución del procedimiento almacenado: " . $e->getMessage());
        }
        return null;
    }




 public function buscarProducto($_nombreProd) {

    $conexion = new dbConnection(); // Crear una instancia de la clase Conexion
  $miConexion = $conexion->connect();

  $query = "CALL sp_get_product_by_search(?)";

  
  $stmt = $miConexion->prepare($query);   
  $stmt->bind_param("s", $_nombreProd);
         
  $stmt->execute();

  $result = $stmt->get_result();
  $stmt->close();

  $response = $result->fetch_assoc();
  return $response;

  /* if () {
    $result = $stmt->get_result();    
    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo $result;

    while ($row = $result->fetch_assoc()) {
      $categorias[] = $row;  // Add each user to the array
    }

    //return $result;
  } */
    } 
    

    

public function buscarProductoCategoria($_idCategoria) {

  $conexion = new dbConnection(); // Crear una instancia de la clase Conexion
  $miConexion = $conexion->connect();

  $query = "CALL sp_get_product_by_category(?)";

  
  $stmt = $miConexion->prepare($query);   
  $stmt->bind_param("i", $_idCategoria);
         
  $stmt->execute();

  $result = $stmt->get_result();
  $stmt->close();

  $response = $result->fetch_assoc();
  return $response;

    } 


    
public function ConsultaPedido($_FechaPedido) {

  $conexion = new dbConnection(); // Crear una instancia de la clase Conexion
  $miConexion = $conexion->connect();

  $query = "CALL PEDIDOS_CONSULTA(?)";

  $stmt = $miConexion->prepare($query);   
  $stmt->bind_param("s", $_FechaPedido);

  $stmt->execute();

 
  $result = $stmt->get_result(); // Obtener el resultado de la consulta
    $datos = array(); // Crear un arreglo vacío

    while ($row = $result->fetch_assoc()) {
        $datos[] = $row; // Agregar cada fila al arreglo
    }

  $stmt->close();


  

  return $datos;

 


  } 

}



  


?>