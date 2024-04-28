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
}
