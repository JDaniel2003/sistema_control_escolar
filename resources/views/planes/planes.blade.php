<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Control Escolar</title>

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
                    <a class="nav-link text-white px-3 mr-1" href="#">Materias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbar-active-item px-3 mr-1" href="#">Planes de estudio</a>
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
                        Gestión de Planes de Estudios</h1>

                    <div class="row justify-content-center">
                        <div class="col-lg-10">

                            <!-- Botón para nuevo período -->
                            <div class="mb-3 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#nuevoplanModal">
                                    <i class="fas fa-plus"></i> Nuevo Plan de Estudios
                                </button>
                            </div>


                            <!-- Filtros -->
                            <div class="container mb-4 d-flex justify-content-center">
                                <div class="p-3 border rounded bg-light d-inline-block shadow-sm">
                                    <form id="filtrosForm" method="GET" action="{{ route('planes.index') }}"
                                        class="d-inline-flex flex-wrap gap-2 align-items-center">

                                        <!-- Nombre -->
                                        <input type="text" name="nombre"
                                            class="form-control form-control-sm w-auto"
                                            placeholder="Buscar por nombre" value="{{ request('nombre') }}">

                                        <!-- carrera -->
                                        <select name="id_carrera"
                                            class="form-control form-control-sm w-auto @error('id_carrera') is-invalid @enderror">
                                            <option value="">Buscar por carrera</option>
                                            @foreach ($carreras as $carrera)
                                                <option value="{{ $carrera->id_carrera }}"
                                                    {{ old('id_carrera') == $carrera->id_carrera ? 'selected' : '' }}>
                                                    {{ $carrera->nombre }}
                                                </option>
                                            @endforeach
                                        </select>

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
                                        <a href="{{ route('planes.index', ['mostrar' => 'todo']) }}"
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
                                                <th>Nombre</th>
                                                <th>Carrera</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($planes as $plan)
                                                <tr class="text-center">
                                                    <td>{{ $plan->id_plan_estudio }}</td>
                                                    <td>{{ $plan->nombre }}</td>
                                                    <td>{{ $plan->carrera->nombre ?? 'N/A' }}</td>
                                                    <td>

                                                        <!-- Botón Ver -->
                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#verModal{{ $plan->id_plan_estudio }}">
                                                            <i class="fas fa-eye"></i> Ver
                                                        </button>

                                                        <!-- Modal Ver -->
                                                        <!-- Modal Ver -->
<div class="modal fade"
     id="verModal{{ $plan->id_plan_estudio }}"
     tabindex="-1" role="dialog"
     aria-labelledby="verModalLabel{{ $plan->id_plan_estudio }}"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="text-center w-100">
                    Detalles del Plan de Estudio
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p><strong>ID:</strong> {{ $plan->id_plan_estudio }}</p>
                <p><strong>Nombre:</strong> {{ $plan->nombre }}</p>
                <p><strong>Carrera:</strong> {{ $plan->carrera->nombre ?? 'N/A' }}</p>

                <hr>
                <h5 class="text-center mb-3">Mapa Curricular</h5>

                @if ($plan->materias && $plan->materias->count() > 0)
                    @php
                        // Agrupar materias por periodo
                        $materiasPorPeriodo = $plan->materias->groupBy('id_numero_periodo');
                        $maxMaterias = $materiasPorPeriodo->map->count()->max(); // Saber cuál columna es más larga
                    @endphp

                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="bg-primary text-white">
                                <tr>
                                    @foreach ($materiasPorPeriodo as $idPeriodo => $materias)
                                        <th>
                                            {{ $materias->first()->numeroPeriodo->numero ?? 'Periodo' }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $maxMaterias; $i++)
                                    <tr>
                                        @foreach ($materiasPorPeriodo as $materias)
                                            <td>
                                                @if (isset($materias[$i]))
                                                    <div class="border rounded p-2" style="min-width:180px; background-color:#fff3e0;">
                                                        <strong>{{ $materias[$i]->nombre }}</strong><br>
                                                        <small><strong>Horas:</strong> {{ $materias[$i]->horas ?? 'N/A' }}</small><br>
                                                        <small><strong>Créditos:</strong> {{ $materias[$i]->creditos ?? 'N/A' }}</small>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No hay materias registradas para este plan.</p>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>





                                                        <!-- Botón Editar -->
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editarModal{{ $plan->id_plan_estudio }}">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </button>

                                                        <!-- Modal Editar -->
                                                        <div class="modal fade"
                                                            id="editarModal{{ $plan->id_plan_estudio }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editarModalLabel{{ $plan->id_plan_estudio }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="text-center"
                                                                            id="editarModalLabel{{ $plan->id_plan_estudio }}"
                                                                            style="padding-left: 280px;">
                                                                            Editar Plan de Estudio
                                                                        </h5>
                                                                        <button type="button"
                                                                            class="close text-white"
                                                                            data-dismiss="modal" aria-label="Cerrar">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <form
                                                                        action="{{ route('planes.update', $plan->id_plan_estudio) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Nombre</label>
                                                                                <input type="text" name="nombre"
                                                                                    class="form-control"
                                                                                    value="{{ old('nombre', $plan->nombre) }}"
                                                                                    required>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    style="text-align: left; display: block;">Carrera</label>
                                                                                <select name="id_carrera"
                                                                                    class="form-control">
                                                                                    <option value="">--
                                                                                        Selecciona carrera --</option>
                                                                                    @foreach ($carreras as $carrera)
                                                                                        <option
                                                                                            value="{{ $carrera->id_carrera }}"
                                                                                            {{ old('id_carrera', $plan->id_carrera) == $carrera->id_carrera ? 'selected' : '' }}>
                                                                                            {{ $carrera->nombre }}
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
                                                            data-target="#eliminarModal{{ $plan->id_plan_estudio }}">
                                                            <i class="fas fa-trash-alt"></i> Eliminar
                                                        </button>

                                                        <!-- Modal Eliminar -->
                                                        <div class="modal fade"
                                                            id="eliminarModal{{ $plan->id_plan_estudio }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="eliminarModalLabel{{ $plan->id_plan_estudio }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="text-center"
                                                                            id="eliminarModalLabel{{ $plan->id_plan_estudio }}"
                                                                            style="padding-left: 280px;">
                                                                            Eliminar Plan de Estudio
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Cerrar">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        ¿Seguro que deseas eliminar el plan de estudio
                                                                        <strong>{{ $plan->nombre }}</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                        <form
                                                                            action="{{ route('planes.destroy', $plan->id_plan_estudio) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Eliminar</button>
                                                                        </form>
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


    <!-- Modal Nuevo Plan -->
    <div class="modal fade" id="nuevoplanModal" tabindex="-1" role="dialog" aria-labelledby="nuevoplanLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="text-center" id="nuevoplanLabel" style="padding-left: 280px;">Nuevo Plan de Estudio
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('planes.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre"
                                class="form-control @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label>Carrera</label>
                            <select name="id_carrera" class="form-control @error('id_carrera') is-invalid @enderror">
                                <option value="">-- Selecciona carrera --</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id_carrera }}"
                                        {{ old('id_carrera') == $carrera->id_carrera ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_carrera')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

    <!-- Script para reabrir modal si hay errores -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#nuevoplanModal').modal('show');
            });
        </script>
    @endif


    <!-- Script para reabrir modal si hay errores -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#nuevoplanModal').modal('show');
            });
        </script>
    @endif

    </div>






    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
