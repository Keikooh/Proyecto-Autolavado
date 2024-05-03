<?php
    require_once 'ICRUD.php';
    require_once 'config.php';
    class CrudEmpleado implements ICRUD
    {
        function CreateUpdate(array $data)
        {
            // Ejecutar el procedimiento almacenado
            $con = new mysqli(s, u, p, bd);
            $con->set_charset('utf8');
            // Obtener los parámetros del arreglo de datos
            $identificador = $data[0];
            $nombre = $data[1];
            $cargo = $data[2];
            $turno = $data[3];
            $salario = $data[4];
            $color = $data[5]; // Obtener el valor de texto del color enviado por el cliente

            // Preparar la llamada al procedimiento almacenado
            $sql = "CALL InsertOrUpdateEmpleado(?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("isssds", $identificador, $nombre, $cargo, $turno, $salario, $color);
            $stmt->execute();
            $resultado = $stmt->affected_rows > 0;
            $stmt->close();
            $con->close();
            return $resultado;
        }


        function Read()
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $q = $con->stmt_init();
            $q->prepare("CALL ShowEmpleado()");
            $q->execute();
            $q->bind_result($id,$nombre,$cargo,$turno,$salario,$color);
            $rs = '';
            while ($q->fetch()) {
                $rs .= '<li class="flex items-center gap-x-3 p-4 bg-[#E5E4EE] rounded-xl Modificar id" data-id="'.$id.'">
                            <div class="color bg-indigo-400 size-5 rounded-full" style="background-color: '.$color.';" id="eColor"></div>
                            <div class="w-[90%]">
                                <div class="flex  justify-between">
                                    <!-- Nombre del empleado -->
                                    <h3 class="lblEmpleado text-[#001459] font-bold" id="eNombre">'.$nombre.'</h3>
                                    <form">
                                        <button class="btnEliminarEmpleado" type="submit" name="btnEliminarEmpleado" data-id="'.$id.'" value="'.$id.'"">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                                width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <!-- Cargo -->
                                <p class="text-black/35 font-semibold text-sm">Empleado de <span id="eCargo">'.$cargo.'</span></p>
                                <!-- Turno -->
                                <p class="text-black/35 font-semibold text-sm">Turno <span id="eTurno">'.$turno.'</span></p>
                                <p style="display: none;" id="eSalario">'.$salario.'</p>
                            </div>
                        </li>';
            }            
            $q->free_result();
            $q->close();
            return $rs;
        }

        function Delete($id)
        {
            $con = new mysqli(s, u, p, bd);
            $con->set_charset('utf8');
            $q = $con->stmt_init();
            $q->prepare("CALL DeleteEmpleado(?)");
            $q->bind_param('i', $id);
            $success = $q->execute();
            $q->close();
            $con->close();
            if ($success) {
                return true; // Éxito en la eliminación
            } 
            else {
                return false;
            }
        }
    }
?>
