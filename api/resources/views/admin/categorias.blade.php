{{-- Agregado: Mensajes de éxito o error --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Aquí continúa tu código original --}}

@extends('admin.layouts.main')

@section('contenido')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Administración</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <!-- Navegación de pestañas -->
    <ul class="nav nav-pills mb-3 bg-light p-2 rounded shadow-sm" id="pills-tab" role="tablist">
        @php
            $tabs = ['categorias' => 'CATEGORÍAS', 'marcas' => 'MARCAS', 'modelos' => 'MODELOS', 'tallas' => 'TALLAS', 'colores' => 'COLORES'];
        @endphp
        @foreach($tabs as $id => $label)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $id }}-tab" 
                        data-bs-toggle="pill" data-bs-target="#pills-{{ $id }}" type="button" role="tab" 
                        aria-controls="pills-{{ $id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $label }}
                </button>
            </li>
        @endforeach
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="pills-tabContent">
        @foreach($tabs as $id => $label)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $id }}" role="tabpanel" aria-labelledby="pills-{{ $id }}-tab">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $label }}</h4>
                        <button class="btn btn-light text-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $id }}">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>NOMBRE</th>
                                    @if($id === 'modelos') <th>MARCAS</th> @endif
                                    @if($id === 'colores') <th># COLOR</th> @endif
                                    <th class="text-end">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items[$id] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        @if($id === 'modelos') <td>{{ $item->marca->nombre }}</td> @endif
                                        @if($id === 'colores') <td style="background-color: {{ $item->codigo }}; width: 50px;"></td> @endif
                                        <td class="text-end">
                                            <a href="{{ route($id . '.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route($id . '.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este elemento?');">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal para agregar elemento -->
            <div class="modal fade" id="modal-{{ $id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel-{{ $id }}">Agregar {{ $label }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route($id . '.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nombre-{{ $id }}" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre-{{ $id }}" name="nombre" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</div>
@endsection
@section('script') 
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.saveData').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            let form = this.closest('form');
            let formData = new FormData(form);
            let url = form.action;

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: data.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Recarga la página para ver el nuevo registro
                    });
                } else {
                    throw data.errors;
                }
            })
            .catch(errors => {
                let errorMessage = "Error al agregar, verifica los datos.";
                if (errors) {
                    errorMessage = Object.values(errors).flat().join("\n");
                }

                Swal.fire({
                    title: 'Error',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    });
});
</script>

@endsection