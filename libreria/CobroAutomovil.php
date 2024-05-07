<?php
    date_default_timezone_set('America/Mexico_City');
    require_once 'IFacturacion.php';
    require_once 'config.php';
    class CobroAutomovil implements IFacturacion
    {
        function Cobrar($empleadoUno,$empleadoDos, $placa, $observaciones)
        {
            // Ejecutar el procedimiento almacenado para obtener el tipo y la clasificación
            $con = new mysqli(s, u, p, bd);
            $con->set_charset('utf8');
            $q = $con->stmt_init();
            $q->prepare("CALL CostoVariable(?)");
            $q->bind_param("s", $placa);
            $q->execute();
            $q->bind_result($tipo, $clasificacion);
            $q->fetch();
            $q->close();

            // Calcular el costo
            $costo = 150;

            // Preparar y ejecutar el segundo procedimiento almacenado
            $sql = "CALL InsertLavado(?, ?, ?, ?, ?,?)";
            $stmt = $con->prepare($sql);
            $fecha_actual = date("Y-m-d");
            $stmt->bind_param("iissds", $empleadoUno,$empleadoDos, $placa, $fecha_actual, $costo, $observaciones);
            $stmt->execute();
            $resultado = $stmt->affected_rows > 0;
            $stmt->close();
            $con->close();
            return $resultado;
        }
    }
?>