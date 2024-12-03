<?php
class User
{
    public function agregarUsuario($miConexion, $_nombre, $_apePat, $_apeMat, $_user, $_correo, $_fechaNac, $_contrasenia,
    $_imagen, $_genero, $_rol, $_modo) {
        $query = "CALL ALTA_USUARIO(?,?,?,?,?,?,?,?,?,?,?)";
        try {
            $stmt = $miConexion->prepare($query);
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $miConexion->error);
            }

            // Ajusta los tipos de datos según corresponda para cada parámetro
            $null = null; // Placeholder para el valor de longblob
            $stmt->bind_param("sssssssbsss", $_nombre, $_apePat, $_apeMat, $_user, $_correo, $_fechaNac, $_contrasenia, $null, $_genero, $_rol, $_modo);
            $stmt->send_long_data(7,  $_imagen); // El índice 7 corresponde al parámetro de longblob

            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }

            $result = $stmt->get_result();
            if (!$result) {
                throw new Exception("Error al obtener el resultado de la consulta: " . $miConexion->error);
            }

            $stmt->close();
            $response = $result->fetch_assoc();
            return $response;

        } catch (Exception $e) {
            throw new Exception("Error en la ejecución del procedimiento almacenado: " . $e->getMessage());
        }
        return null;
    }

    public function identificarUsuario($_mysqli, $_user)
    {
        $query = "CALL IDENTIFICAR_USUARIO(?);";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("s", $_user); // Assuming both are strings
            $stmt->execute();
            $result = $stmt->get_result();
            $users = array();
            $stmt->close();
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;  // Add each user to the array
            }
            return $users[0];  // Return the array of users
        } catch (Exception $e) {
            $response = (object)array("status" => 500, "message" => $e->getMessage());
            echo json_encode($response);
            return null;
        }
        return null;
    }

    public function existeUsuario($_mysqli, $_user){
        $query = "CALL USUARIO_EXISTENTE(?)";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("s", $_user);
            $stmt->execute();
            
            $result = $stmt->get_result();
            $stmt->close();
            
            $response = $result->fetch_assoc();
        
            return $response;
        } catch (Exception $e) {
            $response = (object)array("status" => 500, "message" => $e->getMessage());
            echo json_encode($response);
            return null;
        }
        return null;
    }
    public function mostrarUsuarioPorID($_mysqli, $_id)
    {
        $query = "CALL MOSTRAR_USUARIO_POR_ID(?);";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("s",  $_id); // Assuming both are strings
            $stmt->execute();
             
            $users = array();
            $stmt->close();
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;  // Add each user to the array
            }
            return $users[0];  // Return the array of users
        } catch (Exception $e) {
            $response = (object)array("status" => 500, "message" => $e->getMessage());
            echo json_encode($response);
            return null;
        }
        return null;
    }

    public function modificarUsuario($_mysqli, $_idUser, $_nombre, $_apePat, $_apeMat, $_fechaNac, $_genero,
    $_imagen, $_correo, $_contrasenia, $_modo){

    $query = "CALL MODIFICAR_USUARIO(?,?,?,?,?,?,?,?,?,?)";
        try {
            $stmt = $_mysqli->prepare($query);
           // $_null = NULL;
            // Ajusta los tipos de datos según corresponda para cada parámetro
            $stmt->bind_param("ssssssssss", $_idUser, $_nombre, $_apePat, $_apeMat, $_correo, $_fechaNac, $_contrasenia, $_imagen, $_genero, $_modo);
           // $stmt->send_long_data(8, $_imagen); // El índice 7 corresponde al parámetro de longblob

            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta preparada: " . $stmt->error);
            }

            // No se espera un conjunto de resultados, solo un mensaje de éxito
            $response = ["success" => true, "msg" => "Usuario modificado con éxito"];

            return $response;
        } catch (Exception $e) {
            // Lanza una excepción en lugar de imprimir el mensaje de error
            throw new Exception("Error en la ejecución del procedimiento almacenado: " . $e->getMessage());
        }

        return null;
    }


    public function agregarProductoCarrito($_mysqli, $_user, $_producto)
    {
        $query = "CALL AGREGAR_PRODUCTO_CARRITO(?,?);";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("ss",  $_user, $_producto); 

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

    public function consultaProductoCarrito($_mysqli, $_user, $_producto)
    {
        $query = "CALL COMPROBAR_PRODUCTO_CARRITO(?,?,?);";
    
        try {
            $stmt = $_mysqli->prepare($query);

            $stmt->bind_param("sss", $_user, $_producto, $_outBoolean);
    
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta preparada: " . $stmt->error);
            }
         
            $stmt->close();
            return $_outBoolean;
        } catch (Exception $e) {
            throw new Exception("Error en la ejecución del procedimiento almacenado: " . $e->getMessage());
        }
    
        return null;
    }

    public function mostrarCarrito($_mysqli, $_id)
    {
    $query = "CALL MOSTRAR_CARRITO(?);";
    try {
        $stmt = $_mysqli->prepare($query);
        $stmt->bind_param("s",  $_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;  
        }
        return $users;  
    } catch (Exception $e) {
        // Puedes decidir cómo manejar la excepción en el nivel superior del script
        return null;
    }
    return null;
    }


    public function eliminarProductoCarrito($_mysqli, $_user, $_producto)
    {
    $query = "CALL ELIMINAR_PRODUCTO_CARRITO(?,?);";

    try {
        $stmt = $_mysqli->prepare($query);

        $stmt->bind_param("ss", $_user, $_producto);

        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta preparada: " . $stmt->error);
        }
     
        $stmt->close();
        return $_outBoolean;
    } catch (Exception $e) {
        throw new Exception("Error en la ejecución del procedimiento almacenado: " . $e->getMessage());
    }

    return null;
    }
}
?>