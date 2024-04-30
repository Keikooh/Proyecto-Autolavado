<?php 
	session_start();
	//Codificación para el CRUD de los Empleados.
	require 'libreria/CrudEmpleado.php';
	$c = new CrudEmpleado();
	// Para Insertar y Modificar.
	if(isset($_POST['btnEliminarEmpleado'], $_POST['txtNombreEmpleado'], $_POST['txtCargo'], $_POST['txtTurno'], $_POST['txtSalario'], $_POST['txtColor'])) {
		$resultado = $c->CreateUpdate(array($_POST['btnEliminarEmpleado'], $_POST['txtNombreEmpleado'], $_POST['txtCargo'], $_POST['txtTurno'], $_POST['txtSalario'], $_POST['txtColor']));
	}
	// Para eliminar.
	if (isset($_POST['btnEliminarEmpleado']) && !isset($_POST['txtNombreEmpleado'])) {
		$registro = $c->Delete($_POST['btnEliminarEmpleado']);
		if ($registro) {
			echo "success";
		} else {
			echo "error";
		}
	}
	// Mostrar las tarjetas de empleados.
	$empleados = $c->Read();
	view("Supervisor", ['empleados' => $empleados]);
	//Codificación para el CRUD de los Vehiculos.
	
?>
