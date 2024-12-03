<?php
class Categoria
{
    public function agregarCategoria($_mysqli, $_nombre, $_descripcion, $_id)
    {
    $query = "CALL ALTA_CATEGORIA(?,?,?);";

    try {
        $stmt = $_mysqli->prepare($query);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $_mysqli->error);
        }

        $stmt->bind_param("sss", $_nombre, $_descripcion, $_id);

        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();
            if (!$result) {
                throw new Exception("Error al obtener el resultado de la consulta: " . $_mysqli->error);
            }
     
        $stmt->close();
        $response = $result->fetch_assoc();
        return $response;

    } catch (Exception $e) {
        throw new Exception("Error en la ejecución del procedimiento almacenado: " . $e->getMessage());
    }

    return null;
    }

    public function verificarCategoria($_mysqli, $_nombre)
    {
    $query = "CALL VERIFICAR_CATEGORIA(?);";

    try {
        $stmt = $_mysqli->prepare($query);

        $stmt->bind_param("s", $_nombre);

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
}
?>