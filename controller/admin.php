<?php
require 'config.php';
require 'libreria/accesodatos/AccesoDatosAdministrador.php';


session_start();
$p = array();

$accesoDatos = AccesoDatosAdministrador::obtenerInstancia();

$p['empleadoDia'] = $accesoDatos->obtenerEmpleadoDia();
$p['total']=$accesoDatos->obtenerTotalLavados();
$p['ganancias']=$accesoDatos->obtenerGananciasDia();

$fechaInicio = isset($_POST['txtFechaInicio']) ? $_POST['txtFechaInicio']:null;
$fechaFinal = isset($_POST['txtFechaFinal']) ? $_POST['txtFechaFinal']:null;

$isCliente = isset($_POST['chkCliente']) ? $_POST['chkCliente']:null;
$isEmpleado = isset($_POST['chkEmpleado']) ? $_POST['chkEmpleado']:null;
$isVehiculo = isset($_POST['chkVehiculo']) ? $_POST['chkVehiculo']:null;

$filtro = isset($_POST['txtBuscar']) ? $_POST['txtBuscar']:'';


$p['resultado']=$accesoDatos->obtenerReportes($fechaInicio,$fechaFinal,$isCliente,$isEmpleado,$isVehiculo,$filtro);

View('admin', $p);
