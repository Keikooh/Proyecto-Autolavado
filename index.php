<?php 
require 'helpers.php';
$pagina = 'home';
if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}

Controller($pagina);
