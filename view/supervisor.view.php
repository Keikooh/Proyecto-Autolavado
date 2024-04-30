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
                <ul id="empleados"class="flex flex-col gap-y-5 bg-white h-[650px] rounded-2xl p-4 shadow-lg overflow-auto MostrarCARDS">

                    <!-- Ejemplos de tarjeta para empleado -->
                    <?php echo $empleados; ?>
                </ul>
            </div>

            <!-- Seccion de estaciones -->

            <!-- Estacion de lavado -->
            <div class="flex w-[25%] flex-col gap-y-5">
                <h3 class="text-[#001459] text-1xl font-semibold">Lavado<span class="textoLavado"></span></h3>
                <ul id="lavado"
                    class="sorteable estaciones flex flex-col gap-y-5 bg-white h-[650px] rounded-2xl p-4 shadow-lg overflow-auto lavado">
                    <!-- Ejemplos de tarjeta para vehiculo -->
                    <?php echo $vehiculos; ?>
                </ul>
            </div>
            <!-- Estacion de secado -->
            <div class="flex w-[25%] flex-col gap-y-5">
                <h3 class="text-[#001459] text-1xl font-semibold">Secado<span class="textoSecado"></span></h3>
                <ul id="secado"
                    class="sorteable estaciones flex flex-col gap-y-5 bg-white h-[650px] rounded-2xl p-4 shadow-lg overflow-auto secado">

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
                <label for="">Cargo</label>
                <select id="txtCargo" name="txtCargo"
                    class="block pl-3 pr-10 py-2 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option>Lavado</option>
                </select>
            </div>

            <!-- Turno -->
            <div class="relative z-0 w-full mb-5 group">
                <label for="">Turno</label>
                <select id="txtTurno" name="txtTurno"
                    class="block pl-3 pr-10 py-2 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option>Vespertino</option>
                    <option>Matutino</option>
                </select>
            </div>

            <!-- Salario -->
            <label for="">Salario</label>
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
                <select id="txtTipo" name="txtTipo" onchange="actualizarClasificacion(this.value)"
                        class="block pl-3 pr-10 py-2 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option value="Camioneta">Camioneta</option>
                    <option value="Automovil">Automóvil</option>
                    <option value="Tracto Camion">Tracto Camión</option>
                </select>
                </div>

            <!-- Clasificación -->
                <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="txtClasificacion" id="txtClasificacion"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                <label for="txtClasificacion"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Número de Puertas</label>
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
      },
      stop: function () {
        if($("#completado").sortable)
        {
            
        }
      },
    });

    // Cambios en los bordes al soltar las tarjetas de los empleados a las estaciones
    $(".estaciones").droppable({
        drop: function (event, ui) {
            var color = ui.draggable.find(".color").css("background-color");
            $(this).addClass("border-4").css("border-color", color);
            var nombreEmpleado = ui.draggable.find('#eNombre').text();
            var $textoSpan;
            
            if ($(this).hasClass("lavado")) {
            $textoSpan = $('.textoLavado');
            } else if ($(this).hasClass("secado")) {
            $textoSpan = $('.textoSecado');
            }
            
            // Eliminar el contenido actual del span
            $textoSpan.empty();
            
            // Agregar el nuevo texto al span y aplicarle el color del borde
            $("<span>").text(' Administrado por ' + nombreEmpleado).appendTo($textoSpan).css("color", color);
        }
    });

    //  EMPLEADO /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    let accion='agregar';
    let id;
    // Agregar
    $("#btnAgregarEmpleado").click(function () {
        event.preventDefault();
        const nombre = $('#txtNombreEmpleado').val();
        const color = $('#txtColor').val(); 
        const cargo = $('#txtCargo').val();
        const turno = $('#txtTurno').val();
        const salario = $('#txtSalario').val();
        if(accion==='agregar')
        {
            enviarDatosEmpleado(-1, nombre, color, cargo, turno, salario);
        }
        else if(accion==='modificar')
        {
            enviarDatosEmpleado(id, nombre, color, cargo, turno, salario);
            accion='agregar';
        }
        $('#txtNombreEmpleado').val('');
        $('#txtColor').val('');
        $('#txtCargo').val('');
        $('#txtTurno').val('');
        $('#txtSalario').val('');
    });

    // Modificar
    $(document).on('dblclick', '.Modificar', function() {
        ventanaAgregarEmpleado.remplazarClases('right-0', 'right-[-35%]');
        accion = 'modificar'; 
        id = $(this).data('id');
        const nombre = $(this).find('#eNombre').text();
        const color = $(this).find('#eColor').css('background-color');
        const cargo = $(this).find('#eCargo').text();
        const turno = $(this).find('#eTurno').text();
        const salario = $(this).find('#eSalario').text();
        // Asignar los valores a los campos del formulario
        $('#txtNombreEmpleado').val(nombre);
        $('#txtColor').val(tinycolor(color).toHexString());
        $('#txtCargo').val(cargo);
        $('#txtTurno').val(turno);
        $('#txtSalario').val(salario);
    });


    function enviarDatosEmpleado(id, nombre, color, cargo, turno, salario) {
        $.ajax({
            url: 'supervisor',
            method: 'POST',
            data: {
                btnEliminarEmpleado: id,
                txtNombreEmpleado: nombre,
                txtCargo: cargo,
                txtTurno: turno,
                txtSalario: salario,
                txtColor: color 
            },
            success: function (response) {
                if (accion === 'agregar') {
                    Swal.fire("Empleado Guardado / Modificado", "Empleado guardado / modificado exitosamente.", "success")
                    .then((result) => {
                        if (result.isConfirmed) {
                            Actualizar();
                        }
                    });
                } else if (accion === 'modificar') {
                    Swal.fire("Empleado Modificado / Guardado", "Empleado modificado / guardado exitosamente.", "success")
                    .then((result) => {
                        if (result.isConfirmed) {
                            Actualizar();
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                if (accion === 'agregar') {
                    Swal.fire("Error", "Hubo un problema al agregar el empleado", "error");
                } else {
                    Swal.fire("Error", "Hubo un problema al modificar el empleado", "error");
                }
            }
        });
    }

    //Eliminar
    $(document).ready(function() {
        $(document).on('click', '.btnEliminarEmpleado', function () {
            const id = $(this).data('id'); 
            Swal.fire({
                title: "¿Estás seguro de eliminar?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, elimínalo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la petición AJAX para eliminar al empleado
                    $.ajax({
                        url: "supervisor", // Ruta al controlador que maneja la eliminación
                        type: "POST",
                        data: { btnEliminarEmpleado: id }, // Aquí debes enviar el ID con una clave
                        success: function(response) {
                            // Eliminar al empleado de la lista si se elimina correctamente
                            if (response === "success") {
                                Swal.fire("Error", "Hubo un problema al eliminar el empleado", "error");
                            } else {
                                Swal.fire("¡Eliminado!", "Empleado eliminado", "success").then(() => {
                                    Actualizar();
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire("Error", "Hubo un problema al eliminar el empleado", "error");
                        }
                    });
                }
            });
        });
    });

    //  VEHICULO /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //Para el cambio de tipo.
    $('#txtTipo').change(function() {
        const tipoVehiculo = $('#txtTipo').val();
        const inputClasificacion = $('#txtClasificacion');
        const labelClasificacion = $('#txtClasificacion + label');

        if (tipoVehiculo === 'Automovil') {
            inputClasificacion.val('No Aplica en Automóviles');
            inputClasificacion.prop('disabled', true);
        } 
        else {
            inputClasificacion.prop('disabled', false);
        }
        if (tipoVehiculo === 'Tracto Camion') {
            inputClasificacion.val('');
            labelClasificacion.text('Dimensión del Tracto Camión');
        } 
        else if (tipoVehiculo === 'Camioneta') {
            inputClasificacion.val('');
            labelClasificacion.text('Número de Puertas');
        } 
        else {
            labelClasificacion.text('Clasificación');
        }
    });

    // Agregar
    $("#btnAgregarVehiculo").click(function () {
        event.preventDefault();
        const placa = $('#txtPlaca').val();
        const cliente = $('#txtCliente').val();
        let clasificacion='';
        if ($('#txtTipo').val() === 'Automovil') {
            clasificacion = '0';
        } else{
            clasificacion = $('#txtClasificacion').val();
        }
        alert(clasificacion);
        const tipo = $('#txtTipo').val();
        const modelo = $('#txtModelo').val();
        const color = $('#txtColorVehiculo').val(); 
        if(accion==='agregar')
        {
            enviarDatosVehiculo(placa, cliente,tipo, clasificacion, modelo, color);
        }
        else if(accion==='modificar')
        {
            enviarDatosVehiculo(placa, cliente,tipo, clasificacion, modelo, color);
            accion='agregar';
        }
        $('#txtPlaca').val('');
        $('#txtCliente').val('');
        $('#txtTipo').val('');
        $('#txtClasificacion').val('');
        $('#txtModelo').val('');
        $('#txtColorVehiculo').val('');
    });

    // Modificar
    $(document).on('dblclick', '.Modificar', function() {
        ventanaAgregarVehiculo.remplazarClases('right-0', 'right-[-35%]');
        accion = 'modificar'; 
        const placa =$(this).find('#ePlaca').text();
        const cliente = $(this).find('#eCliente').text();
        const tipo = $(this).find('#eTipo').text();
        const clasificacion = $(this).find('#eClasificacion').text();
        const modelo = $(this).find('#eModelo').text();
        const color = $(this).find('#eColorVehiculo').text();
        // Asignar los valores a los campos del formulario
        $('#txtPlaca').val(placa);
        $('#txtPlaca').prop('disabled', true);
        $('#txtCliente').val(cliente);
        $('#txtTipo').val(tipo);
        $('#txtClasificacion').val(clasificacion);
        $('#txtModelo').val(modelo);
        $('#txtColorVehiculo').val(color);
    });


    function enviarDatosVehiculo(placa, cliente,tipo, clasificacion, modelo, color) {
        $.ajax({
            url: 'supervisor',
            method: 'POST',
            data: {
                txtPlaca: placa,
                txtCliente: cliente,
                txtTipo: tipo,
                txtClasificacion: clasificacion,
                txtModelo: modelo,
                txtColorVehiculo: color 
            },
            success: function (response) {
                if (accion === 'agregar') {
                    Swal.fire("Vehiculo Guardado / Modificado", "Vehiculo Guardado / Modificado exitosamente.", "success")
                    .then((result) => {
                        if (result.isConfirmed) {
                            Actualizar();
                        }
                    });
                } else if (accion === 'modificar') {
                    Swal.fire("Vehiculo Guardado / Modificado", "Vehiculo Guardado / Modificado exitosamente.", "success")
                    .then((result) => {
                        if (result.isConfirmed) {
                            Actualizar();
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                if (accion === 'agregar') {
                    Swal.fire("Error", "Hubo un problema al agregar el vehiculo", "error");
                } else {
                    Swal.fire("Error", "Hubo un problema al modificar el vehiculo", "error");
                }
            }
        });
    }

    //Eliminar
    $(document).ready(function() {
        $(document).on('click', '.btnEliminarVehiculo', function () {
            const id = $(this).data('id'); 
            Swal.fire({
                title: "¿Estás seguro de eliminar?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, elimínalo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "supervisor",
                        type: "POST",
                        data: { btnEliminarVehiculo: id },
                        success: function(response) {
                            if (response === "success") {
                                Swal.fire("Error", "Hubo un problema al eliminar el vehiculo", "error");
                            } else {
                                Swal.fire("¡Eliminado!", "Vehiculo eliminado", "success").then(() => {
                                    Actualizar();
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire("Error", "Hubo un problema al eliminar el vehiculo", "error");
                        }
                    });
                }
            });
        });
    });

    //Actualizar.
    function Actualizar() {
      location.reload(true);
    }
  </script>