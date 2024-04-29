<?php 
require 'helpers.php';
$pagina = 'admin';
if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}

Controller($pagina);
