<!DOCTYPE html>
<html>

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <title>Proyecto Autolavado</title>
</head>

<body class="bg-blue-400/30">


  <div><?php echo $view_content; ?></div>
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
    $('#btnOpenAgregarEmpleado').click(function () {
        ventanaAgregarEmpleado.remplazarClases('right-0', 'right-[-35%]');
    })


    // Abrir o cerrar ventana para agregar vehiculos
    $('#btnCloseAgregarVehiculo').click(function () {
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
</body>
<style>
  body {
    overflow: hidden;
    user-select: none;
  }
  #completado li {
    opacity: 0.5;
  }
</style>

</html>