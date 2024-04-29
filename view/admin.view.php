<style>
    .square {
        width: 1100px;
        height: 600px;
        background-color: #E0E5FA;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
</head>

<body style="background-color: #C2C9EF;">

    <div class="flex flex-col my-9 gap-y-5 w-[93%] m-auto shadow-inner rounded-lg bg-white/70 p-10 rounded h-[90vh]">
        <nav>
            <div class="flex justify-between mb-4">
                <h1 class="text-[#001459] text-2xl font-bold">Reportes</h1>
                <span class="flex items-center gap-x-3 font-semibold">
                    Administrador
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M9 12h12l-3 -3" />
                            <path d="M18 15l3 -3" />
                        </svg>
                    </button>
                </span>
            </div>

            <ul class="flex flex-row gap-x-3 text-[#001459] font-semibold mt-4 mb-4">
                <li class="inline-block flex items-center">
                    <p class="bg-white rounded-3xl px-5 py-2 text-center shadow-lg">El empleado del día: <strong class="font-semibold"><?php echo $empleadoDia ?></strong></p>
                    <img class="h-10 w-10 mx-2" src="images/one.png" alt="Empleado No. 1">
                </li>
                <li class="inline-block flex items-center">
                    <p class="bg-white rounded-3xl px-5 py-2 text-center shadow-lg">Total de lavados: <strong class="font-semibold"><?php echo $total ?></strong></p>
                    <img class="h-10 w-10 mx-2" src="images/car.png" alt="Autos lavados">
                </li>
                <li class="inline-block flex items-center">
                    <p class="bg-white rounded-3xl px-5 py-2 text-center shadow-lg">Ganancias del día: <strong class="font-semibold">$<?php echo $ganancias ?></strong></p>
                    <img class="h-10 w-10 mx-2" src="images/money.png" alt="Dinero ganado">
                </li>
            </ul>
        </nav>
        <hr class="bg-color-white">

        <main>
            <form id="frmFiltrador" class="mb-8" action="admin" method="get">
                <div class="flex justify-between items-center">
                    <h2 class="text-[#001459] text-base font-bold mr-8">Lavados</h2>
                    <div class="flex items-center gap-x-3 text-[#001459] font-semibold mt-4 mb-4">
                        <button class="bg-white border border-gray-300 hover:bg-gray-100 text-[#001459] font-bold py-2 px-4 rounded-full shadow-lg flex items-center transition-colors duration-300 ease-in-out">
                            Generar reporte
                            <img class="h-8 w-8 ml-2" src="images/report.png" alt="Empleado No. 1">
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="chkCliente" id="chkCliente" class="appearance-none w-4 h-4 border border-gray-300 rounded checked:bg-blue-400 checked:border-transparent">
                        <label for="chkCliente" class="inline-block text-sm text-[#001459] cursor-pointer">Cliente</label>

                        <input type="checkbox" name="chkEmpleado" id="chkEmpleado" class="appearance-none w-4 h-4 border border-gray-300 rounded checked:bg-blue-400 checked:border-transparent">
                        <label for="chkEmpleado" class="inline-block text-sm text-[#001459] cursor-pointer">Empleado</label>

                        <input type="checkbox" name="chkVehiculo" id="chkVehiculo" class="appearance-none w-4 h-4 border border-gray-300 rounded checked:bg-blue-400 checked:border-transparent">
                        <label for="chkVehiculo" class="inline-block text-sm text-[#001459] cursor-pointer">Vehiculo</label>
                    </div>

                </div>
                <div class="flex mt-4 space-x-4">
                    <div class="relative w-1/4">
                        <input type="date" name="txtFechaInicio" id="txtFechaInicio" class="block w-full py-2 pl-3 pr-8 border border-gray-300 rounded-md bg-white focus:bg-white focus:outline-none focus:border-blue-400">
                        <label for="txtFechaInicio" class="absolute left-3 transition-all duration-300 ease-in-out -top-2 px-1 bg-white rounded-md text-gray-600 text-xs border border-gray-300">Fecha de Inicio</label>
                    </div>
                    <div class="relative w-1/4">
                        <input type="date" name="txtFechaFinal" id="txtFechaFinal" class="block w-full py-2 pl-3 pr-8 border border-gray-300 rounded-md bg-white focus:bg-white focus:outline-none focus:border-blue-400">
                        <label for="txtFechaFinal" class="absolute left-3 transition-all duration-300 ease-in-out -top-2 px-1 bg-white rounded-md text-gray-600 text-xs border border-gray-300">Fecha Final</label>
                    </div>
                    <div class="relative flex-1">
                        <input type="search" name="txtBuscar" id="txtBuscar" class="block w-full py-2 pl-3 pr-8 border border-gray-300 rounded-l-md rounded-r-none bg-white focus:bg-white focus:outline-none focus:border-blue-400">
                        <label for="txtBuscar" class="absolute left-3 transition-all duration-300 ease-in-out -top-2 px-1 bg-white rounded-md text-gray-600 text-xs border border-gray-300">Buscar</label>
                        <img src="images/search.png" alt="Busqueda" class="h-10 w-10 absolute right-0 top-1/2 transform -translate-y-1/2 mr-2">
                    </div>
                </div>
            </form>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Factura</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Placa</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Costo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php echo $resultado ?>
                </tbody>
            </table>

        </main>



        <script>
            $(document).ready(function() {
                $('#txtBuscar').on('input', function() {
                    // Envía el formulario
                    alert('Texto');
                });
                // Agrega un manejador de eventos change a todos los elementos de formulario dentro de #myForm
                $('#frmFiltrador :input').change(function() {
                    // Envía el formulario
                    alert('Texto');
                    //$('#frmFiltrador').submit();
                });
            });

            /*
            function uncheckOthers(id) {
                // Obtener todas las casillas de verificación
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');

                // Recorrer las casillas de verificación y desmarcar todas excepto la que se acaba de marcar
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.id !== id) {
                        checkbox.checked = false;
                    }
                });
            }*/
        </script>