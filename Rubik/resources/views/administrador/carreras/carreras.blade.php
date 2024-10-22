@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container px-5">
        <div class="row d-flex flex-column align-items-center justify-content-center">
            <div class="col d-flex flex-column align-items-start justify-content-center" id="cabecera">
                <h1>
                    <img src="{{asset('images/postgrado.webp')}}" alt="postgrado imagen" width="70" >
                    Gestión de Carreras de Universidades de Bolivia
                </h1>
                <div class="w-full d-flex justify-content-center align-items-center">
                    <span>
                        Bienvenido al administrador de carreras de las universidades de Bolivia
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

                            <div class="text">Agregar Carrera</div>
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

    <x-adminlte-modal id="modalPurple" title="Formulario de carrera" theme="success" icon="fas fa-user-graduate" size='lg'>
        <form id="formulario">
            <label for="carrera">Nombre de la Carrera</label>
            <input type="text" name="carrera" placeholder="Ingresa la carrera" id="carrera" class="form-control" required>
            <input type="hidden" name="idCarrera" id="idCarrera">
            <label for="departamento">Selecciona el Departamento al que pertenece</label>
            <br>
            <select style="width: 100%" id="departamento" name="departamento" required>
                <option></option> <!-- Select2 automáticamente detectará esto como un placeholder -->
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
            <br>
            <label for="universidad">Selecciona la Universidad a la que pertenece</label>
            <select style="width: 100%" id="universidad" name="universidad" required>
                <option data-placeholder="true"></option>
            </select>
            <label for="facultad">Selecciona la Facultad a la que pertenece</label>
            <select style="width: 100%" id="facultad" name="facultad" required>
                <option data-placeholder="true"></option>
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
                    <th>Facultad</th>
                    <th>Carrera</th>
                    <th>Depto.</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="fondodecuerpotabla">
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <!--PACE-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <!--DATATABLES-->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.2/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.4/datatables.min.css" rel="stylesheet">
    <!--SELECT2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        
        .select2-container--default .select2-selection--single {
            height: 40px; /* Ajusta la altura aquí */
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            height: 35px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px; /* Ajusta la altura del ícono de la flecha */
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
    <!--SWEET ALERT-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready( function () {
            
            $('#tabla').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('carrera.index')}}",
                    type: 'GET',
                    data: function(d) {
                        return $.extend({}, d, {
                            extraParam1: 'valor1',
                            extraParam2: 'valor2'
                        });
                    }
                },
                columns: [
                    { data: 'universidad' },
                    { data: 'facultad' },
                    { data: 'nombreCarrera' },
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


            $('#departamento').select2({
                width: 'resolve',
                placeholder: "Selecciona un Departamento",
            });
            $('#universidad').select2({
                placeholder: 'Seleccione una Universidad',
                width: 'resolve'
            });
            $('#facultad').select2({
                width: 'resolve',
                placeholder: "Selecciona un Facultad",
            });

            $('#departamento').on('select2:select', function (e) {
                let departamento = $(this).val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Solicitud AJAX para recuperar las universidades
                $.ajax({
                    url: `{{route('universidad.show',':id') }}`.replace(':id', departamento),  // Reemplaza con la ruta correcta en tu servidor
                    type: 'GET',
                    success: function (data) {
                        $('#universidad').empty();
                        $('#universidad').append('<option></option>');
                        $.each(data, function(key, data) {
                            $('#universidad').append('<option value="'+ data.id +'">'+ data.nombreuniversidad +'</option>');
                        });
                        $('#universidad').trigger('change');
                        //deselect
                        $('#facultad').empty();
                    },
                    error: function(xhr, status, error) {
                            console.error('Error en el envío del formulario:', error);
                            alert('Hubo un error al enviar el formulario.');
                        }
                });
            });


            $('#universidad').on('select2:select', function (e) {
                let idUniversidad = $(this).val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Solicitud AJAX para recuperar las facultades
                $.ajax({
                    url: `{{route('facultad.show',':id') }}`.replace(':id', idUniversidad),
                    type: 'GET',
                    success: function (data) {
                        $('#facultad').empty();
                        $('#facultad').append('<option></option>');
                        $.each(data, function(key, data) {
                            $('#facultad').append('<option value="'+ data.id +'">'+ data.facultad +'</option>');
                        });
                        $('#facultad').trigger('change');
                    },
                    error: function(xhr, status, error) {
                            console.error('Error en el envío del formulario:', error);
                            alert('Hubo un error al enviar el formulario.');
                        }
                });
            });
        });
        /***************************************************************/
        function enviar(){
            $('#formulario').submit();
        }

        function modalresetearformulario(){
            $('#formulario')[0].reset();
            $('#departamento').val(null).trigger('change');
            $('#universidad').val(null).trigger('change');
            $('#facultad').val(null).trigger('change');
        }

        $('#formulario').on('submit',(e)=>{
            e.preventDefault();
            if ($('#formulario')[0].checkValidity()) {
                let formData=$('#formulario').serializeArray();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let idCarrera = $('#idCarrera').val();
                if(idCarrera){
                    $.ajax({
                            url: `{{route('carrera.update',':id') }}`.replace(':id', idCarrera),
                            method: 'PUT',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Añade el token CSRF a los headers
                            },
                            success: function(response) {
                                $('#tabla').DataTable().ajax.reload();
                                $('#formulario')[0].reset();
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "La carrera se actualizó correctamente",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#cerrar').click();
                                $('#idCarrera').val('');
                            },
                            error: function(xhr, status, error) {
                                console.error('Error en el envío del formulario:', error);
                                alert('Hubo un error al enviar el formulario.');
                            }
                        });
                    }
                    else{
                        $.ajax({
                            url: "{{route('carrera.store')}}", // URL de tu ruta 'store'
                            method: 'POST',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Añade el token CSRF a los headers
                            },
                            success: function(response) {
                                $('#tabla').DataTable().ajax.reload();
                                $('#formulario')[0].reset();
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "La carrera se registro correctamente",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#cerrar').click();

                            },
                            error: function(xhr, status, error) {
                                console.error('Error en el envío del formulario:'+ error);
                                alert('Hubo un error al enviar el formulario.');
                            }
                        });
                    }
                } 
                else {
                    $('#formulario')[0].reportValidity();
                }
            });

        function mostrarModal(id, nombreCarrera, departamento, idFacultad, idUniversidad){
            $('#carrera').val(nombreCarrera);
            $('#departamento').val(departamento).trigger('change');
            $.ajax({
                url: `{{route('universidad.show',':id') }}`.replace(':id', departamento),
                type: 'GET',             
                success: function (data) {
                    $('#universidad').empty();
                    $('#universidad').append('<option></option>');
                    $.each(data, function(key, data) {
                        if(data.id==idUniversidad)
                            $('#universidad').append('<option value="'+ data.id +'" selected>'+ data.nombreuniversidad +'</option>');
                        else
                            $('#universidad').append('<option value="'+ data.id +'">'+ data.nombreuniversidad +'</option>');
                    });
                    $('#universidad').trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('Error en el envío del formulario:', error);
                    alert('Hubo un error al enviar el formulario.');
                }
            });
            $.ajax({
                url: `{{route('facultad.show',':id') }}`.replace(':id', idUniversidad),
                type: 'GET',             
                success: function (data) {
                    $('#facultad').empty();
                    $('#facultad').append('<option></option>');
                    $.each(data, function(key, data) {
                        if(data.id==idFacultad)
                            $('#facultad').append('<option value="'+ data.id +'" selected>'+ data.facultad +'</option>');
                        else
                            $('#facultad').append('<option value="'+ data.id +'">'+ data.facultad +'</option>');
                    });
                    $('#universidad').trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('Error en el envío del formulario:', error);
                    alert('Hubo un error al enviar el formulario.');
                }
            });
            $('#idCarrera').val(id);
        }


        function eliminarRegistro(e){
            Swal.fire({
                title: "¿Estas seguro de eliminar la Carrera?",
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
                        url: `{{ route('carrera.destroy', ':id') }}`.replace(':id', e),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Añade el token CSRF a los headers
                        },
                        success: function(response) {
                            $('#tabla').DataTable().ajax.reload();
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: response.nombreCarrera+" SE ELIMINO CORRECTAMENTE",
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
    </script>
@stop