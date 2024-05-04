//TODO: Realizar el procedimiento para consultar reportes con AJAX
<?php
require 'config.php';
require './libreria/accesodatos/AccesoDatosAdministrador.php';

$accesoDatos = AccesoDatosAdministrador::obtenerInstancia();

if (isset($_POST['txtBuscar'])) {
    
    $resultado = $accesoDatos->obtenerReportes(
        $_POST['txtFechaInicio'] == '' ? NULL : $_POST['txtFechaInicio'],
        $_POST['txtFechaFinal'] == '' ? NULL : $_POST['txtFechaFinal'],
        $_POST['txtBuscar'],
        (bool)$_POST['chkEmpleado'],
        (bool)$_POST['chkCliente'],
        (bool)$_POST['chkVehiculo']
    );
}

echo $resultado;
