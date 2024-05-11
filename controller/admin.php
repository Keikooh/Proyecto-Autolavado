<?php
require_once 'config.php'; // Asegúrate de incluir el archivo de configuración si es necesario
require_once 'libreria/accesodatos/AccesoDatosAdministrador.php';
date_default_timezone_set('America/Monterrey');
$p = array();

$accesoDatos = AccesoDatosAdministrador::obtenerInstancia();
// Cerrar sesión
if (isset($_POST['cerrar_sesion'])) {
    session_unset();
    //session_destroy();
    view('login');
    exit;
}

$p['empleadoDia'] = $accesoDatos->obtenerEmpleadoDia(NULL, NULL)[0]['nombre'];
$p['total'] = $accesoDatos->obtenerTotalLavados(NULL, NULL);
$p['ganancias'] = $accesoDatos->obtenerGananciasDia(NULL,NULL);
$p['sueldosEmpleados'] = $accesoDatos->sueldoEmpleados(NULL,NULL);
$p['resultado']=$accesoDatos->obtenerReportes(NULL,NULL,'',true,true,true);
$p['fechaHoy'] = date('d/m/Y');
view('admin', $p);
?>
