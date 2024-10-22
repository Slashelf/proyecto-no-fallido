@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container px-5">
        <div class="row d-flex flex-column align-items-center justify-content-center">
            <div class="col d-flex flex-column align-items-start justify-content-center" id="cabecera">
                <h1>
                    <img src="{{asset('images/postgrado.webp')}}" alt="postgrado imagen" width="70" >
                    Gestión de Universidades
                </h1>
                <div class="w-full d-flex justify-content-center align-items-center">
                    <span>
                        Bienvenido al administrador de universidades de Bolivia
                    </span>
                    <button class="Btn ml-2"  data-toggle="modal" data-target="#modalPurple" onclick="modalresetearformulario()">
                        <div class="svgWrapper">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 42 42"
                                class="svgIcon"
                            >
                                <rect
                                    x="19"
                                    y="9"
                                    width="4"
                                    height="24"
                                    fill="none"
                                    stroke="#fff"
                                    stroke-width="3"
                                ></rect>
                                <rect
                                    x="9"
                                    y="19"
                                    width="24"
                                    height="4"
                                    fill="none"
                                    stroke="#fff"
                                    stroke-width="3"
                                ></rect>
                            </svg>

                            <div class="text">Agregar Universidades</div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="fondo">
    </div>
    <div class="container">
        <x-adminlte-modal id="modalPurple" title="Formulario de Universidad" theme="red" icon="fas fa-university" size='lg'>
            <form id="formulario">
                <label for="universidad">Nombre de la universidad</label>
                <input type="text" name="universidad" placeholder="Ingresa la Universidad" id="universidad" class="form-control" required>
                <label for="departamento" class="mt-4">Selecciona el departamento al que pertenece</label>
                <input type="hidden" name="idUniversidad" id="idUniversidad">
                <select id="departamento" name="departamento" required>
                    <option value="LP">LA PAZ</option>
                    <option value="SCZ">SANTA CRUZ</option>
                    <option value="CBBA">COCHABAMBA</option>
                    <option value="OR">ORURO</option>
                    <option value="PT">POTOSÍ</option>
                    <option value="CH">CHUQUISACA</option>
                    <option value="TJA">TARIJA</option>
                    <option value="BE">BENI</option>
                    <option value="PD">PANDO</option>
                    <option value="EX">EXTRANJERO</option>
                </select>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" theme="success" onclick="enviar()" label="Guardar"/>
                    <x-adminlte-button theme="danger" label="Cerrar" data-dismiss="modal" id="cerrar"/>
                </x-slot>
            </form>
        </x-adminlte-modal>

        <div class="container table-responsive pb-4 px-4 mt-4">
            <table id="tabla" class="table table-bordered table-striped">
                <thead class="bg-danger" style="opacity: 0.9;">
                    <tr>
                        <th>Universidad</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="fondodecuerpotabla">
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <!--PACE-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <!--DATATABLES-->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.2/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.4/datatables.min.css" rel="stylesheet">
    <!--SELECT2-->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <style>
        /* Cambiar el color de fondo del elemento seleccionado */
        .selectize-dropdown .active {
            background-color: #a50000 !important; /* Color de selección personalizado */
            color: #ffffff !important; /* Color del texto del elemento seleccionado */
        }

        .selectize-dropdown .selected {
            background-color: #003aa5 !important; /* Color de selección personalizado */
            color: #ffffff !important; /* Color del texto del elemento seleccionado */
        }
        .pace {
            -webkit-pointer-events: none;
            pointer-events: none;

            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .pace-inactive {
            display: none;
        }

        .pace .pace-progress {
            background: #a80000;
            position: fixed;
            z-index: 2000;
            top: 0;
            right: 100%;
            width: 100%;
            height: 2px;
        }
    </style>

    <style>
        /*BOTON DE AGREGAR*/
        .Btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition-duration: 0.3s;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
            background: #45a247;
        }

        /* plus sign */
        .svgWrapper {
            width: 100%;
            transition-duration: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .svgIcon {
            width: 17px;
        }

        /* text */
        .text {
            position: absolute;
            right: 0%;
            width: 0%;
            opacity: 0;
            color: white;
            font-size: 1.2em;
            font-weight: 600;
            transition-duration: 0.3s;
        }
        /* hover effect on button width */
        .Btn:hover {
            width: 125px;
            border-radius: 40px;
            transition-duration: 0.3s;
        }

        .Btn:hover .svgWrapper {
            width: 30%;
            transition-duration: 0.3s;
        }
        /* hover effect button's text */
        .Btn:hover .text {
            opacity: 1;
            width: 70%;
            transition-duration: 0.3s;
            padding-right: 10px;
            font-size: .7rem;
        }
        /* button click effect*/
        .Btn:active {
            transform: translate(2px, 2px);
        }

    </style>

    <style>
        /*fondo*/

        .fondo{
            position: fixed;
            top: 20%;
            left: 25%; /* Centra el contenedor horizontal y verticalmente */
            width: 70%; 
            height: 70%; /* Puedes ajustar este valor según tus necesidades */
            background-image: url("{{ asset('images/postgrado.webp') }}");
            background-size: contain; /* Mantiene las proporciones de la imagen */
            background-repeat: no-repeat;
            background-position: center;
            z-index: 0;
            opacity: 0.3;
        }

        .fondodecuerpotabla{
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            opacity: 0.88;
        }

        #cabecera{
            z-index: 10;
            border-radius: 1rem;
            background: #141E30;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #243B55, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #243B55, #141E30); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: white;
            padding: 25px;
            opacity: .9;
        }
    </style>

    <style>
        .button {
        width: 50px;
        height: 50px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(44, 44, 44);
        border-radius: 50%;
        cursor: pointer;
        transition-duration: .3s;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.13);
        border: none;
        }

        .bell {
        width: 18px;
        }

        .bell path {
        fill: white;
        }

        .button:hover {
        background-color: rgb(56, 56, 56);
        }

        .button:hover .bell {
        animation: bellRing 0.9s both;
        }

        /* bell ringing animation keyframes*/
        @keyframes bellRing {
        0%,
        100% {
            transform-origin: top;
        }

        15% {
            transform: rotateZ(10deg);
        }

        30% {
            transform: rotateZ(-10deg);
        }

        45% {
            transform: rotateZ(5deg);
        }

        60% {
            transform: rotateZ(-5deg);
        }

        75% {
            transform: rotateZ(2deg);
        }
        }

        .button:active {
        transform: scale(0.8);
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--PACE-->
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <!--DATATABLES-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.2/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.4/datatables.min.js"></script>
    <!--SELECT 2-->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>    
    <!--SWEET ALERT-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready( function () {
            $('#tabla').DataTable({
                processing: true, // Muestra un indicador de procesamiento
                serverSide: true, // Activa el renderizado del lado del servidor
                ajax: {
                    url: "{{route('universidad.index')}}", // URL del controlador en el servidor
                    type: 'GET',
                    data: function(d) {
                        // Puedes enviar datos adicionales al servidor aquí si es necesario
                        return $.extend({}, d, {
                            // Por ejemplo, agregar parámetros de filtro personalizados
                            extraParam1: 'valor1',
                            extraParam2: 'valor2'
                        });
                    }
                },
                columns: [
                    { data: 'nombreuniversidad' },
                    { data: 'departamento' },
                    { data: 'action' }
                ],
                language: {
                    lengthMenu: "Mostrar _MENU_ entradas por página",
                    zeroRecords: "No existen entradas para mostrar",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 a 0 de 0 entradas",
                    infoFiltered: "(filtrado de _MAX_ entradas totales)",
                    search: "Busqueda:",
                }
            });
            let selectize=$('#departamento').selectize();
        });
        function enviar(){
            $('#formulario').submit();
        }

        function modalresetearformulario(){
            $('#formulario')[0].reset();
            let selectize = $('#departamento')[0].selectize; 
            selectize.setValue(['LP']);
        }

        $('#formulario').on('submit',(e)=>{
            e.preventDefault();
            if ($('#formulario')[0].checkValidity()) {
                let formData=$('#formulario').serializeArray();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let idUniversidad = $('#idUniversidad').val();
                if(idUniversidad){
                    $.ajax({
                        url: `{{route('universidad.update',':id') }}`.replace(':id', idUniversidad),
                        method: 'PUT',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Añade el token CSRF a los headers
                        },
                        success: function(response) {
                            $('#tabla').DataTable().ajax.reload();
                            $('#formulario')[0].reset();
                            let selectize = $('#departamento')[0].selectize; 
                            selectize.clear();
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "LA UNIVERSIDAD SE ACTUALIZÓ CORRECTAMENTE",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#cerrar').click();
                            selectize.refreshOptions();
                            $('#idUniversidad').val('');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error en el envío del formulario:', error);
                            alert('Hubo un error al enviar el formulario.');
                        }
                    });
                }
                else{
                    $.ajax({
                        url: "{{route('universidad.store')}}", // URL de tu ruta 'store'
                        method: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Añade el token CSRF a los headers
                        },
                        success: function(response) {
                            $('#tabla').DataTable().ajax.reload();
                            $('#formulario')[0].reset();
                            let selectize = $('#departamento')[0].selectize; 
                            selectize.clear();
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "LA UNIVERSIDAD SE REGISTRÓ CORRECTAMENTE",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#cerrar').click();

                        },
                        error: function(xhr, status, error) {
                            console.error('Error en el envío del formulario:', error);
                            alert('Hubo un error al enviar el formulario.');
                        }
                    });
                }
            } 
            else {
                $('#formulario')[0].reportValidity();
            }
        });


        function eliminarRegistro(e){
            Swal.fire({
                title: "¿Estas seguro de eliminar la Universidad?",
                text: "No habrá recuperación del dato borrado!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                if (result.isConfirmed) {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: `{{ route('universidad.destroy', ':id') }}`.replace(':id', e),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Añade el token CSRF a los headers
                        },
                        success: function(response) {
                            $('#tabla').DataTable().ajax.reload();
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: response.nombreuniversidad+" SE ELIMINO CORRECTAMENTE",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#cerrar').click();

                        },
                        error: function(xhr, status, error) {
                            console.error('Error en el envío del formulario:', error);
                            alert('Hubo un error al enviar el formulario.');
                        }
                    });
                }
            });
        }

        function mostrarModal(id,universidad,departamento){
            $('#universidad').val(universidad);
            $('#departamento')[0].selectize.setValue(departamento);
            $('#idUniversidad').val(id);
        }
    </script>
@stop