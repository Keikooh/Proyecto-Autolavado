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

<section>
    <div class="square rounded-lg shadow-2xl">    
        <div>
            <div>
                <div class="text-right mr-12 mt-6 mb-2 text-base text-[#001459]"><strong>Administrador</strong></div>
                <div class="ml-10 mt-15 text-2xl text-[#001459]"><strong>Reportes</strong></div>
                <div class="flex">
                    <div class="ml-10 text-xs badge rounded-full bg-white w-40 h-8 text-black shadow-2xl flex items-center mt-3">
                        <strong class="flex-grow text-center">Empleado del dia: Pedro</strong>
                    </div>
                    <div class="ml-10 text-xs badge rounded-full bg-white w-40 h-8 text-black shadow-2xl flex items-center mt-3">
                        <strong class="flex-grow text-center">Total de lavado: 13</strong>
                    </div>
                    <div class="ml-10 text-xs badge rounded-full bg-white w-40 h-8 text-black shadow-2xl flex items-center mt-3">
                        <strong class="flex-grow text-center">Genancias del dia: $715.0</strong>
                    </div>
                </div>

                <hr class="bg-color-white">


                
                <div class="ml-10 mt-10 text-base text-[#001459] mr-10">
                    <div class="flex justify-between items-center">
                        <strong>Lavados</strong>
                        <div class="flex mr-15">
                            <div class="flex items-center me-4">
                                <input id="inline-checkbox" type="checkbox" value="cliente" class="w-4 h-4 text-blue-600 bg-white border-gray-300 " onclick="uncheckOthers('inline-checkbox')">
                                <label for="inline-checkbox" class="ms-2 text-sm font-medium text-gray-900">Cliente</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="inline-2-checkbox" type="checkbox" value="empleado" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 " onclick="uncheckOthers('inline-2-checkbox')">
                                <label for="inline-2-checkbox" class="ms-2 text-sm font-medium text-gray-900">Empleado</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input checked id="inline-checked-checkbox" type="checkbox" value="vehiculo" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 " onclick="uncheckOthers('inline-checked-checkbox')">
                                <label for="inline-checked-checkbox" class="ms-2 text-sm font-medium text-gray-900">Vehiculo</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ml-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <div class="mt-2 flex flex-row space-x-2">
                            <div class="flex rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 flex-2">
                                <input type="text" name="fechaInicio" id="fechaInicio" autocomplete="Fecha de Inicio" class="rounded-lg border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 w-full sm:text-sm sm:leading-6" placeholder="Fecha de Inicio">
                            </div>
                            <div class="flex rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 flex-2">
                                <input type="text" name="fechaFinal" id="fechaFinal" autocomplete="Fecha Final" class="rounded-lg border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 w-full sm:text-sm sm:leading-6" placeholder="Fecha Final">
                            </div>
                            <div class="flex rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 flex-1">
                                <input type="text" name="empleado" id="empleado" autocomplete="Empleado" class="rounded-lg border-0 bg-white py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 w-full sm:text-sm sm:leading-6" placeholder="Empleado">
                            </div>
                        </div>
                    </div>
                </div>
                
                
                

                <div class="relative overflow-x-auto ml-10 mr-10 mt-5">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Empleado
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fecha Inicio
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fecha Final
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Gabriel Chaires
                                </th>
                                <td class="px-6 py-4">
                                    25 abril
                                </td>
                                <td class="px-6 py-4">
                                    26 abril
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Jared Alonso
                                </th>
                                <td class="px-6 py-4">
                                    24 abril
                                </td>
                                <td class="px-6 py-4">
                                    25 abril
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                    


            </div>
        </div>
    </div>
</section> 



<script>
    function uncheckOthers(id) {
        // Obtener todas las casillas de verificación
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        // Recorrer las casillas de verificación y desmarcar todas excepto la que se acaba de marcar
        checkboxes.forEach(function(checkbox) {
            if (checkbox.id !== id) {
                checkbox.checked = false;
            }
        });
    }
</script>