<?php

class AccesoDatosAdministrador
{
    private static $instancia;

    private function __construct()
    {
    }

    public static function obtenerInstancia()
    {
        if (self::$instancia === null) {
            self::$instancia = new AccesoDatosAdministrador();
        }

        return self::$instancia;
    }

    public function obtenerEmpleadoDia($fechaInicio, $fechaFinal)
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();

        $query->prepare("CALL pConsultarEmpleadoDelDia_por_rango(?,?)");
        $query->bind_param('ss', $fechaInicio, $fechaFinal);
        $query->execute();
        $query->bind_result($nombre, $totalLavados);
        $empleado = array();
        while ($query->fetch()) {
            $empleado[] = array('nombre' => $nombre, 'totalLavados' => $totalLavados);
        }
        $query->close();
        return $empleado;
    }

    public function obtenerTotalLavados($fechaInicio, $fechaFinal)
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();
        $query->prepare("CALL pConsultarTotalLavadosDelDia_por_rango(?,?)");
        $query->bind_param('ss', $fechaInicio, $fechaFinal);
        $query->execute();
        $query->bind_result($totalLavados);
        while ($query->fetch())
            $total = $totalLavados;
        $query->close();
        return $total;
    }

    public function obtenerGananciasDia($fechaInicio, $fechaFinal)
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();
        $query->prepare("CALL pConsultarGananciasDelDia_por_rango(?,?)");
        $query->bind_param('ss', $fechaInicio, $fechaFinal);
        $query->execute();
        $query->bind_result($totalGanancias);
        while ($query->fetch())
            $ganancias = $totalGanancias;
        $query->close();
        return (float)$ganancias;
    }

    public function obtenerReportes($fechaInicio, $fechaFinal, $filtro, $isEmpleado, $isCliente, $isVehiculo)
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();

        $query->prepare("CALL pConsultarReportes(?,?,?,?,?,?);");
        $query->bind_param('ssssss', $fechaInicio, $fechaFinal, $filtro, $isEmpleado, $isCliente, $isVehiculo);
        $query->execute();
        $query->bind_result($factura, $empleadoUno, $empleadoDos, $cliente, $placa, $tipo, $modelo, $color, $observaciones, $fecha, $costo);
        $rs = '';

        while ($query->fetch()) {
            // Construye el HTML para cada fila de la tabla
            $rs .= '<tr>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . sprintf("FACT-%05d", $factura) . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $empleadoUno . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $empleadoDos . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $cliente . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $placa . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $tipo . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $modelo . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $color . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $observaciones . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . date('d/m/Y', strtotime($fecha)) . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">$' . $costo . '</td>';
            $rs .= '</tr>';
        }

        $query->close();

        // No agregues ningún mensaje de "No se encontraron registros" aquí

        return $rs;
    }

    public function sueldoEmpleados($fechaInicio, $fechaFinal)
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();

        $query->prepare("CALL pConsultarGananciasEmpleadosFechas(?,?);");
        $query->bind_param('ss', $fechaInicio, $fechaFinal);
        $query->execute();
        $query->bind_result($id,$nombre,$cargo,$salario);
        $rs = '';

        while ($query->fetch()) {
            // Construye el HTML para cada fila de la tabla
            $rs .= '<tr>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">EMP_' . $id . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $nombre . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">' . $cargo . '</td>';
            $rs .= '<td class="px-6 py-4 whitespace-nowrap">$' . $salario . '</td>';
            $rs .= '</tr>';
        }

        $query->close();

        // No agregues ningún mensaje de "No se encontraron registros" aquí

        return $rs;
    }
}
