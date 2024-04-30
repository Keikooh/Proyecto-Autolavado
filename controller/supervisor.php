<?php 
	session_start();
	require 'libreria/CrudEmpleado.php';
	require 'libreria/CrudVehiculo.php';
	// Mostrar las tarjetas de empleados y vehiculos.
	$c = new CrudEmpleado();
	$v = new CrudVehiculo();
	$empleados = $c->Read();
	$vehiculos = $v->Read();


											//Codificación para el CRUD de los Empleados.
	// Para Insertar y Modificar.
	if(isset($_POST['btnEliminarEmpleado'], $_POST['txtNombreEmpleado'], $_POST['txtCargo'], $_POST['txtTurno'], $_POST['txtSalario'], $_POST['txtColor'])) {
		$c->CreateUpdate(array($_POST['btnEliminarEmpleado'], $_POST['txtNombreEmpleado'], $_POST['txtCargo'], $_POST['txtTurno'], $_POST['txtSalario'], $_POST['txtColor']));
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

											//Codificación para el CRUD de los Vehiculos.
	// Para Insertar y Modificar.
	if(isset($_POST['txtPlaca'], $_POST['txtCliente'], $_POST['txtTipo'], $_POST['txtClasificacion'], $_POST['txtModelo'], $_POST['txtColorVehiculo'])) {
		$v->CreateUpdate(array($_POST['txtPlaca'], $_POST['txtCliente'], $_POST['txtTipo'], $_POST['txtClasificacion'], $_POST['txtModelo'], $_POST['txtColorVehiculo']));
	}
	// Para eliminar.
	if (isset($_POST['btnEliminarVehiculo']) && !isset($_POST['txtCliente'])) {
		$registro = $v->Delete($_POST['btnEliminarVehiculo']);
		if ($registro) {
			echo "success";
		} else {
			echo "error";
		}
	}
	view("Supervisor", ['empleados' => $empleados, 'vehiculos' => $vehiculos]);
?>
