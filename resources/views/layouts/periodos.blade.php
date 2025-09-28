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
                    <a class="nav-link navbar-active-item  px-3 mr-1">Períodos Escolares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('carreras.index') }}">Carreras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="#">Materias</a>
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
                        Gestión de Períodos Escolares</h1>

                    <div class="row justify-content-center">
                        <div class="col-lg-10">

                            <!-- Botón para nuevo período -->
                            <div class="mb-3 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#nuevoPeriodoModal">
                                    <i class="fas fa-plus"></i> Nuevo Período
                                </button>
                            </div>


                            <!-- Filtros -->
                            <div class="container mb-4">
                                <form id="filtrosForm" method="GET" action="{{ route('periodos.index') }}"
                                    class="row g-2">

                                    <div class="col-md-2">
                                        <input type="text" name="nombre" class="form-control"
                                            placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <select name="id_tipo_periodo" class="form-control" required>
                                            <option value="">Tipo de período</option>
                                            @foreach ($tipos as $tipo)
                                                <option value="{{ $tipo->id_tipo_periodo }}"
                                                    {{ old('id_tipo_periodo') == $tipo->id_tipo_periodo ? 'selected' : '' }}>
                                                    {{ $tipo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <input type="date" name="fecha_inicio" class="form-control"
                                            value="{{ request('fecha_inicio') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <input type="date" name="fecha_fin" class="form-control"
                                            value="{{ request('fecha_fin') }}">
                                    </div>


                                    <div class="col-md-2">
                                        <select name="estado" class="form-control">
                                            <option value="">Estado</option>
                                            <option value="Abierto"
                                                {{ request('estado') == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                                            <option value="Cerrado"
                                                {{ request('estado') == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="mostrar" onchange="this.form.submit()" class="form-control">
                                            <option value="10" {{ request('mostrar') == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="13" {{ request('mostrar') == 13 ? 'selected' : '' }}>13
                                            </option>
                                            <option value="25" {{ request('mostrar') == 25 ? 'selected' : '' }}>25
                                            </option>
                                            <option value="50" {{ request('mostrar') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="todo"
                                                {{ request('mostrar') == 'todo' ? 'selected' : '' }}>
                                                Todo</option>
                                        </select>

                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('periodos.index', ['mostrar' => 'todo']) }}"
                                            class="btn btn-secondary w-100">
                                            Mostrar todo
                                        </a>
                                    </div>

                                </form>
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
                                                <th>Tipo de Período</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($periodos as $periodo)
                                                <tr class="text-center">
                                                    <td>{{ $periodo->id_periodo_escolar }}</td>
                                                    <td>{{ $periodo->nombre }}</td>
                                                    <td>{{ $periodo->tipoPeriodo->nombre ?? 'N/A' }}</td>
                                                    <td>{{ $periodo->fecha_inicio }}</td>
                                                    <td>{{ $periodo->fecha_fin }}</td>
                                                    <td>{{ $periodo->estado }}</td>
                                                    <td>
                                                        <a href="{{ route('periodos.edit', $periodo) }}"
                                                            class="btn btn-warning btn-sm modal-open">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </a>
                                                        <form action="{{ route('periodos.destroy', $periodo) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('¿Seguro que deseas eliminar este período?')">
                                                                <i class="fas fa-trash-alt"></i> Eliminar
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">No hay períodos
                                                        registrados</td>
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






    <!-- Modal Nuevo Período -->
    <div class="modal fade" id="nuevoPeriodoModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevoPeriodoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="text-center" id="nuevoPeriodoLabel" style="padding-left: 280px;">Nuevo Período Escolar
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('periodos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" placeholder="Ejemplo: JULIO-DICIEMBRE 2024" name="nombre"
                                value="{{ old('nombre') }}"
                                class="form-control @error('nombre') is-invalid @enderror" required>
                            @error('nombre')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tipo Período</label>
                            <select name="id_tipo_periodo" class="form-control" required>
                                <option value="">Tipo de período</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id_tipo_periodo }}"
                                        {{ old('id_tipo_periodo') == $tipo->id_tipo_periodo ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @error('id_tipo_periodo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}"
                                class="form-control @error('fecha_inicio') is-invalid @enderror" required>
                            @error('fecha_inicio')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Fecha Fin</label>
                            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}"
                                class="form-control @error('fecha_fin') is-invalid @enderror" required>
                            @error('fecha_fin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-control @error('estado') is-invalid @enderror"
                                required>
                                <option value="">Selecciona</option>
                                <option value="Abierto" {{ old('estado') == 'Abierto' ? 'selected' : '' }}>Abierto
                                </option>
                                <option value="Cerrado" {{ old('estado') == 'Cerrado' ? 'selected' : '' }}>Cerrado
                                </option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#nuevoPeriodoModal').modal('show');
            });
        </script>
    @endif





    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
