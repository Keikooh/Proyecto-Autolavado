<?php 
	session_start();
	require 'libreria/CrudEmpleado.php';
	require 'libreria/CrudVehiculo.php';
	require 'libreria/CobroTractoCamion.php';
	require 'libreria/CobroCamioneta.php';
	require 'libreria/CobroAutomovil.php';
	// Objetos.
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
		$c->Delete($_POST['btnEliminarEmpleado']);
	}

											//Codificación para el CRUD de los Vehiculos.
	// Para Insertar y Modificar.
	if(isset($_POST['txtPlaca'], $_POST['txtCliente'], $_POST['txtTipo'], $_POST['txtClasificacion'], $_POST['txtModelo'], $_POST['txtColorVehiculo'])) {
		$v->CreateUpdate(array($_POST['txtPlaca'], $_POST['txtCliente'], $_POST['txtTipo'], $_POST['txtClasificacion'], $_POST['txtModelo'], $_POST['txtColorVehiculo']));
	}
	// Para eliminar.
	if (isset($_POST['btnEliminarVehiculo']) && !isset($_POST['txtCliente'])) {
		$registro = $v->Delete($_POST['btnEliminarVehiculo']);
	}
	//Codificaión para finalizar con el lavado.
	if(isset($_POST['empleadoUno'], $_POST['empleadoDos'], $_POST['Placa'], $_POST['Observaciones'], $_POST['Tipo'])) {
		switch ($_POST['Tipo']) {
			case 'Automovil':
				$cobroAutomovil = new CobroAutomovil();
				$cobroAutomovil->Cobrar($_POST['empleadoUno'], $_POST['empleadoDos'], $_POST['Placa'], $_POST['Observaciones']);
				break;
			case 'Camioneta':
				$cobroCamioneta = new CobroCamioneta();
				$cobroCamioneta->Cobrar($_POST['empleadoUno'], $_POST['empleadoDos'], $_POST['Placa'], $_POST['Observaciones']);
				break;
			case 'Tracto Camion':
				$cobroTractoCamion = new CobroTractoCamion();
				$cobroTractoCamion->Cobrar($_POST['empleadoUno'], $_POST['empleadoDos'], $_POST['Placa'], $_POST['Observaciones']);
				break;
			default:
				echo "No se recibio Datos.<br>";
				break;
		}
	}

	
	view("Supervisor", ['empleados' => $empleados, 'vehiculos' => $vehiculos]);
?>
