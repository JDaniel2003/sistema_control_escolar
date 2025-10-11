<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Top Header -->
    <div class="bg-danger text-white1 text-center py-2">
        <div class="d-flex justify-content-between align-items-center px-4">

            <h4 class="mb-0" style="text-align: center;">SISTEMA DE CONTROL ESCOLAR</h4>

        </div>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dangerb">
        <div class="d-flex align-items-center">
            <div style="width: 300px; height: 120px; ">
                <img src="{{ asset('libs/sbadmin/img/upn.png') }}" alt="Logo"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>


        <div class="collapse navbar-collapse ml-4">
            <ul class="navbar-nav">
                <li class="nav-item"> <!-- bg-success -->
                    <a class="nav-link  text-white px-3 mr-1" href="{{ route('admin') }}">Inicio</a>


                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('periodos.index') }}">Períodos Escolares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('carreras.index') }}">Carreras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('materias.index') }}">Materias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('planes.index') }}">Planes de estudio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbar-active-item  px-3 mr-1" href="#">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="#">Inscripciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="#">Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="#">Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="#">Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="#">Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="#">Docentes</a>
                </li>
            </ul>
        </div>
        <div class="position-absolute" style="top: 10px; right: 20px; z-index: 1000;">
            <div class="d-flex align-items-center text-white">
                <span class="mr-3">{{ Auth::user()->rol->nombre }}</span>
                <a href="#" class="text-white text-decoration-none logout-link" data-toggle="modal"
                    data-target="#logoutModal">
                    Cerrar Sesión <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

    </nav>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Main Content -->
                <div class="container-fluid py-5">

                    <h1 class="text-danger text-center mb-5"
                        style="font-size: 2.5rem; font-family: 'Arial Black', Verdana, sans-serif; font-weight: bold;">
                        Gestión de Alumnos</h1>

                    <div class="row justify-content-center">
                        <div class="col-lg-10">

                            <!-- Botón para nuevo alumno -->
                            <div class="mb-3 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#nuevoAlumnoModal">
                                    <i class="fas fa-user-plus"></i> Nuevo Aspirante
                                </button>
                            </div>

                            <!-- Tabla de alumnos -->
                            <div class="card-body1">
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Matrícula</th>
                                                    <th>Nombre Completo</th>
                                                    <th>Carrera</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($alumnos as $alumno)
                                                    <tr>
                                                        <td>{{ $alumno->id_alumno }}</td>
                                                        <td>{{ optional($alumno->datosAcademicos)->matricula ?? 'No Asignado' }}
                                                        <td>
                                                            {{ optional($alumno->datosPersonales)->nombres }}
                                                            {{ optional($alumno->datosPersonales)->primer_apellido }}
                                                            {{ optional($alumno->datosPersonales)->segundo_apellido }}
                                                        </td>
                                                        <td>{{ optional(optional($alumno->datosAcademicos)->carrera)->nombre ?: 'No Asignado' }}

                                                        </td>
                                                        </td>
                                                        <td>{{ optional($alumno->statusAcademico)->nombre ?? '—' }}
                                                        </td>
                                                        <td>
                                                            <!-- Botón Ver -->
                                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#verAlumnoModal{{ $alumno->id_alumno }}">
                                                                <i class="fas fa-eye"></i> Ver
                                                            </button>

                                                            <!-- Botón Editar -->
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                                data-target="#editarModal{{ $alumno->id_alumno }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <!-- Botón Eliminar -->
                                                            <form
                                                                action="{{ route('alumnos.destroy', $alumno->id_alumno) }}"
                                                                method="POST" style="display:inline-block;"
                                                                onsubmit="return confirm('¿Seguro que deseas eliminar este alumno?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Ver Alumno -->
                                                    <!-- Modal Ver/Editar Alumno -->
                                                    <div class="modal fade"
                                                        id="verAlumnoModal{{ $alumno->id_alumno }}" tabindex="-1"
                                                        role="dialog"
                                                        aria-labelledby="verAlumnoModalLabel{{ $alumno->id_alumno }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary text-white">
                                                                    <h5 class="text-center w-100 mb-0">Detalles del
                                                                        Alumno - Editar</h5>
                                                                    <button type="button" class="close text-white"
                                                                        data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('alumnos.update', $alumno->id_alumno) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        {{-- =================== DATOS PERSONALES =================== --}}
                                                                        <h6 class="text-primary mb-3"><b>Datos
                                                                                Personales</b></h6>
                                                                        <div class="row">
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Nombres <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text"
                                                                                    name="datos_personales[nombres]"
                                                                                    value="{{ optional($alumno->datosPersonales)->nombres }}"
                                                                                    class="form-control" required>
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Primer Apellido <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="text"
                                                                                    name="datos_personales[primer_apellido]"
                                                                                    value="{{ optional($alumno->datosPersonales)->primer_apellido }}"
                                                                                    class="form-control" required>
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Segundo Apellido</label>
                                                                                <input type="text"
                                                                                    name="datos_personales[segundo_apellido]"
                                                                                    value="{{ optional($alumno->datosPersonales)->segundo_apellido }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-6 mb-2">
                                                                                <label>CURP</label>
                                                                                <input type="text" name="curp"
                                                                                    maxlength="18"
                                                                                    value="{{ optional($alumno->datosPersonales)->curp }}"
                                                                                    class="form-control"
                                                                                    style="text-transform: uppercase;">
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Fecha de Nacimiento</label>
                                                                                <input type="date"
                                                                                    name="fecha_nacimiento"
                                                                                    value="{{ optional($alumno->datosPersonales)->fecha_nacimiento }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Edad</label>
                                                                                <input type="number" name="edad"
                                                                                    min="0"
                                                                                    value="{{ optional($alumno->datosPersonales)->edad }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-6 mb-2">
                                                                                <label>Lugar de Nacimiento</label>
                                                                                <input type="text"
                                                                                    name="lugar_nacimiento"
                                                                                    value="{{ optional($alumno->datosPersonales)->lugar_nacimiento }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-6 mb-2">
                                                                                <label>Correo</label>
                                                                                <input type="email" name="correo"
                                                                                    value="{{ optional($alumno->datosPersonales)->correo }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-6 mb-2">
                                                                                <label>Teléfono</label>
                                                                                <input type="text" name="telefono"
                                                                                    maxlength="10"
                                                                                    value="{{ optional($alumno->datosPersonales)->telefono }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Estado Civil</label>
                                                                                <select name="id_estado_civil"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($estados_civiles as $estado)
                                                                                        <option
                                                                                            value="{{ $estado->id_estado_civil }}"
                                                                                            {{ optional($alumno->datosPersonales)->id_estado_civil == $estado->id_estado_civil ? 'selected' : '' }}>
                                                                                            {{ $estado->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Tipo de Sangre</label>
                                                                                <select name="id_tipo_sangre"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($tipos_sangre as $tipo)
                                                                                        <option
                                                                                            value="{{ $tipo->id_tipo_sangre }}"
                                                                                            {{ optional($alumno->datosPersonales)->id_tipo_sangre == $tipo->id_tipo_sangre ? 'selected' : '' }}>
                                                                                            {{ $tipo->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Género</label>
                                                                                <select name="id_genero"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($generos as $genero)
                                                                                        <option
                                                                                            value="{{ $genero->id_genero }}"
                                                                                            {{ optional($alumno->datosPersonales)->id_genero == $genero->id_genero ? 'selected' : '' }}>
                                                                                            {{ $genero->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Lengua Indígena</label>
                                                                                <select name="id_lengua_indigena"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($lenguas as $lengua)
                                                                                        <option
                                                                                            value="{{ $lengua->id_lengua_indigena }}"
                                                                                            {{ optional($alumno->datosPersonales)->id_lengua_indigena == $lengua->id_lengua_indigena ? 'selected' : '' }}>
                                                                                            {{ $lengua->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Discapacidad</label>
                                                                                <select name="id_discapacidad"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($discapacidades as $discapacidad)
                                                                                        <option
                                                                                            value="{{ $discapacidad->id_discapacidad }}"
                                                                                            {{ optional($alumno->datosPersonales)->id_discapacidad == $discapacidad->id_discapacidad ? 'selected' : '' }}>
                                                                                            {{ $discapacidad->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Hijos</label>
                                                                                <input type="number" name="hijos"
                                                                                    min="0"
                                                                                    value="{{ optional($alumno->datosPersonales)->hijos }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 mb-2">
                                                                            <label>Generacion</label>
                                                                            <select name="id_generacion"
                                                                                class="form-control">
                                                                                <option value="">
                                                                                    Selecciona...</option>
                                                                                @foreach ($generaciones as $generacion)
                                                                                    <option
                                                                                        value="{{ $generacion->id_generacion }}">
                                                                                        {{ $generacion->nombre }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>


                                                                        {{-- =================== DOMICILIO ALUMNO =================== --}}
                                                                        <h6 class="text-primary mt-4 mb-3"><b>Domicilio
                                                                                del Alumno</b></h6>
                                                                        <div class="row">
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Calle</label>
                                                                                <input type="text"
                                                                                    name="domicilio_alumno[calle]"
                                                                                    value="{{ $alumno->datosPersonales?->domicilioAlumno?->calle }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-2 mb-2">
                                                                                <label>Número Exterior</label>
                                                                                <input type="text"
                                                                                    name="domicilio_alumno[numero_exterior]"
                                                                                    value="{{ $alumno->datosPersonales?->domicilioAlumno?->numero_exterior }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-2 mb-2">
                                                                                <label>Número Interior</label>
                                                                                <input type="text"
                                                                                    name="domicilio_alumno[numero_interior]"
                                                                                    value="{{ $alumno->datosPersonales?->domicilioAlumno?->numero_interior }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Colonia</label>
                                                                                <input type="text"
                                                                                    name="domicilio_alumno[colonia]"
                                                                                    value="{{ $alumno->datosPersonales?->domicilioAlumno?->colonia }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Comunidad</label>
                                                                                <input type="text"
                                                                                    name="domicilio_alumno[comunidad]"
                                                                                    value="{{ $alumno->datosPersonales?->domicilioAlumno?->comunidad }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Distrito</label>
                                                                                <select
                                                                                    name="domicilio_alumno[id_distrito]"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($distritos as $distrito)
                                                                                        <option
                                                                                            value="{{ $distrito->id_distrito }}"
                                                                                            {{ $alumno->datosPersonales?->domicilioAlumno?->id_distrito == $distrito->id_distrito ? 'selected' : '' }}>
                                                                                            {{ $distrito->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Estado</label>
                                                                                <select
                                                                                    name="domicilio_alumno[id_estado]"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($estados as $estado)
                                                                                        <option
                                                                                            value="{{ $estado->id_estado }}"
                                                                                            {{ $alumno->datosPersonales?->domicilioAlumno?->id_estado == $estado->id_estado ? 'selected' : '' }}>
                                                                                            {{ $estado->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Municipio</label>
                                                                                <input type="text"
                                                                                    name="domicilio_alumno[municipio]"
                                                                                    value="{{ $alumno->datosPersonales?->domicilioAlumno?->municipio }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Código Postal</label>
                                                                                <input type="text"
                                                                                    name="codigo_postal"
                                                                                    value="{{ $alumno->datosPersonales?->domicilioAlumno?->codigo_postal }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Número de Seguridad
                                                                                    Social</label>
                                                                                <input type="text"
                                                                                    name="numero_seguridad_social"
                                                                                    maxlength="11"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>

                                                                        {{-- =================== DATOS ACADÉMICOS =================== --}}
                                                                        <h6 class="text-primary mt-4 mb-3"><b>Datos
                                                                                Académicos</b></h6>
                                                                        <div class="row">
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Matrícula</label>
                                                                                <input type="text" name="matricula"
                                                                                    value="{{ optional($alumno->datosAcademicos)->matricula }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Carrera</label>
                                                                                <select name="id_carrera"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($carreras as $carrera)
                                                                                        <option
                                                                                            value="{{ $carrera->id_carrera }}"
                                                                                            {{ optional($alumno->datosAcademicos)->id_carrera == $carrera->id_carrera ? 'selected' : '' }}>
                                                                                            {{ $carrera->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Estatus Académico</label>
                                                                                <select name="id_status_academico"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($estatus as $status)
                                                                                        <option
                                                                                            value="{{ $status->id_status_academico }}"
                                                                                            {{ $alumno->id_status_academico == $status->id_status_academico ? 'selected' : '' }}>
                                                                                            {{ $status->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        {{-- =================== TUTOR =================== --}}
                                                                        <h6 class="text-primary mt-4 mb-3"><b>Datos del
                                                                                Tutor</b></h6>
                                                                        <div class="row">
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Nombre</label>
                                                                                <input type="text"
                                                                                    name="tutor[nombres]"
                                                                                    value="{{ $alumno->tutor?->nombres }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Parentesco</label>
                                                                                <select name="id_parentesco"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($parentescos as $parentesco)
                                                                                        <option
                                                                                            value="{{ $parentesco->id_parentesco }}"
                                                                                            {{ $alumno->tutor?->id_parentesco == $parentesco->id_parentesco ? 'selected' : '' }}>
                                                                                            {{ $parentesco->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Teléfono</label>
                                                                                <input type="text"
                                                                                    name="tutor[telefono]"
                                                                                    maxlength="10"
                                                                                    value="{{ $alumno->tutor?->telefono }}"
                                                                                    class="form-control">
                                                                            </div>

                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Calle</label>
                                                                                <input type="text"
                                                                                    name="domicilio_tutor[calle]"
                                                                                    value="{{ $alumno->tutor?->domiciliosTutor?->calle }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-2 mb-2">
                                                                                <label>Número Exterior</label>
                                                                                <input type="text"
                                                                                    name="domicilio_tutor[numero_exterior]"
                                                                                    value="{{ $alumno->tutor?->domiciliosTutor?->numero_exterior }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-2 mb-2">
                                                                                <label>Número Interior</label>
                                                                                <input type="text"
                                                                                    name="domicilio_tutor[numero_interior]"
                                                                                    value="{{ $alumno->tutor?->domiciliosTutor?->numero_interior }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Colonia</label>
                                                                                <input type="text"
                                                                                    name="domicilio_tutor[colonia]"
                                                                                    value="{{ $alumno->tutor?->domiciliosTutor?->colonia }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 mb-2">
                                                                                <label>Municipio</label>
                                                                                <input type="text"
                                                                                    name="domicilio_tutor[municipio]"
                                                                                    value="{{ $alumno->tutor?->domiciliosTutor?->municipio }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Distrito</label>
                                                                                <select
                                                                                    name="domicilio_tutor[id_distrito]"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($distritos as $distrito)
                                                                                        <option
                                                                                            value="{{ $distrito->id_distrito }}"
                                                                                            {{ $alumno->tutor?->domiciliosTutor?->id_distrito == $distrito->id_distrito ? 'selected' : '' }}>
                                                                                            {{ $distrito->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3 mb-2">
                                                                                <label>Estado</label>
                                                                                <select
                                                                                    name="domicilio_tutor[id_estado]"
                                                                                    class="form-control">
                                                                                    <option value="">
                                                                                        Selecciona...</option>
                                                                                    @foreach ($estados as $estado)
                                                                                        <option
                                                                                            value="{{ $estado->id_estado }}"
                                                                                            {{ $alumno->tutor?->domiciliosTutor?->id_estado == $estado->id_estado ? 'selected' : '' }}>
                                                                                            {{ $estado->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="text-right mt-4">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">
                                                                                <i class="fas fa-save"></i> Guardar
                                                                                Cambios
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-muted text-center">No hay
                                                            alumnos registrados</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Nuevo Alumno -->
                        <div class="modal fade" id="nuevoAlumnoModal" tabindex="-1" role="dialog"
                            aria-labelledby="nuevoAlumnoLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="text-center w-100">Registrar Nuevo Alumno / Aspirante</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('alumnos.store') }}" method="POST">
                                            @csrf

                                            <div class="row">
                                                {{-- =================== DATOS PERSONALES =================== --}}
                                                <h6 class="col-12 text-primary mb-2">Datos Personales</h6>

                                                <div class="col-md-4 mb-2">
                                                    <label>Nombres</label>
                                                    <input type="text" name="datos_personales[nombres]"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Primer Apellido</label>
                                                    <input type="text" name="datos_personales[primer_apellido]"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Segundo Apellido</label>
                                                    <input type="text" name="datos_personales[segundo_apellido]"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label>CURP</label>
                                                    <input type="text" name="curp" maxlength="18"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <label>Fecha de Nacimiento</label>
                                                    <input type="date" name="fecha_nacimiento"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <label>Edad</label>
                                                    <input type="number" name="edad" min="0"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Lugar de Nacimiento</label>
                                                    <input type="text" name="lugar_nacimiento"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label>Generacion</label>
                                                    <select name="id_generacion" class="form-control">
                                                        <option value="">
                                                            Selecciona...</option>
                                                        @foreach ($generaciones as $generacion)
                                                            <option value="{{ $generacion->id_generacion }}">
                                                                {{ $generacion->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>






                                                <div class="col-md-4 mb-2">
                                                    <label>Calle</label>
                                                    <input type="text" name="domicilio_alumno[calle]"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <label>Numero Exterior</label>
                                                    <input type="number" name="domicilio_alumno[numero_exterior]"
                                                        min="0" class="form-control">
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <label>Numero Interior</label>
                                                    <input type="number" name="domicilio_alumno[numero_interior]"
                                                        min="0" class="form-control">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label>Colonia</label>
                                                    <input type="text" name="domicilio_alumno[colonia]"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Comunidad</label>
                                                    <input type="text" name="domicilio_alumno[comunidad]"
                                                        class="form-control" required>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label>Distrito</label>
                                                    <select id="distrito" name="domicilio_alumno[id_distrito]"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($distritos as $distrito)
                                                            <option value="{{ $distrito->id_distrito }}">
                                                                {{ $distrito->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Estado</label>
                                                    <select id="estado" name="domicilio_alumno[id_estado]"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($estados as $estado)
                                                            <option value="{{ $estado->id_estado }}">
                                                                {{ $estado->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Municipio</label>
                                                    <input type="text" name="domicilio_alumno[municipio]"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <label>Código Postal</label>
                                                    <input type="number" name="codigo_postal" min="0"
                                                        class="form-control">
                                                </div>


                                                <div class="col-md-4 mb-2">
                                                    <label>Correo Electrónico</label>
                                                    <input type="email" name="correo" class="form-control">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Teléfono</label>
                                                    <input type="text" name="datos_personales[telefono]"
                                                        maxlength="10" class="form-control">
                                                </div>

                                                <div class="col-md-2 mb-2">
                                                    <label>Estado Civil</label>
                                                    <select name="id_estado_civil" class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($estados_civiles as $estado)
                                                            <option value="{{ $estado->id_estado_civil }}">
                                                                {{ $estado->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-2 mb-2">
                                                    <label>Tipo de Sangre</label>
                                                    <select name="id_tipo_sangre" class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($tipos_sangre as $tipo)
                                                            <option value="{{ $tipo->id_tipo_sangre }}">
                                                                {{ $tipo->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-2 mb-2">
                                                    <label>Género</label>
                                                    <select name="id_genero" class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($generos as $genero)
                                                            <option value="{{ $genero->id_genero }}">
                                                                {{ $genero->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label>Lengua Indígena</label>
                                                    <select name="id_lengua_indigena" class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($lenguas as $lengua)
                                                            <option value="{{ $lengua->id_lengua_indigena }}">
                                                                {{ $lengua->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label>Discapacidad</label>
                                                    <select name="id_discapacidad" class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($discapacidades as $discapacidad)
                                                            <option value="{{ $discapacidad->id_discapacidad }}">
                                                                {{ $discapacidad->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label>Número de Seguridad Social</label>
                                                    <input type="text" name="numero_seguridad_social"
                                                        maxlength="11" class="form-control">
                                                </div>

                                                <div class="col-md-1 mb-2">
                                                    <label>Hijos</label>
                                                    <input type="number" name="hijos" min="0"
                                                        class="form-control">
                                                </div>

                                                <h6 class="col-12 text-primary mb-2">Datos Escuela de Procedencia</h6>
                                                <div class="col-md-8 mb-2">
                                                    <label>Subsistema</label>
                                                    <select id="subsistema" name="id_subsistema"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($subsistemas as $subsistema)
                                                            <option value="{{ $subsistema->id_subsistema }}">
                                                                {{ $subsistema->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <div class="col-md-3 mb-2">
                                                    <label>Tipo de Escuela</label>
                                                    <select id="tipo_escuela" name="id_tipo_escuela"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($tiposEscuela as $tipo)
                                                            <option value="{{ $tipo->id_tipo_escuela }}">
                                                                {{ $tipo->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-2 mb-2">
                                                    <label>Promedio de Egreso</label>
                                                    <input type="number" name="promedio_egreso" min="0"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-5 mb-2">
                                                    <label>Área de Especialización</label>
                                                    <select id="area_especializacion" name="id_area_especializacion"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($areaEspecializacion as $area)
                                                            <option value="{{ $area->id_area_especializacion }}">
                                                                {{ $area->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label>Estado</label>
                                                    <select id="estado" name="escuela[id_estado]"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($estados as $estado)
                                                            <option value="{{ $estado->id_estado }}">
                                                                {{ $estado->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label>Localidad</label>
                                                    <input type="text" name="escuela[localidad]"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label>Beca</label>
                                                    <select id="beca" name="id_beca" class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($becas as $beca)
                                                            <option value="{{ $beca->id_beca }}">
                                                                {{ $beca->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <h6 class="col-12 text-primary mb-2">Datos de Tutor</h6>

                                                <div class="col-md-8 mb-2">
                                                    <label>Nombre Completo</label>
                                                    <input type="text" name="tutor[nombres]" class="form-control">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Parentesco</label>
                                                    <select id="parentesco" name="id_parentesco"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($parentescos as $parentesco)
                                                            <option value="{{ $parentesco->id_parentesco }}">
                                                                {{ $parentesco->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label>Calle</label>
                                                    <input type="text" name="domicilio_tutor[calle]"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <label>Numero Exterior</label>
                                                    <input type="number" name="domicilio_tutor[numero_exterior]"
                                                        min="0" class="form-control">
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <label>Numero Interior</label>
                                                    <input type="number" name="domicilio_tutor[numero_interior]"
                                                        min="0" class="form-control">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label>Colonia</label>
                                                    <input type="text" name="domicilio_tutor[colonia]"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Municipio</label>
                                                    <input type="text" name="domicilio_tutor[municipio]"
                                                        class="form-control" required>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label>Distrito</label>
                                                    <select id="distrito" name="domicilio_tutor[id_distrito]"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($distritos as $distrito)
                                                            <option value="{{ $distrito->id_distrito }}">
                                                                {{ $distrito->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Estado</label>
                                                    <select id="estado" name="domicilio_tutor[id_estado]"
                                                        class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($estados as $estado)
                                                            <option value="{{ $estado->id_estado }}">
                                                                {{ $estado->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <label>Telefono</label>
                                                    <input type="number" name="tutor[telefono]" min="0"
                                                        class="form-control">
                                                </div>



                                                {{-- =================== ESTATUS =================== --}}
                                                <div class="col-md-3 mb-2">
                                                    <label>Estatus Académico</label>
                                                    <select name="id_status_academico" id="id_status_academico"
                                                        class="form-control" required>
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($estatus as $status)
                                                            <option value="{{ $status->id_status_academico }}">
                                                                {{ $status->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- =================== SECCIÓN ACADÉMICA =================== --}}
                                            <div id="seccionAcademica" class="row mt-3"
                                                style="display:none; border-top: 1px solid #ccc; padding-top: 10px;">
                                                <h6 class="col-12 text-primary">Datos Académicos</h6>
                                                <div class="col-md-4 mb-2">
                                                    <label>Matrícula</label>
                                                    <input type="text" name="matricula" class="form-control">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Carrera</label>
                                                    <select name="id_carrera" class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($carreras as $carrera)
                                                            <option value="{{ $carrera->id_carrera }}">
                                                                {{ $carrera->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label>Plan de Estudios</label>
                                                    <select name="id_plan_estudio" class="form-control">
                                                        <option value="">Selecciona...</option>
                                                        @foreach ($planes as $plan)
                                                            <option value="{{ $plan->id_plan_estudio }}">
                                                                {{ $plan->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const statusSelect = document.getElementById('id_status_academico');
                                const seccionAcademica = document.getElementById('seccionAcademica');

                                statusSelect.addEventListener('change', function() {
                                    const selectedText = statusSelect.options[statusSelect.selectedIndex].text.toLowerCase();

                                    // Mostrar la sección académica solo si el estatus es "inscrito regular" o "irregular"
                                    if (selectedText.includes('inscrito') || selectedText.includes('regular')) {
                                        seccionAcademica.style.display = 'flex';
                                    } else {
                                        seccionAcademica.style.display = 'none';
                                    }
                                });
                            });
                        </script>




                        <!-- Scripts -->
                        <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
                        <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                        <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
