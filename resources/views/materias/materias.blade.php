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
                    <a class="nav-link  text-white px-3 mr-1" href="{{ route('periodos.index') }}">Períodos
                        Escolares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('carreras.index') }}">Carreras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbar-active-item px-3 mr-1" href="#">Materias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('planes.index') }}">Planes de estudio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="#">Alumnos</a>
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
                        Gestión de Materias</h1>

                    <div class="row justify-content-center">
                        <div class="col-lg-10">

                            <!-- Botón para nueva MATERIA -->
                            <div class="mb-3 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#nuevaMateriaModal">
                                    <i class="fas fa-plus"></i> Nueva Materia
                                </button>
                            </div>


                            <!-- Filtros - Cada campo se ajusta a su contenido -->
                            <div class="container-fluid mb-4 d-flex justify-content-center px-3">
                                <div class="p-3 border rounded bg-light shadow-sm w-100" style="max-width: 1800px;">
                                    <form id="filtrosForm" method="GET" action="{{ route('materias.index') }}"
                                        class="d-flex flex-nowrap gap-2 align-items-center flex-shrink-0 overflow-auto">

                                        <!-- Clave -->
                                        <input type="text" name="clave"
                                            class="form-control form-control-sm py-1 px-2"
                                            placeholder="Buscar por Clave" value="{{ request('clave') }}"
                                            size="{{ max(strlen(request('clave')), strlen('Buscar por Clave')) }}"
                                            style="font-size: 1rem;">

                                        <!-- Nombre -->
                                        <input type="text" name="nombre"
                                            class="form-control form-control-sm py-1 px-2"
                                            placeholder="Buscar por Nombre" value="{{ request('nombre') }}"
                                            size="{{ max(strlen(request('nombre')), strlen('Buscar por Nombre')) }}"
                                            style="font-size: 1rem;">

                                        <!-- Competencia -->
                                        <select name="id_tipo_competencia"
                                            class="form-control form-control-sm py-1 px-2"
                                            style="font-size: 1rem; width: fit-content;">
                                            <option value="">Competencia</option>
                                            @foreach ($competencias as $competencia)
                                                <option value="{{ $competencia->id_tipo_competencia }}"
                                                    {{ request('id_tipo_competencia') == $competencia->id_tipo_competencia ? 'selected' : '' }}
                                                    style="white-space: nowrap;">
                                                    {{ $competencia->nombre }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Modalidad -->
                                        <select name="id_modalidad" class="form-control form-control-sm py-1 px-2"
                                            style="font-size: 1rem; width: fit-content;">
                                            <option value="">Modalidad</option>
                                            @foreach ($modalidades as $modalidad)
                                                <option value="{{ $modalidad->id_modalidad }}"
                                                    {{ request('id_modalidad') == $modalidad->id_modalidad ? 'selected' : '' }}
                                                    style="white-space: nowrap;">
                                                    {{ $modalidad->nombre }}
                                                </option>
                                            @endforeach
                                        </select>


                                        <!-- Espacio Formativo -->
                                        <select name="id_espacio_formativo"
                                            class="form-control form-control-sm py-1 px-2"
                                            style="font-size: 1rem; width: fit-content;">
                                            <option value="">Espacio Formativo</option>
                                            @foreach ($espaciosformativos as $espacioformativo)
                                                <option value="{{ $espacioformativo->id_espacio_formativo }}"
                                                    {{ request('id_espacio_formativo') == $espacioformativo->id_espacio_formativo ? 'selected' : '' }}
                                                    style="white-space: nowrap;">
                                                    {{ $espacioformativo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Plan Estudio -->
                                        <select name="id_plan_estudio" class="form-control form-control-sm py-1 px-2"
                                            style="font-size: 1rem; width: fit-content;">
                                            <option value="">Plan de Estudio</option>
                                            @foreach ($planes as $plan)
                                                <option value="{{ $plan->id_plan_estudio }}"
                                                    {{ request('id_plan_estudio') == $plan->id_plan_estudio ? 'selected' : '' }}
                                                    style="white-space: nowrap;">
                                                    {{ $plan->nombre }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <select name="id_numero_periodo"
                                            class="form-control form-control-sm py-1 px-2"
                                            style="font-size: 1rem; width: fit-content;">
                                            <option value="">Número Período</option>
                                            @foreach ($periodos as $periodo)
                                                <option value="{{ $periodo->id_numero_periodo }}">
                                                    {{ $periodo->tipoPeriodo->nombre }} - {{ $periodo->numero }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Botón Mostrar todo -->
                                        <a href="{{ route('materias.index', ['mostrar' => 'todo']) }}"
                                            class="btn btn-sm btn-outline-secondary py-1 px-3 d-flex align-items-center"
                                            style="font-size: 1rem; white-space: nowrap;">
                                            <i class="fas fa-list me-1"></i> Mostrar todo
                                        </a>
                                    </form>
                                </div>
                            </div>




                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    let form = document.getElementById("filtrosForm");

                                    // Detecta cambios en inputs y selects
                                    form.querySelectorAll("input, select").forEach(el => {
                                        el.addEventListener("change", function() {
                                            form.submit();
                                        });
                                    });

                                    // Para "nombre", busca después de dejar de escribir (delay 500ms)
                                    let typingTimer;
                                    let nombreInput = form.querySelector("input[name='nombre']");
                                    if (nombreInput) {
                                        nombreInput.addEventListener("keyup", function() {
                                            clearTimeout(typingTimer);
                                            typingTimer = setTimeout(() => {
                                                form.submit();
                                            }, 500);
                                        });
                                    }
                                    let claveInput = form.querySelector("input[name='clave']");
                                    if (claveInput) {
                                        claveInput.addEventListener("keyup", function() {
                                            clearTimeout(typingTimer);
                                            typingTimer = setTimeout(() => {
                                                form.submit();
                                            }, 500);
                                        });
                                    }
                                });
                            </script>






                            <!-- Tabla -->

                            <div class="card-body1">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-dark text-center">
                                            <tr>
                                                <th>ID</th>
                                                <th>Clave</th>
                                                <th>Nombre</th>
                                                <th>Competencia</th>
                                                <th>Modalidad</th>
                                                <th>Créditos</th>
                                                <th>Horas</th>
                                                <th>Espacio Formativo</th>
                                                <th>Plan de Estudios</th>
                                                <th>Numero Período</th>
                                                <th>Unidades</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($materias as $materia)
                                                <tr class="text-center">
                                                    <td>{{ $materia->id_materia }}</td>
                                                    <td>{{ $materia->clave }}</td>
                                                    <td>{{ $materia->nombre }}</td>
                                                    <td>{{ $materia->competencia->nombre ?? 'N/A' }}</td>
                                                    <td>{{ $materia->modalidad->nombre ?? 'N/A' }}</td>
                                                    <td>{{ $materia->creditos }}</td>
                                                    <td>{{ $materia->horas }}</td>
                                                    <td>{{ $materia->espacioFormativo->nombre ?? 'N/A' }}</td>
                                                    <td>{{ $materia->planEstudio->nombre ?? 'N/A' }}</td>
                                                    <td>
                                                        {{ $materia->numeroPeriodo->tipoPeriodo->nombre ?? 'N/A' }}
                                                        {{ $materia->numeroPeriodo->numero ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ $materia->unidades_count }}
                                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#unidadesModal{{ $materia->id_materia }}">
                                                            Ver unidades
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade"
                                                            id="unidadesModal{{ $materia->id_materia }}"
                                                            tabindex="-1" role="dialog">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Unidades de
                                                                            {{ $materia->nombre }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <!-- Form único para actualizar todas las unidades -->
                                                                        <form
                                                                            action="{{ route('unidades.actualizarTodo', $materia->id_materia) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            <table
                                                                                class="table table-sm table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Unidad</th>
                                                                                        <th>Nombre</th>
                                                                                        <th>Horas saber</th>
                                                                                        <th>Horas saber hacer</th>
                                                                                        <th>Horas totales</th>
                                                                                        <th>Eliminar</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @forelse($materia->unidades as $i => $unidad)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="hidden"
                                                                                                    name="unidades[{{ $i }}][id_unidad]"
                                                                                                    value="{{ $unidad->id_unidad }}">
                                                                                                <input type="number"
                                                                                                    name="unidades[{{ $i }}][numero_unidad]"
                                                                                                    class="form-control form-control-sm"
                                                                                                    value="{{ $unidad->numero_unidad }}"
                                                                                                    required>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text"
                                                                                                    name="unidades[{{ $i }}][nombre]"
                                                                                                    class="form-control form-control-sm"
                                                                                                    value="{{ $unidad->nombre }}"
                                                                                                    required>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="number"
                                                                                                    name="unidades[{{ $i }}][horas_saber]"
                                                                                                    class="form-control form-control-sm horas-saber"
                                                                                                    value="{{ $unidad->horas_saber }}">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="number"
                                                                                                    name="unidades[{{ $i }}][horas_saber_hacer]"
                                                                                                    class="form-control form-control-sm horas-saber-hacer"
                                                                                                    value="{{ $unidad->horas_saber_hacer }}">
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="number"
                                                                                                    name="unidades[{{ $i }}][horas_totales]"
                                                                                                    class="form-control form-control-sm horas-totales"
                                                                                                    value="{{ $unidad->horas_totales }}"
                                                                                                    readonly>
                                                                                            </td>
                                                                                            <td>
                                                                                                <!-- Botón de tipo "button" que dispara el formulario de eliminación externo -->
                                                                                                <button type="button"
                                                                                                    class="btn btn-danger btn-sm"
                                                                                                    onclick="eliminarUnidad('formEliminar{{ $unidad->id_unidad }}');">
                                                                                                    Eliminar
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @empty
                                                                                        <tr>
                                                                                            <td colspan="6"
                                                                                                class="text-center">No
                                                                                                hay unidades</td>
                                                                                        </tr>
                                                                                    @endforelse
                                                                                </tbody>
                                                                            </table>

                                                                            <div class="text-right mt-3">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                    Aplicar cambios
                                                                                </button>
                                                                            </div>
                                                                        </form>

                                                                        <!-- Formulario para agregar nueva unidad -->
                                                                        <form
                                                                            action="{{ route('unidades.agregar', $materia->id_materia) }}"
                                                                            method="POST" class="mt-4">
                                                                            @csrf
                                                                            <div class="form-row">
                                                                                <div class="col">
                                                                                    <input type="text"
                                                                                        name="nombre"
                                                                                        class="form-control form-control-sm"
                                                                                        placeholder="Nombre unidad"
                                                                                        required>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <input type="number"
                                                                                        name="numero_unidad"
                                                                                        class="form-control form-control-sm"
                                                                                        placeholder="# Unidad"
                                                                                        required>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <input type="number"
                                                                                        name="horas_saber"
                                                                                        class="form-control form-control-sm horas-saber"
                                                                                        placeholder="Horas saber">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <input type="number"
                                                                                        name="horas_saber_hacer"
                                                                                        class="form-control form-control-sm horas-saber-hacer"
                                                                                        placeholder="Horas saber hacer">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <input type="number"
                                                                                        name="horas_totales"
                                                                                        class="form-control form-control-sm horas-totales"
                                                                                        placeholder="Total horas"
                                                                                        readonly>
                                                                                </div>
                                                                                <div class="col-auto">
                                                                                    <button type="submit"
                                                                                        class="btn btn-success btn-sm">Agregar</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Formularios de eliminación (FUERA del formulario principal) -->
                                                        @foreach ($materia->unidades as $unidad)
                                                            <form id="formEliminar{{ $unidad->id_unidad }}"
                                                                action="{{ route('unidades.eliminar', $unidad->id_unidad) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        @endforeach

                                                        <!-- JS para autocalcular horas totales y eliminar unidades -->
                                                        <script>
                                                            // Autocalcular horas totales
                                                            document.addEventListener("input", function(e) {
                                                                if (e.target.classList.contains("horas-saber") ||
                                                                    e.target.classList.contains("horas-saber-hacer")) {

                                                                    let row = e.target.closest("tr, .form-row");
                                                                    if (!row) return;

                                                                    let saber = parseInt(row.querySelector(".horas-saber")?.value) || 0;
                                                                    let hacer = parseInt(row.querySelector(".horas-saber-hacer")?.value) || 0;

                                                                    let totalInput = row.querySelector(".horas-totales");
                                                                    if (totalInput) {
                                                                        totalInput.value = saber + hacer;
                                                                    }
                                                                }
                                                            });

                                                            // Función segura para eliminar unidad
                                                            function eliminarUnidad(formId) {
                                                                if (confirm('¿Seguro que deseas eliminar esta unidad?')) {
                                                                    document.getElementById(formId).submit();
                                                                }
                                                            }
                                                        </script>



                                                    </td>
                                                    <td>
                                                        <!-- Botón Editar -->
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editarModal{{ $materia->id_materia }}">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </button>

                                                        <!-- Modal Editar -->
                                                        <!-- Modal Editar Materia -->
                                                        <div class="modal fade"
                                                            id="editarModal{{ $materia->id_materia }}" tabindex="-1"
                                                            role="dialog"
                                                            aria-labelledby="editarModalLabel{{ $materia->id_materia }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">

                                                                    <!-- Encabezado -->
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title w-100 text-center font-weight-bold"
                                                                            id="editarModalLabel{{ $materia->id_materia }}">
                                                                            Editar Materia
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Cerrar">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <!-- Formulario -->
                                                                    <form
                                                                        action="{{ route('materias.update', $materia->id_materia) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="modal-body">
                                                                            <div class="container-fluid">

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label style="text-align: left; display: block;">Clave</label>
                                                                                        <input type="text"
                                                                                            name="clave"
                                                                                            class="form-control"
                                                                                            value="{{ old('clave', $materia->clave) }}"
                                                                                            required>
                                                                                    </div>

                                                                                    <div class="form-group col-md-6">
                                                                                        <label style="text-align: left; display: block;">Nombre</label>
                                                                                        <input type="text"
                                                                                            name="nombre"
                                                                                            class="form-control"
                                                                                            value="{{ old('nombre', $materia->nombre) }}"
                                                                                            required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label style="text-align: left; display: block;">Competencia</label>
                                                                                        <select
                                                                                            name="id_tipo_competencia"
                                                                                            class="form-control">
                                                                                            <option value="">Tipo
                                                                                                de Competencia</option>
                                                                                            @foreach ($competencias as $competencia)
                                                                                                <option
                                                                                                    value="{{ $competencia->id_tipo_competencia }}"
                                                                                                    {{ $materia->id_tipo_competencia == $competencia->id_tipo_competencia ? 'selected' : '' }}>
                                                                                                    {{ $competencia->nombre }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group col-md-6">
                                                                                        <label style="text-align: left; display: block;">Modalidad</label>
                                                                                        <select name="id_modalidad"
                                                                                            class="form-control">
                                                                                            <option value="">Tipo
                                                                                                de Modalidad</option>
                                                                                            @foreach ($modalidades as $modalidad)
                                                                                                <option
                                                                                                    value="{{ $modalidad->id_modalidad }}"
                                                                                                    {{ $materia->id_modalidad == $modalidad->id_modalidad ? 'selected' : '' }}>
                                                                                                    {{ $modalidad->nombre }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label style="text-align: left; display: block;">Créditos</label>
                                                                                        <input type="number"
                                                                                            name="creditos"
                                                                                            class="form-control"
                                                                                            value="{{ old('creditos', $materia->creditos) }}">
                                                                                    </div>

                                                                                    <div class="form-group col-md-6">
                                                                                        <label style="text-align: left; display: block;">Horas</label>
                                                                                        <input type="number"
                                                                                            name="horas"
                                                                                            class="form-control"
                                                                                            value="{{ old('horas', $materia->horas) }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label style="text-align: left; display: block;">Espacio Formativo</label>
                                                                                        <select
                                                                                            name="id_espacio_formativo"
                                                                                            class="form-control">
                                                                                            <option value="">
                                                                                                Espacio Formativo
                                                                                            </option>
                                                                                            @foreach ($espaciosformativos as $espacio)
                                                                                                <option
                                                                                                    value="{{ $espacio->id_espacio_formativo }}"
                                                                                                    {{ $materia->id_espacio_formativo == $espacio->id_espacio_formativo ? 'selected' : '' }}>
                                                                                                    {{ $espacio->nombre }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group col-md-6">
                                                                                        <label style="text-align: left; display: block;">Plan de Estudio</label>
                                                                                        <select name="id_plan_estudio"
                                                                                            class="form-control">
                                                                                            <option value="">Plan
                                                                                                de Estudio</option>
                                                                                            @foreach ($planes as $plan)
                                                                                                <option
                                                                                                    value="{{ $plan->id_plan_estudio }}"
                                                                                                    {{ $materia->id_plan_estudio == $plan->id_plan_estudio ? 'selected' : '' }}>
                                                                                                    {{ $plan->nombre }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label style="text-align: left; display: block;">Período</label>
                                                                                    <select name="id_numero_periodo"
                                                                                        class="form-control">
                                                                                        <option value="">Período
                                                                                        </option>
                                                                                        @foreach ($periodos as $periodo)
                                                                                            <option
                                                                                                value="{{ $periodo->id_numero_periodo }}"
                                                                                                {{ $materia->id_numero_periodo == $periodo->id_numero_periodo ? 'selected' : '' }}>
                                                                                                {{ $periodo->tipoPeriodo->nombre }}
                                                                                                -
                                                                                                {{ $periodo->numero }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <!-- Footer -->
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit"
                                                                                class="btn btn-success">Actualizar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Botón Eliminar -->
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#eliminarModal{{ $materia->id_materia }}">
                                                            <i class="fas fa-trash-alt"></i> Eliminar
                                                        </button>

                                                        <!-- Modal Eliminar -->
                                                        <div class="modal fade"
                                                            id="eliminarModal{{ $materia->id_materia }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="eliminarModalLabel{{ $materia->id_materia }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="text-center w-100"
                                                                            id="eliminarModalLabel{{ $materia->id_materia }}">
                                                                            Eliminar Materia
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Cerrar">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        ¿Seguro que deseas eliminar la materia
                                                                        <strong>{{ $materia->nombre }}</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="{{ route('materias.destroy', $materia->id_materia) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Eliminar</button>
                                                                        </form>
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>




                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100" class="text-center text-muted">No hay carreras
                                                        registradas</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <!-- End Container -->

            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Tu Web 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End Footer -->

        </div>
        <!-- End Content Wrapper -->

    </div>
    <!-- End Page Wrapper -->






    <!-- Modal Nueva carrera -->
    <!-- Modal Nueva Materia -->
    <div class="modal fade" id="nuevaMateriaModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevaMateriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <!-- Encabezado -->
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center font-weight-bold" id="nuevaMateriaLabel">
                        Nueva Materia
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Formulario -->
                <form action="{{ route('materias.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Clave</label>
                                    <input type="text" name="clave" class="form-control"
                                        placeholder="Escribe Clave" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" class="form-control"
                                        placeholder="Escribe Nombre" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Competencia</label>
                                    <select name="id_tipo_competencia" class="form-control">
                                        <option value="">Tipo de Competencia</option>
                                        @foreach ($competencias as $competencia)
                                            <option value="{{ $competencia->id_tipo_competencia }}">
                                                {{ $competencia->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Modalidad</label>
                                    <select name="id_modalidad" class="form-control">
                                        <option value="">Tipo de Modalidad</option>
                                        @foreach ($modalidades as $modalidad)
                                            <option value="{{ $modalidad->id_modalidad }}">{{ $modalidad->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Créditos</label>
                                    <input type="number" name="creditos" class="form-control"
                                        placeholder="Créditos">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Horas</label>
                                    <input type="number" name="horas" class="form-control" placeholder="Horas">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Espacio Formativo</label>
                                    <select name="id_espacio_formativo" class="form-control">
                                        <option value="">Espacio Formativo</option>
                                        @foreach ($espaciosformativos as $espacio)
                                            <option value="{{ $espacio->id_espacio_formativo }}">
                                                {{ $espacio->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Plan de Estudio</label>
                                    <select name="id_plan_estudio" class="form-control">
                                        <option value="">Plan de Estudio</option>
                                        @foreach ($planes as $plan)
                                            <option value="{{ $plan->id_plan_estudio }}">{{ $plan->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Período</label>
                                <select name="id_numero_periodo" class="form-control">
                                    <option value="">Período</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->id_numero_periodo }}">
                                            {{ $periodo->tipoPeriodo->nombre }} - {{ $periodo->numero }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>








    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
