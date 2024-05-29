<?php 
	require_once 'libreria/CrudEmpleado.php';
	require_once 'libreria/CrudVehiculo.php';

	require_once 'libreria/CobroFactory.php';
	// Objetos.
	$c = new CrudEmpleado();
	$v = new CrudVehiculo();
	$empleados = $c->Read();
	$vehiculos = $v->Read();

	$factory = CobroFactory::getInstance();

	//Sesion...
	if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'Supervisor') {
		controller('login');
		exit;
	}
	
	// Cerrar sesión
	if(isset($_POST['cerrar_sesion'])) {
		session_unset();
		session_destroy();
		controller('login');
		exit;
	}

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
				$cobro = $factory->Facturar(Vehiculos::Automovil);
				break;
			case 'Camioneta':
				$cobro = $factory->Facturar(Vehiculos::Camioneta);
				break;
			case 'Tracto Camion':
				$cobro = $factory->Facturar(Vehiculos::TractoCamion);
				break;
			default:
				echo "No se recibio Datos.<br>";
				break;
		}

		$cobro->Cobrar($_POST['empleadoUno'], $_POST['empleadoDos'], $_POST['Placa'], $_POST['Observaciones']);
	}

	
	view("Supervisor", ['empleados' => $empleados, 'vehiculos' => $vehiculos]);
?>