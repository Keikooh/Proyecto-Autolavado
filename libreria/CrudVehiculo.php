<?php
    class CrudEmpleado implements ICRUD
    {
        function CreateUpdate(array $data,$table)
        {
            // Obtener los nombres de los campos y valores
            $campos = implode(',', array_keys($data)); // Obtiene los nombres de los campos y los concatena separados por comas
            $placeholders = implode(',', array_fill(0, count($data), '?')); // Crea una cadena de marcadores de posición para los valores

            // Consulta.
            $sql = "INSERT INTO $table ($campos) VALUES ($placeholders)";
            // Preparar los valores para la inserción
            $valores = array_values($data);
            // Ejecutar la consulta
            $con = new mysqli(s,u,p,bd);
            $con->set_charset('utf8');
            $q = $con->stmt_init();
            $q->prepare($sql);
            $tipoParametros = str_repeat('s', count($valores));
            $q->bind_param($tipoParametros, ...$valores);
            $q->execute();
            $q->close();
        }
        function Read(array $data,$table)
        {

        }
        function Delete($table,$id)
        {

        }
    }
?>