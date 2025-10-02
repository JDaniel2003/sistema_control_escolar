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
                    <a class="nav-link text-white px-3 mr-1" href="#">Planes de estudio</a>
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


                            <!-- Filtros -->
                            <div class="container mb-4 d-flex justify-content-center">
                                <div class="p-3 border rounded bg-light d-inline-block shadow-sm">
                                    <form id="filtrosForm" method="GET" action="{{ route('materias.index') }}"
                                        class="d-inline-flex flex-wrap gap-2 align-items-center">

                                        <!-- Nombre -->
                                        <input type="text" name="nombre"
                                            class="form-control form-control-sm w-auto"
                                            placeholder="Buscar por nombre" value="{{ request('nombre') }}">

                                        <!-- Duración -->
                                        <input type="text" name="duracion"
                                            class="form-control form-control-sm w-auto"
                                            placeholder="Buscar por duración" value="{{ request('duracion') }}">

                                        <!-- Mostrar -->
                                        <select name="mostrar" onchange="this.form.submit()"
                                            class="form-control form-control-sm w-auto">
                                            <option value="10" {{ request('mostrar') == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="13" {{ request('mostrar') == 13 ? 'selected' : '' }}>13
                                            </option>
                                            <option value="25" {{ request('mostrar') == 25 ? 'selected' : '' }}>25
                                            </option>
                                            <option value="50" {{ request('mostrar') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="todo"
                                                {{ request('mostrar') == 'todo' ? 'selected' : '' }}>Todo</option>
                                        </select>

                                        <!-- Botón Mostrar todo -->
                                        <a href="{{ route('materias.index', ['mostrar' => 'todo']) }}"
                                            class="btn btn-sm btn-outline-secondary d-flex align-items-center">
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
                                });
                            </script>






                            <!-- Tabla -->

                            <div class="card-body">
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
                                                    <td>
                                                        <!-- Botón Editar -->
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editarModal{{ $materia->id_materia }}">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </button>

                                                        <!-- Modal Editar -->
                                                        <div class="modal fade"
                                                            id="editarModal{{ $materia->id_materia }}" tabindex="-1"
                                                            role="dialog"
                                                            aria-labelledby="editarModalLabel{{ $materia->id_materia }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="text-center w-100"
                                                                            id="editarModalLabel{{ $materia->id_materia }}">
                                                                            Editar Materia
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Cerrar">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <form
                                                                        action="{{ route('materias.update', $materia->id_materia) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Clave</label>

                                                                                <input type="text" name="clave"
                                                                                    class="form-control"
                                                                                    value="{{ old('clave', $materia->clave) }}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Nombre</label>

                                                                                </option>
                                                                                <input type="text" name="nombre"
                                                                                    class="form-control"
                                                                                    value="{{ old('nombre', $materia->nombre) }}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Competencia</label>
                                                                                <select name="id_tipo_competencia"
                                                                                    class="form-control">
                                                                                    <option value="">Tipo de
                                                                                        Competencia</option>
                                                                                    @foreach ($competencias as $competencia)
                                                                                        <option
                                                                                            value="{{ $competencia->id_tipo_competencia }}">
                                                                                            {{ $competencia->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Modalidad</label>
                                                                                <select name="id_modalidad"
                                                                                    class="form-control">
                                                                                    <option value="">Tipo de
                                                                                        Modalidad</option>
                                                                                    @foreach ($modalidades as $modalidad)
                                                                                        <option
                                                                                            value="{{ $modalidad->id_modalidad }}">
                                                                                            {{ $modalidad->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Créditos</label>

                                                                                <input type="number" name="creditos"
                                                                                    class="form-control"
                                                                                    value="{{ old('creditos', $materia->creditos) }}">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Horas</label>
                                                                                <input type="number" name="horas"
                                                                                    class="form-control"
                                                                                    value="{{ old('horas', $materia->horas) }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Espacio
                                                                                    Formativo</label>
                                                                                <select name="id_espacio_formativo"
                                                                                    class="form-control">
                                                                                    <option value="">Espacio
                                                                                        Formativo
                                                                                    </option>
                                                                                    @foreach ($espaciosformativos as $espacio)
                                                                                        <option
                                                                                            value="{{ $espacio->id_espacio_formativo }}">
                                                                                            {{ $espacio->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Plan
                                                                                    de Estudio</label>
                                                                                <select name="id_plan_estudio"
                                                                                    class="form-control">
                                                                                    <option value="">Plan de
                                                                                        Estudio</option>
                                                                                    @foreach ($planes as $plan)
                                                                                        <option
                                                                                            value="{{ $plan->id_plan_estudio }}"
                                                                                            {{ $materia->id_plan_estudio == $plan->id_plan_estudio ? 'selected' : '' }}>
                                                                                            {{ $plan->nombre }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Período</label>
                                                                                <select name="id_numero_periodo"
                                                                                    class="form-control">
                                                                                    <option value="">Período
                                                                                    </option>
                                                                                    @foreach ($periodos as $periodo)
                                                                                        <option
                                                                                            value="{{ $periodo->id_numero_periodo }}"
                                                                                            {{ $materia->id_numero_periodo == $periodo->id_numero_periodo ? 'selected' : '' }}>
                                                                                            {{ $periodo->tipoPeriodo->nombre }}
                                                                                            - {{ $periodo->numero }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

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
    <div class="modal fade" id="nuevaMateriaModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevaMateriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="text-center w-100" id="nuevaMateriaLabel">Nueva Materia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('materias.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Clave</label>

                            <input type="text" placeholder="Escribe Clave" name="clave" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>

                            <input type="text" placeholder="Escribe Nombre" name="nombre" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Competencia</label>
                            <select name="id_tipo_competencia" class="form-control">
                                <option value="">Tipo de
                                    Competencia</option>
                                @foreach ($competencias as $competencia)
                                    <option value="{{ $competencia->id_tipo_competencia }}">
                                        {{ $competencia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Modalidad</label>
                            <select name="id_modalidad" class="form-control">
                                <option value="">Tipo de Modalidad</option>
                                @foreach ($modalidades as $modalidad)
                                    <option value="{{ $modalidad->id_modalidad }}">{{ $modalidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Créditos</label>

                            <input type="number" placeholder="Créditos" name="creditos" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Horas</label>

                            <input type="number" placeholder="Horas" name="horas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Espacio Formativo</label>
                            <select name="id_espacio_formativo" class="form-control">
                                <option value="">Espacio Formativo</option>
                                @foreach ($espaciosformativos as $espacio)
                                    <option value="{{ $espacio->id_espacio_formativo }}">{{ $espacio->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Plan de Estudio</label>
                            <select name="id_plan_estudio" class="form-control">
                                <option value="">Plan de Estudio</option>
                                @foreach ($planes as $plan)
                                    <option value="{{ $plan->id_plan_estudio }}">{{ $plan->nombre }}</option>
                                @endforeach
                            </select>
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
