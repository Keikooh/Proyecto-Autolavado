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

    public function obtenerEmpleadoDia()
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();
        $query->prepare("CALL pConsultarEmpleadoDelDia()");
        $query->execute();
        $query->bind_result($nombre, $totalLavados);
        $empleado = "-";
        while ($query->fetch()) {
            $empleado = $nombre;
        }
        $query->close();
        return $empleado;
    }

    public function obtenerTotalLavados()
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();
        $query->prepare("CALL pConsultarTotalLavadosDelDia()");
        $query->execute();
        $query->bind_result($totalLavados);
        while ($query->fetch())
            $total = $totalLavados;
        $query->close();
        return $total;
    }

    public function obtenerGananciasDia()
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();
        $query->prepare("CALL pConsultarGananciasDelDia()");
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

        echo $fechaInicio;
        $query->prepare("CALL pConsultarReportes(?,?,?,?,?,?);");
        $query->bind_param('ssssss', $fechaInicio, $fechaFinal, $filtro, $isEmpleado, $isCliente, $isVehiculo);
        $query->execute();
        $query->bind_result($factura, $empleadoUno, $empleadoDos, $cliente, $placa, $tipo, $modelo, $color, $observaciones, $fecha, $costo);
        $rs = '';

        while ($query->fetch()) {
            $rs .= '
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">' . sprintf("FACT-%05d", $factura) . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $empleadoUno . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $empleadoDos . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $cliente . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $placa . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $tipo . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $modelo . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $color . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $observaciones . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . date('d/m/Y', strtotime($fecha)) . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $costo . '</td>
            </tr>
            ';
        }

        $query->close();
        return ($rs == '') ? '
                                <tr>
                                    <td colspan="11" class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-500">
                                        No se encontraron registros.
                                    </td>
                                </tr>
                            ' : $rs;
    }
    public function sueldoEmpleados($fechaInicio, $fechaFinal)
    {
        $con = new mysqli(s, u, p, bd);
        $query = $con->set_charset("utf8");
        $query = $con->stmt_init();

        echo $fechaInicio;
        $query->prepare("CALL pConsultarGananciasEmpleadosFechas(?,?);");
        $query->bind_param('ss', $fechaInicio, $fechaFinal);
        $query->execute();
        $query->bind_result($id,$nombre,$cargo,$salario);
        $rs = '';

        while ($query->fetch()) {
            $rs .= '
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">' . $id . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $nombre . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $cargo . '</td>
                <td class="px-6 py-4 whitespace-nowrap">$' . $salario . '</td>
            </tr>
            ';
        }

        $query->close();
        return ($rs == '') ? '
                                <tr>
                                    <td colspan="11" class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-500">
                                        No se encontraron registros.
                                    </td>
                                </tr>
                            ' : $rs;
    }
}
