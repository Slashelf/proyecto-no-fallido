@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container px-5">
        <div class="row d-flex flex-column align-items-center justify-content-center">
            <div class="col d-flex flex-column align-items-start justify-content-center" id="cabecera">
                <h1>
                    <img src="{{asset('images/postgrado.webp')}}" alt="postgrado imagen" width="70" >
                    Bienvenido a la administración de tu perfil
                </h1>
            </div>
        </div>
        @if(!$datos_personales->fecha_titulo && !session('solicitud'))
            <div class="alert alert-warning alert-dismissible fade show mt-4 position-relative" style="z-index: 20" role="alert">
                <strong>¿Ya eres profesional?</strong> Completa tu registro. <button class="btn btn-sm btn-success"> <a style="text-decoration: none" href="{{route('usuario.create')}}">Completar registro</a></button>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
@stop

@section('content')
    <div class="fondo">
    </div>

    <div class="container position-relative z-index-5 pb-5">
        <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{session('solicitud')?'':'active'}}" style="border:none" id="perfil-personal-tab" data-toggle="tab" data-target="#perfil-personal" type="button" role="tab" aria-controls="perfil-personal" aria-selected="true">
                    Pefil personal
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{session('solicitud')?'active':''}}" style="border:none" id="perfil-academico-tab" data-toggle="tab" data-target="#perfil-academico" type="button" role="tab" aria-controls="perfil-academico" aria-selected="false">
                    Perfil académico
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" style="border:none" id="perfil-laboral-tab" data-toggle="tab" data-target="#perfil-laboral" type="button" role="tab" aria-controls="perfil-laboral" aria-selected="false">
                    Perfil Laboral
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" style="border:none" id="contrasena-tab" data-toggle="tab" data-target="#contrasena" type="button" role="tab" aria-controls="contrasena" aria-selected="false">
                    Contraseña
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade {{session('solicitud')?'':'show active'}}" id="perfil-personal" role="tabpanel" aria-labelledby="perfil-personal-tab">
                <div class="blur-background p-4">
                    <form id="datospersonales" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="container d-flex flex-column align-items-center justify-content-center">
                            <label for="imagen-usuario">
                                <h4>
                                    <span class="badge badge-pill badge-info">Imagen de Usuario</span>
                                </h4>
                            </label>
                            @if($datos_personales->image_user)
                                <img src="{{asset('storage/'.$datos_personales->image_user)}}" class="rounded img-thumbnail" alt="{{$datos_personales->username}}" width="250px" id="preview">
                            @else
                                <img src="{{asset('storage/imagenes/postgrado.jpg')}}" class="rounded img-thumbnail" alt="{{$datos_personales->username}}" width="250px" id="preview">
                            @endif
                            <div class="form-group d-flex flex-column align-items-center justify-content-center">
                                <input class="mt-3" type="file" name="imagenusuario" id="imagen-usuario" accept="image/*">
                                <small id="imagen-usuario" class="form-text text-danger bg-danger text-white px-4 py-2 my-2 rounded">
                                    <h5>
                                        Nota.- No subas imágenes mayores a 2MB.
                                    </h5>
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex row">
                                <div class="col-4">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" id="nombres" class="form-control" value="{{$datos_personales->nombres}}" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="apellido-paterno">Apellido paterno</label>
                                    <input type="text" id="apellido-paterno" class="form-control" value="{{$datos_personales->apellido_paterno}}" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="apellido-materno">Apellido materno</label>
                                    <input type="text" id="apellido-materno" class="form-control" value="{{$datos_personales->apellido_materno}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex row">
                                <div class="col-4">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control" id="sexo" name="sexo" required>
                                        <option value="" {{ $datos_personales->sexo == '' ? 'selected' : '' }}>Seleccione un valor</option>
                                        <option value="M" {{ $datos_personales->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ $datos_personales->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="celular">Celular</label>
                                    <input type="text" id="celular" name="celular" class="form-control" value="{{$datos_personales->celular}}"required>
                                </div>
                                <div class="col-4">
                                    <label for="email">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{$datos_personales->email}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex row">
                                <div class="col-9 mx-auto">
                                    <label for="map" class="mb-4">¿Donde vives?</label>
                                    <span class="badge badge-pill badge-warning">Busca tu ubicación y seleccionalo</span>
                                    <div id="map"></div>
                                    <input type="hidden" id="latitud" name="latitud" class="form-control" value="{{$datos_personales->latitud}}">
                                    <input type="hidden" id="longitud" name="longitud" class="form-control" value="{{$datos_personales->longitud}}">
                                    <input type="text" id="domicilio" name="domicilio" class="form-control" value="{{$datos_personales->domicilio}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex row">
                                <div class="col-4">
                                    <label for="fecha-nacimiento">Fecha de nacimiento</label>
                                    <input type="date" name='fechanacimiento' id="fecha-nacimiento" class="form-control" 
                                    value="{{ $datos_personales->fecha_nacimiento }}"
                                    min="{{ date('Y-m-d', strtotime('-80 years')) }}" 
                                    max="{{ date('Y-m-d', strtotime('-20 years')) }}"
                                    required>
                                </div>
                                <div class="col-4">
                                    <label for="lugar-nacimiento">Lugar de nacimiento</label>
                                    <input type="text" name='lugarnacimiento' id="lugar-nacimiento" class="form-control" value="{{$datos_personales->lugar_nacimiento}}"
                                    required>
                                </div>
                                <div class="col-4">
                                    <label for="nacionalidad">Nacionalidad</label>
                                    <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" value="{{$datos_personales->nacionalidad}}"
                                    required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-4 btn-lg">Guardar cambios</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade {{session('solicitud')?'show active':''}}" id="perfil-academico" role="tabpanel" aria-labelledby="perfil-academico-tab">
                <div class="blur-background p-4">
                    <form id="datospersonales" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <div class="d-flex row">
                                <div class="col-4">
                                    <label for="nombres">Facultad</label>
                                    <input type="text" id="nombres" class="form-control" value="{{$datos_personales->nombres}}" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="apellido-paterno">Apellido paterno</label>
                                    <input type="text" id="apellido-paterno" class="form-control" value="{{$datos_personales->apellido_paterno}}" disabled>
                                </div>
                                <div class="col-4">
                                    <label for="apellido-materno">Apellido materno</label>
                                    <input type="text" id="apellido-materno" class="form-control" value="{{$datos_personales->apellido_materno}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex row">
                                <div class="col-4">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control" id="sexo" name="sexo" required>
                                        <option value="" {{ $datos_personales->sexo == '' ? 'selected' : '' }}>Seleccione un valor</option>
                                        <option value="M" {{ $datos_personales->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ $datos_personales->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="celular">Celular</label>
                                    <input type="text" id="celular" name="celular" class="form-control" value="{{$datos_personales->celular}}"required>
                                </div>
                                <div class="col-4">
                                    <label for="email">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{$datos_personales->email}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex row">
                                <div class="col-9 mx-auto">
                                    <label for="map" class="mb-4">¿Donde vives?</label>
                                    <span class="badge badge-pill badge-warning">Busca tu ubicación y seleccionalo</span>
                                    <div id="map"></div>
                                    <input type="hidden" id="latitud" name="latitud" class="form-control" value="{{$datos_personales->latitud}}">
                                    <input type="hidden" id="longitud" name="longitud" class="form-control" value="{{$datos_personales->longitud}}">
                                    <input type="text" id="domicilio" name="domicilio" class="form-control" value="{{$datos_personales->domicilio}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex row">
                                <div class="col-4">
                                    <label for="fecha-nacimiento">Fecha de nacimiento</label>
                                    <input type="date" name='fechanacimiento' id="fecha-nacimiento" class="form-control" 
                                    value="{{ $datos_personales->fecha_nacimiento }}"
                                    min="{{ date('Y-m-d', strtotime('-80 years')) }}" 
                                    max="{{ date('Y-m-d', strtotime('-20 years')) }}"
                                    required>
                                </div>
                                <div class="col-4">
                                    <label for="lugar-nacimiento">Lugar de nacimiento</label>
                                    <input type="text" name='lugarnacimiento' id="lugar-nacimiento" class="form-control" value="{{$datos_personales->lugar_nacimiento}}"
                                    required>
                                </div>
                                <div class="col-4">
                                    <label for="nacionalidad">Nacionalidad</label>
                                    <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" value="{{$datos_personales->nacionalidad}}"
                                    required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-4 btn-lg">Guardar cambios</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="perfil-laboral" role="tabpanel" aria-labelledby="perfil-laboral-tab">

            </div>
            <div class="tab-pane fade" id="contrasena" role="tabpanel" aria-labelledby="contrasena-tab">

            </div>
        </div>
    </div>
@stop

@section('css')
    <!--PACE-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <!--DATATABLES-->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.2/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.4/datatables.min.css" rel="stylesheet">
    <!--SELECT2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--LEAFLET-->
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" />
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

    <!--LEAFLET-->
    <script src="{{asset('leaflet/leaflet.js')}}"></script>


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
        let map = L.map('map').setView([-16.290154, -63.588653], 5);
        let marcador = null;
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
                    $('#domicilio').val('');
            });
        }
    </script>
@stop