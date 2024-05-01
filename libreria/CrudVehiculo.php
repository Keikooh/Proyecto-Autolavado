<?php
    require_once 'ICRUD.php';
    require_once 'config.php';
    class CrudVehiculo implements ICRUD
    {
        function CreateUpdate(array $data)
        {
            // Ejecutar el procedimiento almacenado
            $con = new mysqli(s, u, p, bd);
            $con->set_charset('utf8');
            // Obtener los parámetros del arreglo de datos
            $placa = $data[0];
            $cliente = $data[1];
            $tipo = $data[2];
            $clasificacion = $data[3];
            $modelo = $data[4];
            $color = $data[5]; // Obtener el valor de texto del color enviado por el cliente

            // Preparar la llamada al procedimiento almacenado
            $sql = "CALL InsertOrUpdateVehiculo(?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssiss",$placa,$cliente,$tipo,$clasificacion,$modelo,$color);
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
            $q->prepare("CALL ShowVehiculo()");
            $q->execute();
            $q->bind_result($placa, $cliente, $tipo, $clasificacion, $modelo, $color);
            $rs = '';
            while ($q->fetch()) {
                $rs .= '<li class="flex items-center justify-between p-4 bg-[#E5E4EE] rounded-xl Modificar">
                            <div>
                                <!-- Cliente -->
                                <h3 class="text-[#001459] font-bold" >Propiedad de <span id="eCliente">' . $cliente . '</span></h3>
                                <div class="flex gap-x-2 items-center opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ad-filled"
                                        width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M19 4h-14a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-10a3 3 0 0 0 -3 -3zm-10 4a3 3 0 0 1 2.995 2.824l.005 .176v4a1 1 0 0 1 -1.993 .117l-.007 -.117v-1h-2v1a1 1 0 0 1 -1.993 .117l-.007 -.117v-4a3 3 0 0 1 3 -3zm0 2a1 1 0 0 0 -.993 .883l-.007 .117v1h2v-1a1 1 0 0 0 -1 -1zm8 -2a1 1 0 0 1 .993 .883l.007 .117v6a1 1 0 0 1 -.883 .993l-.117 .007h-1.5a2.5 2.5 0 1 1 .326 -4.979l.174 .029v-2.05a1 1 0 0 1 .883 -.993l.117 -.007zm-1.41 5.008l-.09 -.008a.5 .5 0 0 0 -.09 .992l.09 .008h.5v-.5l-.008 -.09a.5 .5 0 0 0 -.318 -.379l-.084 -.023z"stroke-width="0" fill="currentColor" />
                                    </svg>
                                    <!-- Placa -->
                                    <span class="font-semibold text-sm" id="ePlaca">' . $placa . '</span>
                                </div>
                                <p class="text-black/35 font-semibold text-sm">
                                    <!-- Modelo -->
                                    <span>Modelo: <span id="eModelo">' . $modelo . '</span> Color '.$color.'</span>
                                </p>
                                <p class="text-black/35 text-sm">
                                    <!-- Marca -->
                                    Tipo de Vehiculo: <span id="eTipo">' . $tipo . '</span>
                                </p>
                                <p style="display: none;" id="eClasificacion">'.$clasificacion.'</p>
                                <p style="display: none;" id="eColorVehiculo">'.$color.'</p>
                            </div>
                            <button class="btnEliminarVehiculo" type="submit" name="btnEliminarVehiculo" data-id="'.$placa.'" value="'.$placa.'"">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                    width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </button>
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
            $q->prepare("CALL DeleteVehiculo(?)");
            $q->bind_param('s', $id);
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
