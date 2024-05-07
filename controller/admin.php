<?php
require_once 'config.php'; // Asegúrate de incluir el archivo de configuración si es necesario
require_once 'libreria/accesodatos/AccesoDatosAdministrador.php';

$p = array();

$accesoDatos = AccesoDatosAdministrador::obtenerInstancia();
// Cerrar sesión
if (isset($_POST['cerrar_sesion'])) {
    session_unset();
    //session_destroy();
    view('login');
    exit;
}

$p['empleadoDia'] = $accesoDatos->obtenerEmpleadoDia();
$p['total'] = $accesoDatos->obtenerTotalLavados();
$p['ganancias'] = $accesoDatos->obtenerGananciasDia();

$p['resultado']=$accesoDatos->obtenerReportes(NULL,NULL,'',true,true,true);

view('admin', $p);
?>
