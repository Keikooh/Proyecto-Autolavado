<?php
require 'config.php';
require './libreria/accesodatos/AccesoDatosAdministrador.php';

$accesoDatos = AccesoDatosAdministrador::obtenerInstancia();
$resultado = '';
$empleado = '';

if (isset($_POST['txtBuscar'])) {
    $resultado = $accesoDatos->obtenerReportes(
        $_POST['txtFechaInicio'] == '' ? NULL : $_POST['txtFechaInicio'],
        $_POST['txtFechaFinal'] == '' ? NULL : $_POST['txtFechaFinal'],
        $_POST['txtBuscar'],
        (bool)$_POST['chkEmpleado'],
        (bool)$_POST['chkCliente'],
        (bool)$_POST['chkVehiculo']
    );
    $empleado = $accesoDatos->sueldoEmpleados(
    $_POST['txtFechaInicio'] == '' ? NULL : $_POST['txtFechaInicio'],
    $_POST['txtFechaFinal'] == '' ? NULL : $_POST['txtFechaFinal']);
}

$response = array(
    'resultado' => trim($resultado),
    'empleado' => trim($empleado)
);
echo json_encode($response);
?>
