@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container px-5">
      
    </div>
@stop

@section('content')
    <div class="fondo">
    </div>

    <div class="container position-relative z-index-5 pb-5">
        <ul class="nav nav-pills btn-group d-flex justify-content-around align-items-center" id="myTab" role="tablist">
            <li class="nav-item btn" role="presentation">
                <x-adminlte-button 
                    class="btn-lg p-4 w-100 rounded d-flex flex-column justify-content-center align-items-center active" 
                    type="button" 
                    label="Perfil" 
                    theme="outline-success" 
                    icon="fas fa-user" 
                    data-toggle="tab" 
                    data-target="#perfil-personal" 
                    id="perfil-personal-tab" 
                    aria-controls="perfil-personal" 
                    aria-selected="true"
                />            
            </li>
            <li class="nav-item btn" role="presentation">
                <x-adminlte-button 
                    class="btn-lg p-4 w-100 rounded d-flex flex-column justify-content-center align-items-center" 
                    type="button" 
                    label="Perfil académico" 
                    theme="outline-info" 
                    icon="fas fa-graduation-cap" 
                    data-toggle="tab" 
                    data-target="#perfil-academico" 
                    id="perfil-academico-tab" 
                    aria-controls="perfil-academico" 
                    aria-selected="false"
                />            
            </li>

            <li class="nav-item  btn" role="presentation">
                <x-adminlte-button 
                    class="btn-lg p-4 w-100 rounded d-flex flex-column justify-content-center align-items-center" 
                    type="button" 
                    label="Perfil Laboral" 
                    theme="outline-danger" 
                    icon="fas fa-briefcase" 
                    data-toggle="tab" 
                    data-target="#perfil-laboral" 
                    id="perfil-laboral-tab" 
                    aria-controls="perfil-laboral" 
                    aria-selected="false"
                />            
            </li>
            <li class="nav-item  btn" role="presentation">
                <x-adminlte-button 
                    class="btn-lg p-4 w-100 rounded d-flex flex-column justify-content-center align-items-center" 
                    type="button" 
                    label="Contraseña" 
                    theme="outline-warning" 
                    icon="fas fa-lock" 
                    data-toggle="tab" 
                    data-target="#contrasena" 
                    id="contrasena-tab" 
                    aria-controls="contrasena" 
                    aria-selected="false"
                />            
            </li>
        </ul>
        <div class="tab-content mt-4" id="myTabContent">
            <div class="tab-pane fade show active" id="perfil-personal" role="tabpanel" aria-labelledby="perfil-personal-tab">
                <div class="blur-background p-4">
                    <form id="datospersonales" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">
                            <h4 class="display-4 mb-4">Mi perfil personal</h4>
                            <x-adminlte-callout theme="{{$datos_personales->nombres?'success':'danger'}}" title-class="text-bold text-dark"
                                icon="fas fa-md fa-user-circle" title="Imagen de Perfil">
                                <div class="form-group d-flex flex-column align-items-center justify-content-center">
                                    @if($datos_personales->image_user)
                                        <img src="{{asset('storage/'.$datos_personales->image_user)}}" class="rounded img-thumbnail mx-auto" alt="{{$datos_personales->username}}" width="250px" id="preview">
                                    @else
                                        <img src="{{asset('storage/imagenes/postgrado.jpg')}}" class="rounded img-thumbnail mx-auto" alt="{{$datos_personales->username}}" width="250px" id="preview">
                                    @endif
                                </div>
                                <div class="form-group d-flex flex-column align-items-center justify-content-center">
                                    <span class="text-danger"><strong>¿Deseas actualizar tu foto te perfil?</strong></span>
                                    <div class="custom-file">
                                        <input class="mt-3 custom-file-input" type="file" name="imagenusuario" id="imagen-usuario" accept="image/*">
                                        <label class="custom-file-label" for="imagen-usuario" data-browse="Buscar imagen">Seleccionar Archivo</label>
                                    </div>
                                    <small id="imagen-usuario" class="form-text text-danger bg-danger text-white px-4 py-2 my-2 rounded">
                                        <h6>
                                            Nota: Puedes actualizar tu foto de perfil, con traje formal el fondo que corresponda, pero no subas imágenes mayores a 2MB.
                                        </h6>
                                    </small>
                                </div>
                            </x-adminlte-callout>
                        </div>
                        <div class="form-group" data-aos="fade-up">
                            <div class="d-flex justify-content-center align-items-center row">
                                <div class="col-4">
                                    <x-adminlte-callout theme="{{$datos_personales->nombres?'success':'danger'}}" title-class="text-bold text-dark"
                                        icon="fas fa-md fa-user text-dark" title="Nombres">
                                        {{$datos_personales->nombres}}
                                    </x-adminlte-callout>
                                </div>
                                <div class="col-4">
                                    <x-adminlte-callout theme="{{$datos_personales->apellido_paterno?'success':'danger'}}" title-class="text-bold text-dark"
                                        icon="fas fa-md fa-user text-dark" title="Apellido Paterno">
                                        {{$datos_personales->apellido_paterno}}
                                    </x-adminlte-callout>
                                </div>
                                <div class="col-4">
                                    <x-adminlte-callout theme="{{$datos_personales->apellido_materno?'success':'danger'}}" title-class="text-bold text-dark"
                                        icon="fas fa-lg fa-user text-dark" title="Apellido Materno">
                                        {{$datos_personales->apellido_materno}}
                                    </x-adminlte-callout>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-aos="fade-up">
                            <div class="d-flex justify-content-center align-items-center row">
                                <div class="col-4">
                                    <x-adminlte-callout theme="{{$datos_personales->sexo?'success':'danger'}}" title-class="text-bold text-dark"
                                        icon="{{ $datos_personales->sexo == 'M' ? 'fas fa-md fa-mars text-dark' : 'fas fa-md fa-venus text-dark' }}"
                                        title="Sexo">
                                        {{$datos_personales->sexo=='M' ? 'Masculino' : 'Femenino'}}
                                    </x-adminlte-callout>
                                </div>
                                <div class="col-4">
                                    <x-adminlte-callout theme="{{$datos_personales->celular?'success':'danger'}}" title-class="text-bold text-dark"
                                        icon="fas fa-md fa-phone"
                                        title="Celular">
                                        <input type="text" id="celular" name="celular" class="form-control is-valid" value="{{$datos_personales->celular}}" required>
                                        <small class="text-danger">Nota: Puedes actualizar con tu número de celular actual</small>
                                    </x-adminlte-callout>
                                </div>
                                <div class="col-4">
                                    <x-adminlte-callout theme="{{$datos_personales->email?'success':'danger'}}" title-class="text-bold text-dark"
                                        icon="fas fa-md fa-envelope"
                                        title="Correo Electrónico">
                                        <input type="email" id="email" name="email" class="form-control is-valid" value="{{$datos_personales->email}}" required>
                                        <small class="text-danger">Nota: Puedes actualizar con tu correo electrónico actual</small>
                                    </x-adminlte-callout>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" data-aos="fade-up">
                            <div class="d-flex row">
                                <div class="col-9 mx-auto">
                                <x-adminlte-callout theme="{{$datos_personales->email?'success':'danger'}}" title-class="text-bold text-dark"
                                        icon="fas fa-md fa-map-marker-alt"
                                        title="¿Donde vives?">
                                        <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">Nos informaste que vives en {{$datos_personales->domicilio}}</h4>
                                            <hr>
                                            <p>Nota: Puedes actualizar tu información, Busca en el mapa y selecciona tu ubicación actual, esto nos ayudará a poder saber en que parte del país te encuentras para poder colaborarte</p>
                                        </div>
                                        <div id="map"></div>
                                        <input type="hidden" id="latitud" name="latitud" class="form-control" value="{{$datos_personales->latitud}}">
                                        <input type="hidden" id="longitud" name="longitud" class="form-control" value="{{$datos_personales->longitud}}">
                                        <input type="hidden" id="domicilio" name="domicilio" class="form-control" value="{{$datos_personales->domicilio}}" readonly>
                                    </x-adminlte-callout>                                  
                                </div>
                            </div>
                        </div>

                        <div class="form-group" data-aos="fade-up">
                            <div class="d-flex row">

                                <div class="col-4">
                                    @if ($datos_personales->fecha_nacimiento)
                                        <x-adminlte-callout theme="success" title-class="text-bold text-dark"
                                            icon="fas fa-md fa-calendar-check" title="Fecha de nacimiento">
                                            {{$datos_personales->fecha_nacimiento}}
                                        </x-adminlte-callout>
                                    @else
                                        <x-adminlte-callout theme="danger" title-class="text-bold text-dark"
                                            icon="fas fa-md fa-calendar-check" title="Fecha de nacimiento">
                                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control is-valid" value="" required>
                                            <small class="text-danger">Nota: Registra tu Fecha de nacimiento</small>
                                        </x-adminlte-callout>
                                    @endif
                                </div>
                                <div class="col-4">
                                    @if ($datos_personales->lugar_nacimiento)
                                        <x-adminlte-callout theme="success" title-class="text-bold text-dark"
                                            icon="fas fa-md fa-calendar-check" title="Lugar de nacimientoo">
                                            {{$datos_personales->lugar_nacimiento}}
                                        </x-adminlte-callout>
                                    @else
                                        <x-adminlte-callout theme="danger" title-class="text-bold text-dark"
                                            icon="fas fa-md fa-calendar-check" title="Lugar de nacimiento">
                                            <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" class="form-control is-valid" value="" required>
                                            <small class="text-danger">Nota: Actualiza tu Lugar de nacimiento</small>
                                        </x-adminlte-callout>
                                    @endif
                                </div>
                                <div class="col-4">
                                    @if ($datos_personales->nacionalidad)
                                        <x-adminlte-callout theme="success" title-class="text-bold text-dark"
                                            icon="fas fa-md fa-calendar-check" title="Nacionalidad">
                                            {{$datos_personales->nacionalidad}}
                                        </x-adminlte-callout>
                                    @else
                                        <x-adminlte-callout theme="danger" title-class="text-bold text-dark"
                                            icon="fas fa-md fa-calendar-check" title="Nacionalidad">
                                            <input type="text" id="nacionalidad" name="nacionalidad" class="form-control is-valid" value="" required>
                                            <small class="text-danger">Nota: Actualiza tu Nacionalidad</small>
                                        </x-adminlte-callout>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-4 btn-lg">Guardar cambios</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="perfil-academico" role="tabpanel" aria-labelledby="perfil-academico-tab">
               
            </div>
            <div class="tab-pane fade" id="perfil-laboral" role="tabpanel" aria-labelledby="perfil-laboral-tab">

            </div>
            <div class="tab-pane fade" id="contrasena" role="tabpanel" aria-labelledby="contrasena-tab">

            </div>
        </div>
    </div>
@stop

@section('css')
    <!--ANIMATE-->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <!--LEAFLET-->
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" />
    <!--FADE-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!--PACE-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <!--DATATABLES-->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.2/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.4/datatables.min.css" rel="stylesheet">
    <!--SELECT2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #map {
            height: 450px;
        }

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

        .blur-background {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.5); 
            backdrop-filter: blur(10px);
            z-index: -1;
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
    <!--FADE-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!--LEAFLET-->
    <script src="{{asset('leaflet/leaflet.js')}}"></script>
    <!--AJAX-->
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
        // Seleccionar el input y la imagen de previsualización
        const inputImagen = document.getElementById('imagen-usuario');
        const preview = document.getElementById('preview');

        // Escuchar cambios en el input de archivo
        inputImagen.addEventListener('change', (event) => {
            const archivo = event.target.files[0]; // Obtener el archivo seleccionado
            
            if (archivo) {
                const reader = new FileReader(); // Crear un lector de archivos
                
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                
                reader.readAsDataURL(archivo); // Leer el archivo como URL
            } else {
                preview.style.display = 'none'; // Ocultar la previsualización si no hay archivo
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            AOS.init();
            $('#datospersonales').on('submit', function(e) {
                e.preventDefault();

                // Crea una nueva instancia de FormData
                let formulario = new FormData(this);

                // Llamada AJAX
                $.ajax({
                    url: "{{ route('usuario.update', $datos_personales->id) }}",
                    method: 'POST',
                    data: formulario,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Datos personales actualizados correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr) {
                        // Si hay errores, mostrarlos
                        console.log(xhr.responseJSON); // Para ver detalles de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al guardar los datos personales',
                            text: 'faltan campos'
                        });
                    }
                });
            });
        });
    </script>

    <script>
        // Inicializa el mapa y establece la vista inicial
        @if($datos_personales->domicilio)
            let map = L.map('map').setView([{{$datos_personales->latitud}}, {{$datos_personales->longitud}}], 18);
            let marcador = null;
        @else
            let map = L.map('map').setView([-16.290154, -63.588653], 5);
            let marcador = null;
        @endif
        // Agrega la capa de mosaicos de OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
        @if($datos_personales->domicilio)
            marcador=L.marker([{{$datos_personales->latitud}}, {{$datos_personales->longitud}}]).addTo(map)
            .bindPopup('Yo vivo aquí.')
            .openPopup();
        @endif 

        map.on('click', onMapClick);
        function onMapClick(e) {
            if (marcador) {
                map.removeLayer(marcador);
            }

            marcador = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map)
                .bindPopup('Yo vivo aquí.')
                .openPopup();
            $('#latitud').val(e.latlng.lat);
            $('#longitud').val(e.latlng.lng);

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${e.latlng.lat}&lon=${e.latlng.lng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    const direccion = data.display_name;
                    $('#domicilio').val(direccion);
                })
                .catch(error => {
                    console.error('Error al obtener la dirección:', error);
                    $       ('#domicilio').val('');
            });
        }
    </script>
@stop