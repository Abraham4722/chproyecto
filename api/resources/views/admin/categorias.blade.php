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
        @foreach (['categorias', 'marcas', 'modelos', 'tallas', 'colores'] as $seccion)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $seccion }}" role="tabpanel" aria-labelledby="pills-{{ $seccion }}-tab">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-uppercase">{{ $seccion }}</h3>
                <a href="#" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Agregar
                </a>
            </div>
            
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>NOMBRE</th>
                        @if($seccion == 'categorias') <th>DESCRIPCIÓN</th> @endif
                        @if($seccion == 'modelos') <th>MARCA</th> @endif
                        @if($seccion == 'colores') <th># COLOR</th> @endif
                        <th class="text-end">Acciones</th> <!-- Alineación a la derecha -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ejemplo</td>
                        @if($seccion == 'categorias') <td>Descripción de prueba</td> @endif
                        @if($seccion == 'modelos') <td>Marca ejemplo</td> @endif
                        @if($seccion == 'colores') <td>#FF0000</td> @endif
                        <td class="text-end">
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
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