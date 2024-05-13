<?php
    require 'config.php';
    require './libreria/accesodatos/AccesoDatosAdministrador.php';
    require_once('vendor/tcpdf/tcpdf.php');
    date_default_timezone_set('America/Monterrey');
    $accesoDatos = AccesoDatosAdministrador::obtenerInstancia();
    $resultado = '';
    $empleado = '';
    $respuesta=false; $historico=false;
    if (isset($_POST['txtBuscar'])) {
        $resultado = $accesoDatos->obtenerReportes(
            $_POST['txtFechaInicio'] == '' ? NULL : $_POST['txtFechaInicio'],
            $_POST['txtFechaFinal'] == '' ? NULL : $_POST['txtFechaFinal'],
            $_POST['txtBuscar'],
            (bool)$_POST['chkEmpleado'],
            (bool)$_POST['chkCliente'],
            (bool)$_POST['chkVehiculo']
        );
        $empleado = $accesoDatos->sueldoEmpleados(
        $_POST['txtFechaInicio'] == '' ? NULL : $_POST['txtFechaInicio'],
        $_POST['txtFechaFinal'] == '' ? NULL : $_POST['txtFechaFinal']);
    }
    //PDF DE REPORTES
    if (isset($_POST['tReportes'],$_POST['tEmpleados'])) {
        //Para las fechas...
        $fechaInicio = ($_POST['txtFechaInicio'] == '') ? NULL : $_POST['txtFechaInicio'];
        $fechaFinal = ($_POST['txtFechaFinal'] == '') ? NULL : $_POST['txtFechaFinal'];

        // Crear instancia de TCPDF con orientación horizontal
        $pdf = new TCPDF('L', 'mm', array(216, 330), true, 'UTF-8', false);
        // Agregar una página
        $pdf->AddPage();
        // Establecer el título del documento
        $pdf->SetFont('helvetica', 'B', 14);
        $titulo = 'REPORTE ORDINARIO DE LAVADOS Y PAGOS - ' . date('d/m/Y');
        $pdf->Cell(0, 10, $titulo, 0, 1, 'C');
        // Escribir en el PDF
        $pdf->SetFont('helvetica', 'B', 10);

        // Procesar los datos de la tabla de reportes
        $reportes = $_POST['tReportes'];
        if (!empty($reportes)) {
            $pdf->Ln();
            $titulo = 'Tabla de Reportes desde ' . ($fechaInicio = ($_POST['txtFechaInicio'] == '') ? date('Y-m-d') : $_POST['txtFechaInicio']) .' al '. ($fechaFinal = ($_POST['txtFechaFinal'] == '') ? date('Y-m-d') : $_POST['txtFechaFinal']);
            $pdf->Cell(0, 10, $titulo, 0, 1);
            // Agregar las etiquetas <th> para las columnas al inicio de la tabla
            $pdf->Cell(28, 10, 'Factura', 1, 0, 'C');
            $pdf->Cell(28, 10, 'Empleado 1', 1, 0, 'C');
            $pdf->Cell(28, 10, 'Empleado 2', 1, 0, 'C');
            $pdf->Cell(28, 10, 'Cliente', 1, 0, 'C');
            $pdf->Cell(27, 10, 'Placa', 1, 0, 'C');
            $pdf->Cell(28, 10, 'Tipo', 1, 0, 'C');
            $pdf->Cell(28, 10, 'Modelo', 1, 0, 'C');
            $pdf->Cell(27, 10, 'Color', 1, 0, 'C');
            $pdf->Cell(28, 10, 'Observaciones', 1, 0, 'C');
            $pdf->Cell(27, 10, 'Fecha', 1, 0, 'C');
            $pdf->Cell(28, 10, 'Costo', 1, 0, 'C');
            $pdf->Ln(); // Nueva línea después de las etiquetas <th>
            $pdf->SetFont('helvetica', '', 9);
            // Utilizar expresiones regulares para extraer datos de las celdas de todas las filas
            preg_match_all("/<tr[^>]*>(.*?)<\/tr>/s", $reportes, $matches);
            $rows = $matches[1];
            // Iterar sobre todas las filas y sus celdas y agregarlas al PDF
            foreach ($rows as $row) {
                preg_match_all("/<td[^>]*>(.*?)<\/td>/", $row, $cells);
                foreach ($cells[1] as $key => $cell) {
                    // Ajustar el ancho de las celdas correspondientes
                    $ancho_celda = ($key == 4 || $key == 7 || $key == 9) ? 27 : 28;
                    $pdf->Cell($ancho_celda, 10, trim($cell), 1, 0, 'J'); // 1 para bordes
                }
                $pdf->Ln(); // Nueva línea después de cada fila
            }
        }
        $pdf->SetFont('helvetica', 'B', 10);

        // Procesar los datos de la tabla de empleados
        $empleados = $_POST['tEmpleados'];
        if (!empty($empleados)) {
            $pdf->Ln();
            $titulo = 'Tabla de Empleados desde ' . ($fechaInicio = ($_POST['txtFechaInicio'] == '') ? date('Y-m-d') : $_POST['txtFechaInicio']) .' al '. ($fechaFinal = ($_POST['txtFechaFinal'] == '') ? date('Y-m-d') : $_POST['txtFechaFinal']);
            $pdf->Cell(0, 10, $titulo, 0, 1);
            // Agregar las etiquetas <th> para las columnas al inicio de la tabla
            $pdf->Cell(50, 10, 'Identificador', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Nombre del Empleado', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Cargo', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Ganancias Totales', 1, 0, 'C');
            $pdf->Ln(); // Nueva línea después de las etiquetas <th>
            // Utilizar expresiones regulares para extraer datos de las celdas de todas las filas
            preg_match_all("/<tr[^>]*>(.*?)<\/tr>/s", $empleados, $matches);
            $rows = $matches[1];
            $pdf->SetFont('helvetica', '', 9);
            // Iterar sobre todas las filas y sus celdas y agregarlas al PDF
            foreach ($rows as $row) {
                preg_match_all("/<td[^>]*>(.*?)<\/td>/", $row, $cells);
                foreach ($cells[1] as $cell) {
                    $pdf->Cell(50, 10, trim($cell), 1, 0, 'J'); // 1 para bordes
                }
                $pdf->Ln(); // Nueva línea después de cada fila
            }
        }
        $pdf->Ln();
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 10, 'Empleado del dia, número de lavados realizados y ganancias del dia.', 0, 1);
        $pdf->SetFont('helvetica', '', 12);
        //Empleado del dia, lavados y ganancias del dia.
        $pdf->Cell(0, 10, '- El empleado con mayor reconocimiento y desempeño laboral de la fecha ' . ($fechaInicio = ($_POST['txtFechaInicio'] == '') ? date('Y-m-d') : $_POST['txtFechaInicio']) . ' al ' . ($fechaFinal = ($_POST['txtFechaFinal'] == '') ? date('Y-m-d') : $_POST['txtFechaFinal']) . ' fue ' . $accesoDatos->obtenerEmpleadoDia($fechaInicio, $fechaFinal)[0]['nombre'] . ', participando en un total de ' . $accesoDatos->obtenerEmpleadoDia($fechaInicio, $fechaFinal)[0]['totalLavados'] . ' lavados.', 0, 1);
        $pdf->Cell(0, 10, '- El total de lavados efectuados de la fecha '.($fechaInicio = ($_POST['txtFechaInicio'] == '') ? date('Y-m-d') : $_POST['txtFechaInicio']).' al '.($fechaFinal = ($_POST['txtFechaFinal'] == '') ? date('Y-m-d') : $_POST['txtFechaFinal']).' fue de '.$accesoDatos->obtenerTotalLavados($fechaInicio, $fechaFinal).'.', 0, 1);
        $pdf->Cell(0, 10, '- El total de ganancias obtenidas de la fecha '.($fechaInicio = ($_POST['txtFechaInicio'] == '') ? date('Y-m-d') : $_POST['txtFechaInicio']).' al '.($fechaFinal = ($_POST['txtFechaFinal'] == '') ? date('Y-m-d') : $_POST['txtFechaFinal']).' fuerón de $'.$accesoDatos->obtenerGananciasDia($fechaInicio, $fechaFinal).'.', 0, 1);

        // Nombre del archivo PDF con marca de tiempo para evitar sobrescribir
        $nombreArchivo = 'Reporte_' . date('d-m-Y_H-i-s'). '.pdf';
        // Ruta donde se guardará el PDF
        $rutaPDF = 'C:/Users/gabri/Documents/Reportes/' . $nombreArchivo;
        // Salida del PDF como un archivo en la ruta especificada
        $pdf->Output($rutaPDF, 'F');
        $respuesta = true;
    }
    //PDF DE HISTORICOS
    if(isset($_POST['btnHis']) && $_POST['btnHis'] == true) {
        $historico=true;
        // Crear instancia de TCPDF con orientación vertical
        $pdf = new TCPDF('P', 'mm', array(216, 330), true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        // Agregar una página
        $pdf->AddPage();
        // Establecer el título del documento
        $pdf->SetFont('helvetica', 'B', 14);
        $titulo = 'REPORTE ORDINARIO DE HISTORICOS - ' . date('d/m/Y');
        $pdf->Cell(0, 10, $titulo, 0, 1, 'C');
        // Escribir en el PDF
        $pdf->SetFont('', '', 10); // Usar la fuente por defecto
        $pdf->SetFillColor(255, 255, 255); // Establecer el color de relleno a blanco
        $pdf->MultiCell(0, 10, $accesoDatos->Historico(), 0, 'J', false); // Ajustar el formato de la celda y quitar los bordes

        // Nombre del archivo PDF con marca de tiempo para evitar sobrescribir
        $nombreArchivo = 'Historico_' . date('d-m-Y_H-i-s'). '.pdf';
        // Ruta donde se guardará el PDF
        $rutaPDF = 'C:/Users/gabri/Documents/Reportes/Historicos/' . $nombreArchivo;
        // Salida del PDF como un archivo en la ruta especificada
        $pdf->Output($rutaPDF, 'F');
    }
    
    $response = array(
        'resultado' => trim($resultado),
        'empleado' => trim($empleado),
        'res'=>$respuesta,
        'his'=>$historico
    );
    echo json_encode($response);
?>