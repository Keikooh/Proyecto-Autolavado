<?php
//require 'config.php';
require 'libreria/accesodatos/AccesoDatosAdministrador.php';

$p = array();

$accesoDatos = AccesoDatosAdministrador::obtenerInstancia();
// Cerrar sesión
if (isset($_POST['cerrar_sesion'])) {
    session_unset();
    //session_destroy();
    controller('login');
    exit;
}

$p['empleadoDia'] = $accesoDatos->obtenerEmpleadoDia();
$p['total'] = $accesoDatos->obtenerTotalLavados();
$p['ganancias'] = $accesoDatos->obtenerGananciasDia();

$p['resultado']=$accesoDatos->obtenerReportes(NULL,NULL,'',true,true,true);

View('admin', $p);
