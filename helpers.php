<?php 

//Loades view module NCHR
function View($view,$param = array(), $masterpage = '')
{
	extract($param);	

    ob_start();
	$file = "view/$view.view.php";
	require $file;
	$view_content = ob_get_clean();

	if($masterpage=='')
	{
		require 'view/masterpage/masterpage.default.view.php';	
	}	
	else 
	{
		require "view/masterpage/masterpage.$masterpage.view.php";
	}

} 

//Controler load NCHR
function Controller($controller)
{
	if(empty($controller))
	{
		$controller = 'home';
	}
		
	$file = "controller/$controller.php";

	if(file_exists($file))
	{
		require $file;	
	}
	else
	{
		require 'controller/error404.php';
	}
	
}











