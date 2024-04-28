<?php
require 'config.php';
require 'libreria/accesodatos/AccesoDatosAdministrador.php';


session_start();
$p = array();

$accesoDatos = AccesoDatosAdministrador::obtenerInstancia();

$p['empleadoDia'] = $accesoDatos->obtenerEmpleadoDia();
$p['total']=$accesoDatos->obtenerTotalLavados();
$p['ganancias']=$accesoDatos->obtenerGananciasDia();
$p['resultado']=$accesoDatos->obtenerReportes();

View('admin', $p);
