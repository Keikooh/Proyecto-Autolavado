<div>
    <!-- Seccion principal del dashboard ================================================================================================================= -->
    <div class="flex flex-col my-9 gap-y-5 w-[93%] m-auto shadow-inner rounded-lg bg-white/70 p-10 rounded h-[90vh]">

        <!-- Navbar -->
        <nav class="flex flex-col gap-y-3">
            <div class="flex justify-between">
                <h1 class="text-[#001459] text-2xl font-bold">Dashboard</h1>
                <span class="flex items-center gap-x-3 font-semibold">
                    Supervisor

                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="22"
                            height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M9 12h12l-3 -3" />
                            <path d="M18 15l3 -3" />
                        </svg>
                    </button>
                </span>
            </div>
            <div class="flex flex-row gap-x-3 text-[#001459] font-semibold">
                <button id="btnOpenAgregarEmpleado" class="bg-white rounded-xl px-5 py-2 text-center shadow-lg">Empleado
                    +</button>
                <button id="btnOpenAgregarVehiculo" class="bg-white rounded-xl px-5 py-2 text-center shadow-lg">Vehículo
                    +</button>
            </div>
        </nav>

        <hr class="h-2 bg-black" />

        <!-- Seccion principal para mover las tarjetas  -->
        <main class="flex justify-between gap-x-5 h-full">

            <!-- Seccion de empleados -->
            <div class="flex w-[25%] flex-col gap-y-5">
                <h3 class="text-[#001459] text-1xl font-semibold">Empleado</h3>
                <ul id="empleados"
                    class="flex flex-col gap-y-5 bg-white h-[650px] rounded-2xl p-4 shadow-lg overflow-auto">

                    <!-- Ejemplos de tarjeta para empleado -->

                    <li class="flex items-center gap-x-3 p-4 bg-[#E5E4EE] rounded-xl">
                        <div class="color bg-indigo-400 size-5 rounded-full"></div>
                        <div class="w-[90%]">
                            <div class="flex  justify-between">
                                <!-- Nombre del empleado -->
                                <h3 class="lblEmpleado text-[#001459] font-bold">Chaires Lira</h3>
                                <button class="btnEliminarEmpleado">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                        width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Rol -->
                            <p class="text-black/35 font-semibold text-sm">
                                Encargado de lavado
                            </p>
                            <!-- Turno -->
                            <p class="text-black/35 font-semibold text-sm">
                                Turno matutino
                            </p>
                        </div>
                    </li>
                    <li class="flex items-center gap-x-3 p-4 bg-[#E5E4EE] rounded-xl">
                        <div class="color bg-yellow-400 size-5 rounded-full"></div>
                        <div class="w-[90%]">
                            <div class="flex  justify-between">
                                <!-- Nombre del empleado -->
                                <h3 class="lblEmpleado text-[#001459] font-bold">Juan Miguel</h3>
                                <button class="btnEliminarEmpleado">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                        width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Rol -->
                            <p class="text-black/35 font-semibold text-sm">
                                Encargado de lavado
                            </p>
                            <!-- Turno -->
                            <p class="text-black/35 font-semibold text-sm">
                                Turno matutino
                            </p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Seccion de estaciones -->

            <!-- Estacion de lavado -->
            <div class="flex w-[25%] flex-col gap-y-5">
                <h3 class="text-[#001459] text-1xl font-semibold">Lavado</h3>
                <ul id="lavado"
                    class="sorteable estaciones flex flex-col gap-y-5 bg-white h-[650px] rounded-2xl p-4 shadow-lg overflow-auto">

                    <!-- Ejemplo de card para vehiculo -->
                    <li class="flex items-center justify-between p-4 bg-[#E5E4EE] rounded-xl">
                        <div>
                            <!-- Cliente -->
                            <h3 class="text-[#001459] font-bold">Sofía Martínez</h3>
                            <div class="flex gap-x-2 items-center opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ad-filled"
                                    width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M19 4h-14a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-10a3 3 0 0 0 -3 -3zm-10 4a3 3 0 0 1 2.995 2.824l.005 .176v4a1 1 0 0 1 -1.993 .117l-.007 -.117v-1h-2v1a1 1 0 0 1 -1.993 .117l-.007 -.117v-4a3 3 0 0 1 3 -3zm0 2a1 1 0 0 0 -.993 .883l-.007 .117v1h2v-1a1 1 0 0 0 -1 -1zm8 -2a1 1 0 0 1 .993 .883l.007 .117v6a1 1 0 0 1 -.883 .993l-.117 .007h-1.5a2.5 2.5 0 1 1 .326 -4.979l.174 .029v-2.05a1 1 0 0 1 .883 -.993l.117 -.007zm-1.41 5.008l-.09 -.008a.5 .5 0 0 0 -.09 .992l.09 .008h.5v-.5l-.008 -.09a.5 .5 0 0 0 -.318 -.379l-.084 -.023z"
                                        stroke-width="0" fill="currentColor" />
                                </svg>
                                <!-- Placa -->
                                <span class="font-semibold text-sm">JKC-34D-D1</span>
                            </div>
                            <p class="text-black/35 font-semibold text-sm">
                                <!-- Modelo -->
                                Land Rover Discovery
                            </p>
                            <p class="text-black/35 text-sm">
                                <!-- Marca -->
                                SD6 306 HSE
                            </p>
                        </div>

                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots" width="22"
                                height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- Estacion de secado -->
            <div class="flex w-[25%] flex-col gap-y-5">
                <h3 class="text-[#001459] text-1xl font-semibold">Secado</h3>
                <ul id="secado"
                    class="sorteable estaciones flex flex-col gap-y-5 bg-white h-[650px] rounded-2xl p-4 shadow-lg overflow-auto">

                </ul>
            </div>

            <!-- Estacion de completado -->
            <div class="flex w-[25%] flex-col gap-y-5">
                <h3 class="text-[#001459] text-1xl font-semibold">Completado</h3>
                <ul id="completado"
                    class="sorteable flex flex-col gap-y-5 bg-white h-[650px] rounded-2xl p-4 shadow-lg overflow-auto border-dashed border-2 border-green-400">

                </ul>
            </div>
        </main>
    </div>

    <!-- Seccion de barras laterales desplegables ================================================================================================================= -->

    <!-- Barra lateral para agregar empleados -->
    <div id="frmAgregarEmpleado"
        class="absolute bg-white w-[500px] shadow-lg p-10 h-screen top-0 right-[-35%] ease-out duration-500">
        <div class="flex items-center gap-x-3">
            <button id="btnCloseAgregarEmpleado">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left"
                    width="25" height="25" viewBox="0 0 24 24" stroke-width="2" stroke="#001459" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l4 4" />
                    <path d="M5 12l4 -4" />
                </svg>
            </button>
            <h1 class="text-[#001459] font-semibold text-xl">Agregar empleado</h1>
        </div>

        <form class="max-w-md mt-10 mx-auto font-semibold">

            <!-- Nombre -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="txtNombreEmpleado" id="txtNombreEmpleado" class="
                        block
                        py-2.5
                        px-0
                        w-full
                        text-sm
                        text-gray-900
                        bg-transparent
                        border-0 border-b-2
                        border-gray-300
                        appearance-none
                        focus:outline-none
                        focus:ring-0
                        focus:border-[#6C95FF]
                        peer" placeholder="" required />
                <label for="txtNombreEmpleado" class="
                        peer-focus:font-medium
                        absolute
                        text-sm
                        bg-white
                        text-gray-500
                        duration-300
                        transform
                        -translate-y-6
                        scale-75
                        top-3
                        -z-10
                        origin-[0]
                        peer-focus:start-0
                        rtl:peer-focus:translate-x-1/4
                        peer-focus:text-[#6C95FF]
                        peer-placeholder-shown:scale-100
                        peer-placeholder-shown:translate-y-0
                        peer-focus:scale-75
                        peer-focus:-translate-y-6">
                    Nombre completo
                </label>
            </div>

            <!-- Cargo -->
            <div class="relative z-0 w-full mb-5 group">
                <select id="txtCargo" name="txtCargo"
                    class="block pl-3 pr-10 py-2 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option>Lavado</option>
                </select>
            </div>

            <!-- Turno -->
            <div class="relative z-0 w-full mb-5 group">
                <select id="txtTurno" name="txtTurno"
                    class="block pl-3 pr-10 py-2 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option>Vespertino</option>
                    <option>Matutino</option>
                </select>
            </div>

            <!-- Salario -->
            <div class="relative z-0 w-full mb-5 group">
                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin" width="22"
                        height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                        <path d="M12 7v10" />
                    </svg>
                </div>
                <input type="number" id="txtSalario" name="txtSalario" min="1"
                    class="block p-2.5 w-full z-20 ps-10 text-sm text-gray-900 bg-gray-50 rounded-s-lg border-e-gray-50 border-e-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                    placeholder="0.00" required />
            </div>

            <label for="">Color</label>
            <div class="relative z-0 w-full mb-5 group">
                <input type="color" name="txtColor" id="txtColor" class="" placeholder="" required />
            </div>

            <button id="btnAgregarEmpleado"
                class="bg-[#6C95FF] text-white font-semibold w-full text-sm py-3 rounded-xl">
                Agregar
            </button>

        </form>

    </div>

    <!-- Barra lateral para agregar vehiculos -->
    <div id="frmAgregarVehiculo"
        class="absolute bg-white w-[500px] shadow-lg p-10 h-screen top-0 right-[-35%] ease-out duration-500">
        <div class="flex items-center gap-x-10">
            <button id="btnCloseAgregarVehiculo">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left"
                    width="35" height="35" viewBox="0 0 24 24" stroke-width="2" stroke="#2c3e50" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l4 4" />
                    <path d="M5 12l4 -4" />
                </svg>


            </button>

            <h1 class="text-[#001459] font-semibold text-xl">Agregar vehiculo</h1>
        </div>

        <form class="max-w-md mt-10 mx-auto">
            <!-- Cliente -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text"
                    name="txtCliente"
                    id="txtCliente"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="txtCliente"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Cliente</label>
            </div>

            <!-- Placa -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text"
                    name="txtPlaca"
                    id="txtPlaca"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="txtPlaca"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Placa</label>
            </div>

            <!-- Tipo -->
            <div class="relative z-0 w-full mb-5 group">
                <label for="txtTipo">Tipo de vehículo</label>
                <select
                    id="txtTipo"
                    name="txtTipo"
                    class="block pl-3 pr-10 py-2 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option>Automóvil</option>
                    <option>Camión</option>
                    <option>Motocicleta</option>
                </select>
            </div>

            <!-- Modelo -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text"
                    name="txtModelo"
                    id="txtModelo"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="txtModelo"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Modelo</label>
            </div>

             <!-- Marca -->
             <div class="relative z-0 w-full mb-5 group">
                <input type="text"
                    name="txtMarca"
                    id="txtMarca"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="txtMarca"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Marca</label>
            </div>

            <!-- Color -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text"
                    name="txtColorVehiculo"
                    id="txtColorVehiculo"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="txtColorVehiculo"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Color del vehículo</label>
            </div>

            <button id="btnAgregarVehiculo"
                class="bg-[#6C95FF] text-white font-semibold w-full text-sm py-3 rounded-xl">
                Agregar
            </button>
        </form>
    </div>
</div>
<script>  
    // Componentes
    const ventanaAgregarEmpleado = $('#frmAgregarEmpleado');
    const ventanaAgregarVehiculo = $('#frmAgregarVehiculo');

    // Funcion para remplazar clases
    (function ($) {
      $.fn.remplazarClases = function (prevClass, nextClass) {
        if (this.hasClass(prevClass)) {
          return this.removeClass(prevClass).addClass(nextClass);
        } else return this.addClass(prevClass).removeClass(nextClass);
      };
    }(jQuery));

    // Abrir o cerrar ventana para agregar empleados
    $('#btnCloseAgregarEmpleado').click(function () {
        ventanaAgregarEmpleado.remplazarClases('right-0', 'right-[-35%]');
    });
    $('#btnAgregarEmpleado').click(function () {
        
        ventanaAgregarEmpleado.remplazarClases('right-0', 'right-[-35%]');
    });
    $('#btnOpenAgregarEmpleado').click(function () {
        ventanaAgregarEmpleado.remplazarClases('right-0', 'right-[-35%]');
    })


    // Abrir o cerrar ventana para agregar vehiculos
    $('#btnCloseAgregarVehiculo').click(function () {
        ventanaAgregarVehiculo.remplazarClases('right-0', 'right-[-35%]');
    });
    $('#btnAgregarVehiculo').click(function () {
        ventanaAgregarVehiculo.remplazarClases('right-0', 'right-[-35%]');
    });
    $('#btnOpenAgregarVehiculo').click(function () {
        ventanaAgregarVehiculo.remplazarClases('right-0', 'right-[-35%]');
    })

    // Tarjetas de empleados arrastrables
    $(document).on('mouseover', '#empleados li', function () {
      $(this).draggable({
        revert: "invalid",
        cursor: "move",
        helper: "clone",
        zIndex: 1000
      });
    });

    //Listas sorteables
    $("#lavado, #secado, #completado").sortable({
      connectWith: ".sorteable",
      placeholder: "w-full h-[120px] bg-gray-200/50 rounded-xl",
      start: function () {
        // Cuando se comienza el proceso de arrastrado
        alert("Comienza");
      },
      stop: function () {
        // Cuando se suelta el item que está siendo arrastrado
        alert("Termina");
      },
    });

    // Cambios en los bordes al soltar las tarjetas de los empleados a las estaciones
    $(".estaciones").droppable({
      drop: function (event, ui) {
        var color = ui.draggable.find(".color").css("background-color");
        $(this).addClass("border-4").css("border-color", color);
      }
    });
    //  EMPLEADO /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Agregar
    $("#btnAgregarEmpleado").click(function () {
      event.preventDefault();
      const nombre = $('#txtNombreEmpleado').val();
      const color = $('#txtColor').val()
      const cargo = $('#txtCargo').val();
      const turno = $('#txtTurno').val();
      const salario = $('#txtSalario').val();

      /* 
        Logica para agregar empleados a la base de datos
      */

      // Se agrega empleados a la lista
      $('#empleados').append(`
        <li id="${Math.random()}" class="flex items-center gap-x-3 p-4 bg-[#E5E4EE] rounded-xl">
          <div class="color size-5 rounded-full" style="background: ${color}"></div>
            <div class="w-[90%]">
              <div class="flex  justify-between">
              <h3 class="lblEmpleado text-[#001459] font-bold">${nombre}</h3>
              <button class="btnEliminarEmpleado">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                      width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M18 6l-12 12" />
                      <path d="M6 6l12 12" />
                  </svg>
              </button>
            </div>
            <p class="text-black/35 font-semibold text-sm">
                ${cargo}
            </p>
            <p class="text-black/35 font-semibold text-sm">
                ${turno}
            </p>
          </div>
        </li>`);
    })

    // Eliminar
    $(document).on('click', '.btnEliminarEmpleado', function () {
      Swal.fire({
        title: `¿Estás seguro de eliminar?`,
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, elimínalo!"
      }).then((result) => {
        if (result.isConfirmed) {

          // Eliminar al empleado de la lista
          $(this).parent().parent().parent().remove();

          /* 
            Logica para eliminar empleados de la base de datos
          */

          Swal.fire({
            title: "¡Eliminado!",
            text: "Empleado eliminado",
            icon: "success"
          });
        }
      });
    });

    //  VEHICULO /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Agregar
    $("#btnAgregarVehiculo").click(function () {
      event.preventDefault();
      const cliente = $('#txtCliente').val();
      const placa = $('#txtPlaca').val()
      const tipo = $('#txtTipo').val();
      const modelo = $('#txtModelo').val();
      const marca = $('#txtMarca').val();
      const colorVehiculo = $('#txtColorVehiculo').val();
      /* 
        Logica para agregar empleados a la base de datos
      */

      // Se agrega vehiculos a la primera estacion "LAVADO"
      $('#lavado').append(`
      <li class="flex items-center justify-between p-4 bg-[#E5E4EE] rounded-xl">
        <div>
            <h3 class="text-[#001459] font-bold">${cliente}</h3>
            <div class="flex gap-x-2 items-center opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ad-filled"
                    width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M19 4h-14a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-10a3 3 0 0 0 -3 -3zm-10 4a3 3 0 0 1 2.995 2.824l.005 .176v4a1 1 0 0 1 -1.993 .117l-.007 -.117v-1h-2v1a1 1 0 0 1 -1.993 .117l-.007 -.117v-4a3 3 0 0 1 3 -3zm0 2a1 1 0 0 0 -.993 .883l-.007 .117v1h2v-1a1 1 0 0 0 -1 -1zm8 -2a1 1 0 0 1 .993 .883l.007 .117v6a1 1 0 0 1 -.883 .993l-.117 .007h-1.5a2.5 2.5 0 1 1 .326 -4.979l.174 .029v-2.05a1 1 0 0 1 .883 -.993l.117 -.007zm-1.41 5.008l-.09 -.008a.5 .5 0 0 0 -.09 .992l.09 .008h.5v-.5l-.008 -.09a.5 .5 0 0 0 -.318 -.379l-.084 -.023z"
                        stroke-width="0" fill="currentColor" />
                </svg>
                <span class="font-semibold text-sm">${placa}</span>
            </div>
            <p class="text-black/35 font-semibold text-sm">
              ${modelo}
            </p>
            <p class="text-black/35 text-sm">
                ${marca}
            </p>
        </div>

        <button>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots" width="22"
                height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
            </svg>
        </button>
    </li>`);
    })

  </script>