<?php 
require 'helpers.php';
$pagina = 'login';
if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}

Controller($pagina);
